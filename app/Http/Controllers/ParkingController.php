<?php

namespace App\Http\Controllers;

use App\Helpers\ParkingHelper;
use App\Http\Controllers\Controller;
use App\Models\Motorcycle;
use App\Models\Parking;
use App\Models\Plan;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    /**
     * Display a listing of the active parkings.
     */
    public function index()
    {
        $parkingsActivos = Parking::whereNull('hora_salida')
            ->with(['motorcycle', 'plan'])
            ->orderBy('hora_entrada', 'desc')
            ->paginate(15);

        return view('admin.parqueos.index', ['parkingsActivos' => $parkingsActivos]);
    }

    /**
     * Show the form for creating a new parking entry.
     */
    public function create()
    {
        $planes = Plan::all();
        $totalSpots = (int) Setting::get('total_spots', 50);
        $parkingActivos = Parking::whereNull('hora_salida')->count();
        $disponibles = $totalSpots - $parkingActivos;

        return view('admin.parqueos.crear-entrada', [
            'planes' => $planes,
            'disponibles' => $disponibles,
        ]);
    }

    /**
     * Store a new parking entry.
     */
    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|exists:motorcycles,placa',
            'plan_id' => 'nullable|exists:plans,id',
        ]);

        $moto = Motorcycle::where('placa', $request->placa)->first();
        $totalCosto = 0;
        $pago = 'pendiente';

        // Si tiene plan, asignar el costo del plan inmediatamente
        if ($request->plan_id) {
            $plan = Plan::find($request->plan_id);
            $totalCosto = $plan->precio;
            $pago = 'pagado';
        }

        $parqueo = Parking::create([
            'motorcycle_id' => $moto->id,
            'plan_id' => $request->plan_id,
            'hora_entrada' => ParkingHelper::now(),
            'total_costo' => $totalCosto,
            'pago' => $pago,
        ]);

        return redirect()->route('parqueos.index')
            ->with('success', 'Entrada registrada correctamente');
    }

    /**
     * Show the form for processing a parking exit and payment.
     */
    public function edit(Parking $parqueo)
    {
        $tarifaPorHora = (int) Setting::get('tarifa_por_hora', 500);
        
        if ($parqueo->hora_salida) {
            return redirect()->route('parqueos.index')
                ->with('error', 'Este parqueo ya ha sido cerrado');
        }

        return view('admin.parqueos.procesar-salida', [
            'parqueo' => $parqueo,
            'tarifaPorHora' => $tarifaPorHora,
        ]);
    }

    /**
     * Update parking with exit time and calculate cost.
     */
    public function update(Request $request, Parking $parqueo)
    {
        $request->validate([
            'pago' => 'required|in:pendiente,pagado',
        ]);

        if ($parqueo->hora_salida) {
            return redirect()->route('parqueos.index')
                ->with('error', 'Este parqueo ya ha sido cerrado');
        }

        $tarifaPorHora = (int) Setting::get('tarifa_por_hora', 2200);
        $tarifaPorDia = (int) Setting::get('tarifa_por_dia', 12000);
        $horaSalida = ParkingHelper::now();

        if ($parqueo->plan_id) {
            // Si tiene plan, el costo ya fue asignado al entrar, no se modifica
            $totalCosto = $parqueo->total_costo;
        } else {
            // Calcular costo según el tiempo de estancia
            $difHoras = $parqueo->hora_entrada->diffInHours($horaSalida, false);

            if ($difHoras < 1) {
                // Menos de 1 hora: cobrar 1 hora
                $totalCosto = $tarifaPorHora;
            } elseif ($difHoras <= 5) {
                // Entre 1 y 5 horas: cobrar por hora (redondeado hacia arriba)
                $horas = ceil($difHoras);
                $totalCosto = $horas * $tarifaPorHora;
            } else {
                // Más de 5 horas: cobrar tarifa de día
                $totalCosto = $tarifaPorDia;
            }
        }

        $parqueo->update([
            'hora_salida' => $horaSalida,
            'total_costo' => $totalCosto,
            'pago' => $request->pago,
        ]);

        return redirect()->route('parqueos.index')
            ->with('success', 'Salida registrada correctamente');
    }

    /**
     * Display parking history.
     */
    public function show()
    {
        $historial = Parking::whereNotNull('hora_salida')
            ->with(['motorcycle', 'plan'])
            ->orderBy('hora_salida', 'desc')
            ->paginate(20);

        return view('admin.parqueos.historial', ['historial' => $historial]);
    }
}

