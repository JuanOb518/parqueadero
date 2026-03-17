<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.configuracion.index', ['settings' => $settings]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'total_spots' => 'required|integer|min:1',
            'tarifa_por_hora' => 'required|numeric|min:0',
            'nombre_parqueadero' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email',
        ]);

        foreach ($request->all() as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Configuración actualizada correctamente');
    }
}
