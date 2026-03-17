@extends('layouts.public')

@section('content')
<div class="space-y-12">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nuestras Tarifas</h2>
        <p class="text-gray-600 text-lg">Elige el plan que mejor se adapte a tus necesidades</p>
    </div>

    <!-- Planes -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        @forelse($planes ?? [] as $plan)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:scale-105">
                <div class="bg-blue-600 text-white p-6 text-center">
                    <h3 class="text-2xl font-bold">{{ $plan->nombre }}</h3>
                    <p class="text-blue-100 text-sm mt-2">
                        @switch($plan->duracion)
                            @case('mes')
                                Acceso mensual
                            @break
                            @case('dia')
                                Acceso diario
                            @break
                            @case('hora')
                                Acceso por hora
                            @break
                        @endswitch
                    </p>
                </div>

                <div class="p-6">
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold text-blue-600">${{ number_format($plan->precio, 0, ',', '.') }}</span>
                        <p class="text-gray-600 text-sm mt-2">
                            @switch($plan->duracion)
                                @case('mes')
                                    Por mes
                                @break
                                @case('dia')
                                    Por día
                                @break
                                @case('hora')
                                    Por hora
                                @break
                            @endswitch
                        </p>
                    </div>

                    <p class="text-gray-600 text-center mb-6">{{ $plan->descripcion }}</p>

                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition">
                        Seleccionar
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-600">
            </div>
        @endforelse
    </div>

    <!-- Tarifa por uso -->
    <div class="bg-gray-50 rounded-lg shadow p-8 border border-gray-200">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Tarifa Sin Plan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <p class="text-gray-600 mb-4">Si prefieres no contratar un plan, puedes pagar por la hora que uses el parqueadero.</p>
                <div class="bg-white rounded-lg p-6 border-2 border-blue-600">
                    <p class="text-gray-600 text-sm mb-2">Tarifa por Hora</p>
                    <p class="text-4xl font-bold text-blue-600">${{ number_format($tarifaPorHora ?? 2200, 0, ',', '.') }}</p>
                    <p class="text-gray-600 text-sm mt-2">Se cobra fracción de hora como hora completa</p>
                </div>
            </div>

            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                <h4 class="font-bold text-gray-900 mb-4">Ejemplos de cálculo:</h4>
                <div class="space-y-2 text-sm text-gray-700">
                    <p><i class="fas fa-check text-green-600 mr-2"></i> < 1 hora: ${{ number_format($tarifaPorHora ?? 2200, 0, ',', '.') }}</p>
                    <p><i class="fas fa-check text-green-600 mr-2"></i> 3 horas: ${{ number_format(($tarifaPorHora ?? 2200) * 3, 0, ',', '.') }}</p>
                    <p><i class="fas fa-check text-green-600 mr-2"></i> 5 horas: ${{ number_format(($tarifaPorHora ?? 2200) * 5, 0, ',', '.') }}</p>
                    <p><i class="fas fa-check text-green-600 mr-2"></i> 6+ horas: $12.000 (tarifa día completo)</p>
                </div>
            </div>
                    <p><i class="fas fa-check text-green-600 mr-2"></i> 30 minutos: ${{ number_format($tarifaPorHora ?? 500, 0, ',', '.') }} (se cobra 1 hora)</p>
                    <p><i class="fas fa-check text-green-600 mr-2"></i> 24 horas: ${{ number_format(($tarifaPorHora ?? 500) * 24, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Ventajas de los planes -->
    <div class="bg-white rounded-lg shadow p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Ventajas de Contratar un Plan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-start space-x-4">
                <i class="fas fa-check-circle text-green-600 text-2xl mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900">Ahorro Garantizado</h4>
                    <p class="text-gray-600 text-sm">Paga menos que usando la tarifa por hora</p>
                </div>
            </div>

            <div class="flex items-start space-x-4">
                <i class="fas fa-check-circle text-green-600 text-2xl mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900">Acceso Ilimitado</h4>
                    <p class="text-gray-600 text-sm">Entra y sale cuantas veces quieras</p>
                </div>
            </div>

            <div class="flex items-start space-x-4">
                <i class="fas fa-check-circle text-green-600 text-2xl mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900">Sin Sorpresas</h4>
                    <p class="text-gray-600 text-sm">Precio fijo durante el período contratado</p>
                </div>
            </div>

            <div class="flex items-start space-x-4">
                <i class="fas fa-check-circle text-green-600 text-2xl mt-1"></i>
                <div>
                    <h4 class="font-bold text-gray-900">Renovación Fácil</h4>
                    <p class="text-gray-600 text-sm">Renueva tu plan cuando lo necesites</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
