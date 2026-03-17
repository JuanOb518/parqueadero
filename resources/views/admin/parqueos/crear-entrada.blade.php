@extends('layouts.app')

@section('title', 'Registrar Entrada - Parqueadero')
@section('heading', 'Registrar Entrada de Motocicleta')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <div class="mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
            <p><strong>Espacios disponibles:</strong> <span id="espacios-disponibles">{{ $disponibles }}</span></p>
        </div>

        @if($disponibles <= 0)
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <i class="fas fa-exclamation-triangle"></i> El parqueadero está lleno. No se pueden registrar nuevas entradas.
            </div>
        @endif

        <form id="form-entrada" method="POST" action="{{ route('parqueos.store') }}" class="space-y-6">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Alerta si parqueadero está lleno
    @if($disponibles <= 0)
        Swal.fire({
            title: '<i class="fas fa-parking" style="color: #ef4444;"></i> Parqueadero Lleno',
            html: '<p style="font-size: 1rem; color: #374151;">No hay espacios disponibles en este momento.</p><p style="font-size: 0.875rem; color: #6b7280; margin-top: 8px;">Intenta más tarde cuando haya espacios disponibles.</p>',
            icon: 'warning',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#ef4444',
            allowOutsideClick: false
        });
    @endif

    // Alerta si espacios están por agotarse
    @if($disponibles > 0 && $disponibles <= 5)
        Swal.fire({
            title: '<i class="fas fa-exclamation-circle" style="color: #f59e0b;"></i> Espacios Limitados',
            html: '<p style="font-size: 1rem; color: #374151;">Solo quedan <strong>{{ $disponibles }}</strong> espacio(s) disponible(s).</p>',
            icon: 'info',
            confirmButtonText: 'Continuar',
            confirmButtonColor: '#f59e0b'
        });
    @endif

    // Confirmación antes de registrar entrada
    const formEntrada = document.getElementById('form-entrada');
    formEntrada.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const placa = document.getElementById('placa').value.toUpperCase();
        const plan = document.getElementById('plan_id');
        const planNombre = plan.options[plan.selectedIndex].text || 'Sin plan (Por hora)';
        
        Swal.fire({
            title: '<i class="fas fa-check-circle" style="color: #10b981;"></i> Confirmar Entrada',
            html: `
                <div style="text-align: left; margin: 20px 0;">
                    <p><strong>Placa:</strong> <span style="color: #2563eb; font-weight: bold;">${placa}</span></p>
                    <p><strong>Plan:</strong> <span style="color: #059669;">${planNombre}</span></p>
                    <p style="font-size: 0.875rem; color: #6b7280; margin-top: 12px;"><i class="fas fa-info-circle"></i> Esto registrará la entrada de la motocicleta en el sistema.</p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, registrar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                formEntrada.submit();
            }
        });
    });
});
</script>
@endsection
