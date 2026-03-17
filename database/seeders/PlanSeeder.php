<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'nombre' => 'Mensualidad',
            'duracion' => 'mes',
            'precio' => 150000.00,
            'descripcion' => 'Acceso ilimitado durante un mes calendario',
        ]);

        Plan::create([
            'nombre' => 'Día Completo',
            'duracion' => 'dia',
            'precio' => 12000.00,
            'descripcion' => 'Acceso durante 24 horas',
        ]);

        Plan::create([
            'nombre' => 'Hora',
            'duracion' => 'hora',
            'precio' => 2200.00,
            'descripcion' => 'Acceso por hora fraccionada',
        ]);
    }
}
