@extends('layouts.app')

@section('title', 'Planes - Parqueadero')
@section('heading', 'Gestión de Planes')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Planes de Pago</h3>
        <a href="{{ route('planes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Nuevo Plan</span>
        </a>
    </div>

    @if($planes->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nombre</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Duración</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-600">Precio</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Descripción</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($planes as $plan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $plan->nombre }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    @switch($plan->duracion)
                                        @case('mes')
                                            Mes
                                            @break
                                        @case('dia')
                                            Día
                                            @break
                                        @case('hora')
                                            Hora
                                            @break
                                    @endswitch
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-right text-gray-900">${{ number_format($plan->precio, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($plan->descripcion, 50) }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('planes.edit', $plan) }}" class="inline-block px-3 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded text-sm transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('planes.destroy', $plan) }}" class="inline-block" onsubmit="return confirm('¿Eliminar plan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded text-sm transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-6 text-center text-gray-600">
            <i class="fas fa-inbox text-3xl text-gray-400 mb-2"></i>
            <p>No hay planes registrados</p>
        </div>
    @endif
</div>
@endsection
