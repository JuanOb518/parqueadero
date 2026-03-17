<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Parking;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function inicio()
    {
        return view('public.inicio');
    }

    public function tarifas()
    {
        return view('public.tarifas');
    }

    public function disponibilidad()
    {
        $totalSpots = (int) \App\Models\Setting::get('total_spots', 50);
        $parkingActivos = Parking::whereNull('hora_salida')->count();
        $disponibles = $totalSpots - $parkingActivos;

        return view('public.disponibilidad', [
            'totalSpots' => $totalSpots,
            'parkingActivos' => $parkingActivos,
            'disponibles' => $disponibles,
        ]);
    }

    public function contacto()
    {
        return view('public.contacto');
    }
}
