@extends('layouts.app')

@section('title', 'Registrar Entrada - Parqueadero')
@section('heading', 'Registrar Entrada de Motocicleta')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <div class="mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
            <p><strong>Espacios disponibles:</strong> {{ $disponibles; }}</p>
        </div>

        @if($disponibles <= 0)
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <i class="fas fa-exclamation-triangle"></i> El parqueadero está lleno. No se pueden registrar nuevas entradas.
            </div>
        @endif

        <form method="POST" action="{{ route('parqueos.store') }}" class="space-y-6" {{ $disponibles <= 0 ? 'disabled' : '' }}>
            @csrf

            <div>
                <label for="placa" class="block text-sm font-medium text-gray-700 mb-2">Placa de la Motocicleta*</label>
                <input type="text" id="placa" name="placa" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 uppercase @error('placa') border-red-500 @enderror" value="{{ old('placa') }}" placeholder="ABC 123" required {{ $disponibles <= 0 ? 'disabled' : '' }}>
                <p class="text-gray-500 text-sm mt-2">Ingresa la placa de la motocicleta que está entrando</p>
                @error('placa')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="plan_id" class="block text-sm font-medium text-gray-700 mb-2">Plan de Pago (Opcional)</label>
                <select id="plan_id" name="plan_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('plan_id') border-red-500 @enderror" {{ $disponibles <= 0 ? 'disabled' : '' }}>
                    <option value="">Sin plan (Tarifa por hora)</option>
                    @foreach($planes as $plan)
                        <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                            {{ $plan->nombre }} - ${{ number_format($plan->precio, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('plan_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="font-bold text-gray-800 mb-4">Información del Sistema</h4>
                <div class="space-y-2 text-sm text-gray-600">
                    <p><strong>Hora actual:</strong> {{ now()->format('H:i d/m/Y') }}</p>
                    <p><strong>Total de espacios:</strong> {{ $disponibles + \App\Models\Parking::whereNull('hora_salida')->count() }}</p>
                    <p><strong>Espacios ocupados:</strong> {{ \App\Models\Parking::whereNull('hora_salida')->count() }}</p>
                    <p><strong>Espacios disponibles:</strong> <span class="font-bold text-green-600">{{ $disponibles }}</span></p>
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition disabled:bg-gray-400 disabled:cursor-not-allowed" {{ $disponibles <= 0 ? 'disabled' : '' }}>
                    <i class="fas fa-sign-in-alt mr-2"></i>Registrar Entrada
                </button>
                <a href="{{ route('parqueos.index') }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 rounded-lg text-center transition">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

@include('components.validation-alerts')
@endsection
