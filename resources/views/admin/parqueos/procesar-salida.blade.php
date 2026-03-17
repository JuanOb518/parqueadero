@extends('layouts.app')

@section('title', 'Procesar Salida - Parqueadero')
@section('heading', 'Procesar Salida de Motocicleta')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h3 class="text-2xl font-bold text-gray-900">{{ $parqueo->motorcycle->placa }}</h3>
            <p class="text-gray-600">{{ $parqueo->motorcycle->nombre_propietario }}</p>
        </div>

        <!-- Información del parqueo -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gray-50 p-6 rounded-lg">
                <h4 class="font-bold text-gray-800 mb-4">Datos del Parqueo</h4>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600">Hora de Entrada</p>
                        <p class="font-bold text-gray-900">{{ $parqueo->hora_entrada->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Hora de Salida</p>
                        <p class="font-bold text-gray-900">{{ now()->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Tiempo Parqueado</p>
                        <p class="font-bold text-gray-900">
                            {{ \App\Helpers\ParkingHelper::formatDurationUX($parqueo->hora_entrada, now()) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Cálculo de tarifa -->
            <div class="bg-blue-50 border border-blue-200 p-6 rounded-lg">
                <h4 class="font-bold text-gray-800 mb-4">Tarifa</h4>
                <div class="space-y-3 text-sm">
                    @if($parqueo->plan)
                        <div>
                            <p class="text-gray-600">Plan Contratado</p>
                            <p class="font-bold text-green-600">{{ $parqueo->plan->nombre }}</p>
                        </div>
                        <div class="border-t border-blue-200 pt-3">
                            <p class="text-gray-600">Costo Total</p>
                            <p class="text-2xl font-bold text-green-600">${{ number_format($parqueo->plan->precio, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Ya fue pagado al registrar la entrada</p>
                        </div>
                    @else
                        <div>
                            <p class="text-gray-600">Tarifa por Hora</p>
                            <p class="font-bold text-gray-900">${{ number_format($tarifaPorHora, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Horas a Cobrar</p>
                            <p class="font-bold text-gray-900">
                                @php
                                    $horas = $parqueo->hora_entrada->diffInHours(now());
                                    if ($horas < 1) $horas = 1;
                                    else $horas = ceil($horas);
                                    echo "{$horas} hora" . ($horas > 1 ? 's' : '');
                                @endphp
                            </p>
                        </div>
                        <div class="border-t border-blue-200 pt-3">
                            <p class="text-gray-600">Costo Total</p>
                            <p class="text-2xl font-bold text-orange-600">
                                ${{ number_format((ceil($parqueo->hora_entrada->diffInHours(now()) || 1) * $tarifaPorHora), 0, ',', '.') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Formulario de salida -->
        <form method="POST" action="{{ route('parqueos.update', $parqueo) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
                <h4 class="font-bold text-yellow-900 mb-3">Estado del Pago</h4>
                
                <div class="space-y-3">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="radio" name="pago" value="pagado" {{ old('pago', 'pagado') === 'pagado' ? 'checked' : '' }} class="w-4 h-4 text-green-600">
                        <span class="text-gray-700">
                            <strong>Pago Realizado</strong>
                            <p class="text-sm text-gray-600">El cliente ya ha pagado la tarifa</p>
                        </span>
                    </label>

                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="radio" name="pago" value="pendiente" {{ old('pago') === 'pendiente' ? 'checked' : '' }} class="w-4 h-4 text-yellow-600">
                        <span class="text-gray-700">
                            <strong>Pago Pendiente</strong>
                            <p class="text-sm text-gray-600">El cliente debe pagar aún</p>
                        </span>
                    </label>
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition">
                    <i class="fas fa-check-circle mr-2"></i>Registrar Salida
                </button>
                <a href="{{ route('parqueos.index') }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 rounded-lg text-center transition">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
            </div>
        </form>

        <div class="mt-8 p-4 bg-gray-50 rounded-lg text-sm text-gray-600">
            <p><strong>Nota:</strong> Asegúrate de que el cliente haya realizado el pago antes de marcar como "Pago Realizado".</p>
        </div>
    </div>
</div>
@endsection
