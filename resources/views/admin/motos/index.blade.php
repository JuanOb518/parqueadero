@extends('layouts.app')

@section('title', 'Motocicletas - Parqueadero')
@section('heading', 'Gestión de Motocicletas')

@section('content')
<div class="mb-6 bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold text-gray-800">Buscar Motocicleta</h3>
    </div>
    <form method="GET" action="{{ route('motos.buscar') }}" class="flex space-x-2">
        <input type="text" name="placa" placeholder="Ingresa la placa" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Motocicletas Registradas</h3>
        <a href="{{ route('motos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Nueva Moto</span>
        </a>
    </div>

    @if($motos->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Placa</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Propietario</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Marca</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Color</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Teléfono</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Foto</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($motos as $moto)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $moto->placa }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $moto->nombre_propietario }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $moto->marca }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $moto->color }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $moto->telefono }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($moto->foto)
                                    <a href="{{ Storage::url($moto->foto) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-image"></i>
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('motos.edit', $moto) }}" class="inline-block px-3 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded text-sm transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('motos.destroy', $moto) }}" class="inline-block" onsubmit="return confirm('¿Eliminar motocicleta?')">
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
            <i class="fas fa-motorcycle text-3xl text-gray-400 mb-2"></i>
            <p>No hay motocicletas registradas</p>
        </div>
    @endif
</div>
@endsection
