<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Motorcycle;
use Illuminate\Http\Request;

class MotorcycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motos = Motorcycle::all();
        return view('admin.motos.index', ['motos' => $motos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.motos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|unique:motorcycles',
            'nombre_propietario' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email',
            'marca' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('motos', 'public');
        }

        Motorcycle::create($data);

        return redirect()->route('motos.index')
            ->with('success', 'Motocicleta registrada correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motorcycle $moto)
    {
        return view('admin.motos.edit', ['moto' => $moto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motorcycle $moto)
    {
        $request->validate([
            'placa' => 'required|string|unique:motorcycles,placa,' . $moto->id,
            'nombre_propietario' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email',
            'marca' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($moto->foto) {
                \Storage::disk('public')->delete($moto->foto);
            }
            $data['foto'] = $request->file('foto')->store('motos', 'public');
        }

        $moto->update($data);

        return redirect()->route('motos.index')
            ->with('success', 'Motocicleta actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motorcycle $moto)
    {
        if ($moto->foto) {
            \Storage::disk('public')->delete($moto->foto);
        }

        $moto->delete();

        return redirect()->route('motos.index')
            ->with('success', 'Motocicleta eliminada correctamente');
    }

    /**
     * Buscar motocicleta por placa
     */
    public function buscar(Request $request)
    {
        $request->validate(['placa' => 'required|string']);
        
        $moto = Motorcycle::where('placa', $request->placa)->first();

        if (!$moto) {
            return redirect()->back()->with('error', 'Motocicleta no encontrada');
        }

        return view('admin.motos.buscar', ['moto' => $moto]);
    }
}

