<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Motorcycle;
use App\Models\Parking;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalSpots = (int) Setting::get('total_spots', 50);
        $parkingActivos = Parking::whereNull('hora_salida')->count();
        $espaciosDisponibles = $totalSpots - $parkingActivos;

        $ingresoHoy = Parking::whereDate('created_at', today())
            ->whereNotNull('hora_salida')
            ->sum('total_costo');

        $ingresosRecientes = Parking::whereNotNull('hora_salida')
            ->orderBy('hora_salida', 'desc')
            ->take(5)
            ->get();

        $motosParqueadas = Parking::whereNull('hora_salida')
            ->with('motorcycle')
            ->get();

        return view('admin.dashboard', [
            'totalSpots' => $totalSpots,
            'parkingActivos' => $parkingActivos,
            'espaciosDisponibles' => $espaciosDisponibles,
            'ingresoHoy' => $ingresoHoy,
            'ingresosRecientes' => $ingresosRecientes,
            'motosParqueadas' => $motosParqueadas,
        ]);
    }
}
