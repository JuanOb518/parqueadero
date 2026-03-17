@extends('layouts.app')

@section('title', 'Historial de Parqueos - Parqueadero')
@section('heading', 'Historial de Parqueos')

@section('content')
<div class="mb-6 bg-gray-100 rounded-lg shadow p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="text-center">
            <p class="text-gray-600 text-sm mb-2">Total de Registros</p>
            <p class="text-3xl font-bold text-gray-900">{{ $historial->total() }}</p>
        </div>
        <div class="text-center">
            <p class="text-gray-600 text-sm mb-2">Ingresos Totales</p>
            <p class="text-3xl font-bold text-green-600">${{ number_format($historial->sum('total_costo'), 0, ',', '.') }}</p>
        </div>
        <div class="text-center">
            <p class="text-gray-600 text-sm mb-2">Pagos Pendientes</p>
            <p class="text-3xl font-bold text-orange-600">${{ number_format($historial->where('pago', 'pendiente')->sum('total_costo'), 0, ',', '.') }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-800">Registros de Salida</h3>
    </div>

    @if($historial->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600">Placa</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600">Propietario</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600">Entrada</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600">Salida</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600">Duración</th>
                        <th class="px-6 py-3 text-right font-semibold text-gray-600">Costo</th>
                        <th class="px-6 py-3 text-center font-semibold text-gray-600">Pago</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($historial as $registro)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $registro->motorcycle->placa }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ Str::limit($registro->motorcycle->nombre_propietario, 20) }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $registro->hora_entrada->format('d/m H:i') }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $registro->hora_salida->format('d/m H:i') }}</td>
                            <td class="px-6 py-4 text-gray-600">
                                <span title="{{ \App\Helpers\ParkingHelper::formatDurationUX($registro->hora_entrada, $registro->hora_salida) }}">
                                    {{ \App\Helpers\ParkingHelper::formatDuration($registro->hora_entrada, $registro->hora_salida) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold">
                                @if($registro->total_costo > 0)
                                    <span class="text-green-600">${{ number_format($registro->total_costo, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-gray-600">Plan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $registro->pago === 'pagado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($registro->pago) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-gray-200">
            {{ $historial->links() }}
        </div>
    @else
        <div class="p-6 text-center text-gray-600">
            <i class="fas fa-history text-3xl text-gray-400 mb-2"></i>
            <p>No hay registros de salida aún</p>
        </div>
    @endif
</div>
@endsection
