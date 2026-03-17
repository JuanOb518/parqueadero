<?php

namespace App\View\Composers;

use App\Models\Plan;
use App\Models\Setting;
use Illuminate\View\View;

class PublicViewComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        try {
            $nombreParqueadero = Setting::get('nombre_parqueadero', 'Parqueadero Premium');
            $direccion = Setting::get('direccion', 'Calle Principal 123');
            $telefono = Setting::get('telefono', '+57 300 000 0000');
            $correo = Setting::get('correo', 'info@parqueadero.com');
            $totalSpots = (int) Setting::get('total_spots', 50);
            $tarifaPorHora = (int) Setting::get('tarifa_por_hora', 2200);
            $tarifaPorDia = (int) Setting::get('tarifa_por_dia', 12000);
            $planes = Plan::all();
        } catch (\Exception $e) {
            // Si hay error en base de datos, usar valores por defecto
            $nombreParqueadero = 'Parqueadero Premium';
            $direccion = 'Calle Principal 123';
            $telefono = '+57 300 000 0000';
            $correo = 'info@parqueadero.com';
            $totalSpots = 50;
            $tarifaPorHora = 2200;
            $tarifaPorDia = 12000;
            $planes = collect([]);
        }
        
        $view->with([
            'nombreParqueadero' => $nombreParqueadero,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'correo' => $correo,
            'totalSpots' => $totalSpots,
            'tarifaPorHora' => $tarifaPorHora,
            'planes' => $planes,
        ]);
    }
}
