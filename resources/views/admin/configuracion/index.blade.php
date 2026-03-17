@extends('layouts.app')

@section('title', 'Configuración - Parqueadero')
@section('heading', 'Configuración del Parqueadero')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8">
    <form method="POST" action="{{ route('settings.update') }}" class="space-y-6">
        @csrf

        <div class="border-b border-gray-200 pb-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Información General</h3>

            <div class="space-y-4">
                <div>
                    <label for="nombre_parqueadero" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Parqueadero*</label>
                    <input type="text" id="nombre_parqueadero" name="nombre_parqueadero" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('nombre_parqueadero') border-red-500 @enderror" value="{{ old('nombre_parqueadero', $settings['nombre_parqueadero'] ?? '') }}" required>
                    @error('nombre_parqueadero')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="direccion" class="block text-sm font-medium text-gray-700 mb-2">Dirección*</label>
                    <input type="text" id="direccion" name="direccion" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('direccion') border-red-500 @enderror" value="{{ old('direccion', $settings['direccion'] ?? '') }}" required>
                    @error('direccion')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">Teléfono*</label>
                    <input type="tel" id="telefono" name="telefono" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('telefono') border-red-500 @enderror" value="{{ old('telefono', $settings['telefono'] ?? '') }}" required>
                    @error('telefono')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="correo" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico*</label>
                    <input type="email" id="correo" name="correo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('correo') border-red-500 @enderror" value="{{ old('correo', $settings['correo'] ?? '') }}" required>
                    @error('correo')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="border-b border-gray-200 pb-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Configuración Operativa</h3>

            <div class="space-y-4">
                <div>
                    <label for="total_spots" class="block text-sm font-medium text-gray-700 mb-2">Total de Espacios de Parqueo*</label>
                    <input type="number" id="total_spots" name="total_spots" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('total_spots') border-red-500 @enderror" value="{{ old('total_spots', $settings['total_spots'] ?? '50') }}" min="1" required>
                    <p class="text-gray-500 text-sm mt-2">Número total de campos disponibles para motocicletas</p>
                    @error('total_spots')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="tarifa_por_hora" class="block text-sm font-medium text-gray-700 mb-2">Tarifa por Hora (sin plan)*</label>
                    <div class="relative">
                        <span class="absolute left-4 top-2 text-gray-600">$</span>
                        <input type="number" id="tarifa_por_hora" name="tarifa_por_hora" class="w-full pl-8 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('tarifa_por_hora') border-red-500 @enderror" value="{{ old('tarifa_por_hora', $settings['tarifa_por_hora'] ?? '500') }}" step="0.01" min="0" required>
                    </div>
                    <p class="text-gray-500 text-sm mt-2">Tarifa cobrada a usuarios sin plan de pago</p>
                    @error('tarifa_por_hora')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg text-sm text-blue-700">
            <i class="fas fa-info-circle"></i> <strong>Nota:</strong> Todos los cambios se aplicarán inmediatamente en el sistema.
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition">
                <i class="fas fa-save mr-2"></i>Guardar Configuración
            </button>
            <a href="{{ route('dashboard') }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 rounded-lg text-center transition">
                <i class="fas fa-times mr-2"></i>Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
