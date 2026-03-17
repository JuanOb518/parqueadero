@extends('layouts.app')

@section('title', 'Dashboard - Parqueadero')
@section('heading', 'Panel de Control')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Cards de estadísticas -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Motos Parqueadas</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $parkingActivos }}</h3>
            </div>
            <i class="fas fa-motorcycle text-blue-500 text-3xl opacity-20"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Espacios Disponibles</p>
                <h3 class="text-3xl font-bold text-green-600">{{ $espaciosDisponibles }}</h3>
            </div>
            <i class="fas fa-parking text-green-500 text-3xl opacity-20"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total de Espacios</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalSpots }}</h3>
            </div>
            <i class="fas fa-building text-purple-500 text-3xl opacity-20"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Ingresos Hoy</p>
                <h3 class="text-3xl font-bold text-orange-600">${{ number_format($ingresoHoy, 0, ',', '.') }}</h3>
            </div>
            <i class="fas fa-money-bill text-orange-500 text-3xl opacity-20"></i>
        </div>
    </div>
</div>

<!-- Acciones rápidas -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <a href="{{ route('parqueos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow p-6 flex items-center justify-between transition">
        <div>
            <h4 class="font-bold text-lg">Registrar Entrada</h4>
            <p class="text-blue-100">Nuevo ingreso</p>
        </div>
        <i class="fas fa-arrow-right text-2xl"></i>
    </a>

    <a href="{{ route('motos.create') }}" class="bg-green-600 hover:bg-green-700 text-white rounded-lg shadow p-6 flex items-center justify-between transition">
        <div>
            <h4 class="font-bold text-lg">Registrar Moto</h4>
            <p class="text-green-100">Nueva motocicleta</p>
        </div>
        <i class="fas fa-arrow-right text-2xl"></i>
    </a>

    <a href="{{ route('planes.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white rounded-lg shadow p-6 flex items-center justify-between transition">
        <div>
            <h4 class="font-bold text-lg">Crear Plan</h4>
            <p class="text-purple-100">Nuevo plan de pago</p>
        </div>
        <i class="fas fa-arrow-right text-2xl"></i>
    </a>
</div>

<!-- Motocicletas parqueadas -->
<div class="bg-white rounded-lg shadow mb-8">
    <div class="border-b border-gray-200 p-6">
        <h3 class="text-xl font-bold text-gray-800">Motocicletas Actualmente Parqueadas</h3>
    </div>
    <div class="overflow-x-auto">
        @if($motosParqueadas->count() > 0)
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Placa</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Propietario</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Hora Entrada</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tiempo</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Plan</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($motosParqueadas as $parqueo)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $parqueo->motorcycle->placa }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $parqueo->motorcycle->nombre_propietario }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $parqueo->hora_entrada->format('H:i') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ \App\Helpers\ParkingHelper::formatDuration($parqueo->hora_entrada, now()) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $parqueo->plan ? $parqueo->plan->nombre : 'Por hora' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('parqueos.edit', $parqueo) }}" class="inline-block px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded text-sm transition">
                                    <i class="fas fa-sign-out-alt"></i> Registrar Salida
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-6 text-center text-gray-600">
                <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                <p>No hay motocicletas parqueadas actualmente</p>
            </div>
        @endif
    </div>
</div>

<!-- Transacciones recientes -->
<div class="bg-white rounded-lg shadow">
    <div class="border-b border-gray-200 p-6">
        <h3 class="text-xl font-bold text-gray-800">Últimas Transacciones</h3>
    </div>
    <div class="overflow-x-auto">
        @if($ingresosRecientes->count() > 0)
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Placa</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Propietario</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Costo</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Pago</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Fecha</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($ingresosRecientes as $transaccion)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $transaccion->motorcycle->placa }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $transaccion->motorcycle->nombre_propietario }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-green-600">${{ number_format($transaccion->total_costo ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $transaccion->hora_salida ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $transaccion->hora_salida ? 'Pagado' : 'Pendiente' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $transaccion->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-6 text-center text-gray-600">
                <p>No hay transacciones registradas</p>
            </div>
        @endif
    </div>
</div>
@endsection
