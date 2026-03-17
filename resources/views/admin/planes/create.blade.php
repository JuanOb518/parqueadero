@extends('layouts.app')

@section('title', 'Crear Plan - Parqueadero')
@section('heading', 'Crear Nuevo Plan')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8">
    <form method="POST" action="{{ route('planes.store') }}" class="space-y-6">
        @csrf

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Plan*</label>
            <input type="text" id="nombre" name="nombre" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('nombre') border-red-500 @enderror" value="{{ old('nombre') }}" required>
            @error('nombre')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="duracion" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Duración*</label>
            <select id="duracion" name="duracion" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('duracion') border-red-500 @enderror" required>
                <option value="">Selecciona una duración</option>
                <option value="mes" {{ old('duracion') === 'mes' ? 'selected' : '' }}>Mes</option>
                <option value="dia" {{ old('duracion') === 'dia' ? 'selected' : '' }}>Día</option>
                <option value="hora" {{ old('duracion') === 'hora' ? 'selected' : '' }}>Hora</option>
            </select>
            @error('duracion')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">Precio*</label>
            <div class="relative">
                <span class="absolute left-4 top-2 text-gray-600">$</span>
                <input type="number" id="precio" name="precio" class="w-full pl-8 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('precio') border-red-500 @enderror" value="{{ old('precio') }}" step="0.01" min="0" required>
            </div>
            @error('precio')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
            @error('descripcion')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition">
                <i class="fas fa-save mr-2"></i>Crear Plan
            </button>
            <a href="{{ route('planes.index') }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 rounded-lg text-center transition">
                <i class="fas fa-times mr-2"></i>Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
