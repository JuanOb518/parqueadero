@extends('layouts.public')

@section('content')
<div class="space-y-12">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Disponibilidad en Tiempo Real</h2>
        <p class="text-gray-600 text-lg">Consulta el estado actual de nuestros espacios</p>
    </div>

    <!-- Indicadores principales -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 text-center border-t-4 border-blue-600">
            <p class="text-gray-600 text-sm mb-2">TOTAL DE ESPACIOS</p>
            <p class="text-4xl font-bold text-gray-900">{{ $totalSpots }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center border-t-4 border-orange-606">
            <p class="text-gray-600 text-sm mb-2">ESPACIOS OCUPADOS</p>
            <p class="text-4xl font-bold text-orange-600">{{ $parkingActivos }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center border-t-4 border-green-600">
            <p class="text-gray-600 text-sm mb-2">ESPACIOS DISPONIBLES</p>
            <p class="text-4xl font-bold text-green-600">{{ $disponibles }}</p>
        </div>
    </div>

    <!-- Barra de progreso visual -->
    <div class="bg-white rounded-lg shadow p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6">Uso del Parqueadero</h3>
        
        <div class="mb-6">
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>Ocupación</span>
                <span>{{ round(($parkingActivos / $totalSpots) * 100, 0) }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                <div 
                    class="bg-gradient-to-r from-green-500 to-red-500 h-full transition-all duration-300"
                    style="width: {{ ($parkingActivos / $totalSpots) * 100 }}%"
                ></div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div class="bg-green-50 p-4 rounded border border-green-200">
                <p class="font-bold text-green-700">{{ $disponibles }} espacios</p>
                <p class="text-green-600">disponibles ahora</p>
            </div>
            <div class="bg-orange-50 p-4 rounded border border-orange-200">
                <p class="font-bold text-orange-700">{{ $parkingActivos }} motos</p>
                <p class="text-orange-600">parqueadas en este momento</p>
            </div>
        </div>
    </div>

    <!-- Estado del parqueadero -->
    <div class="bg-white rounded-lg shadow p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6">Estado del Parqueadero</h3>
        
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 mb-2">Situación actual:</p>
                @if($disponibles > 0)
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 bg-green-500 rounded-full"></div>
                        <p class="text-lg font-bold text-green-600">ABIERTO - Hay espacios disponibles</p>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 bg-red-500 rounded-full animate-pulse"></div>
                        <p class="text-lg font-bold text-red-600">LLENO - No hay espacios disponibles</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Información adicional -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-8">
        <h3 class="text-lg font-bold text-blue-900 mb-4">
            <i class="fas fa-info-circle mr-2"></i> Información Importante
        </h3>
        <ul class="space-y-3 text-blue-800 text-sm">
            <li><i class="fas fa-check text-green-600 mr-2"></i> Esta información se actualiza automáticamente cada minuto</li>
            <li><i class="fas fa-check text-green-600 mr-2"></i> Si no hay espacios disponibles, puedes volver más tarde o contactarnos</li>
            <li><i class="fas fa-check text-green-600 mr-2"></i> Los planes mensuales te garantizan acceso prioritario</li>
            <li><i class="fas fa-check text-green-600 mr-2"></i> Para más información, contáctanos al teléfono que aparece en la página de inicio</li>
        </ul>
    </div>

    <!-- CTA -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg shadow p-8 text-center">
        <h2 class="text-2xl font-bold mb-4">¿Hay espacio disponible?</h2>
        <p class="text-blue-100 mb-6">Visítanos ahora y disfruta de nuestro servicio</p>
        <a href="{{ route('public.contacto') }}" class="inline-block bg-white text-blue-600 font-bold px-8 py-3 rounded-lg hover:bg-blue-50">Contacto</a>
    </div>
</div>
@endsection
