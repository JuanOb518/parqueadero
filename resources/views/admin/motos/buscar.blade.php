@extends('layouts.app')

@section('title', 'Resultado de Búsqueda - Parqueadero')
@section('heading', 'Resultado de Búsqueda de Motocicleta')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8 mb-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-900">{{ $moto->placa }}</h3>
            <a href="{{ route('motos.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                @if($moto->foto)
                    <img src="{{ Storage::url($moto->foto) }}" alt="{{ $moto->placa }}" class="w-full h-64 object-cover rounded-lg shadow">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                        <i class="fas fa-image text-4xl text-gray-400"></i>
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">PROPIETARIO</p>
                    <p class="text-gray-900 font-bold">{{ $moto->nombre_propietario }}</p>
                </div>

                <div>
                    <p class="text-gray-600 text-sm font-semibold">MARCA</p>
                    <p class="text-gray-900 font-bold">{{ $moto->marca }}</p>
                </div>

                <div>
                    <p class="text-gray-600 text-sm font-semibold">COLOR</p>
                    <p class="text-gray-900 font-bold">{{ $moto->color }}</p>
                </div>

                <div>
                    <p class="text-gray-600 text-sm font-semibold">TELÉFONO</p>
                    <p class="text-gray-900 font-bold">{{ $moto->telefono }}</p>
                </div>

                <div>
                    <p class="text-gray-600 text-sm font-semibold">CORREO</p>
                    <p class="text-gray-900 font-bold">{{ $moto->correo }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 flex space-x-4">
            <a href="{{ route('motos.edit', $moto) }}" class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 rounded-lg text-center transition">
                <i class="fas fa-edit mr-2"></i>Editar
            </a>
            <form method="POST" action="{{ route('motos.destroy', $moto) }}" class="flex-1" onsubmit="return confirm('¿Eliminar motocicleta?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition">
                    <i class="fas fa-trash mr-2"></i>Eliminar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
