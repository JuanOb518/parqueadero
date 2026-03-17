<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'key' => 'total_spots',
            'value' => '50',
        ]);

        Setting::create([
            'key' => 'tarifa_por_hora',
            'value' => '2200',
        ]);

        Setting::create([
            'key' => 'tarifa_por_dia',
            'value' => '12000',
        ]);

        Setting::create([
            'key' => 'nombre_parqueadero',
            'value' => 'Parqueadero de Motocicletas Premium',
        ]);

        Setting::create([
            'key' => 'direccion',
            'value' => 'Calle Principal #123, Ciudad',
        ]);

        Setting::create([
            'key' => 'telefono',
            'value' => '+57 1 234 5678',
        ]);

        Setting::create([
            'key' => 'correo',
            'value' => 'info@parqueaderomotos.com',
        ]);
    }
}
