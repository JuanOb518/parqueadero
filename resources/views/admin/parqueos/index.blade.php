@extends('layouts.app')

@section('title', 'Parqueos Activos - Parqueadero')
@section('heading', 'Parqueos Activos')

@section('content')
<div class="mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
    <i class="fas fa-info-circle"></i> Aquí se muestran todas las motocicletas actualmente parqueadas.
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Listado de Parqueos Activos ({{ $parkingsActivos->total() }})</h3>
        <a href="{{ route('parqueos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Registrar Entrada</span>
        </a>
    </div>

    @if($parkingsActivos->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">#</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Placa</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Propietario</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Entrada</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tiempo</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Plan</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($parkingsActivos as $parqueo)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $parqueo->id }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $parqueo->motorcycle->placa }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $parqueo->motorcycle->nombre_propietario }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $parqueo->hora_entrada->format('H:i d/m') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ \App\Helpers\ParkingHelper::formatDuration($parqueo->hora_entrada, now()) }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($parqueo->plan)
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        {{ $parqueo->plan->nombre }}
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                        Por Hora
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('parqueos.edit', $parqueo) }}" class="inline-block px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded text-sm transition">
                                    <i class="fas fa-sign-out-alt"></i> Salida
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-gray-200">
            {{ $parkingsActivos->links() }}
        </div>
    @else
        <div class="p-6 text-center text-gray-600">
            <i class="fas fa-parking text-3xl text-green-500 mb-2"></i>
            <p>No hay motocicletas parqueadas en este momento</p>
        </div>
    @endif
</div>
@endsection
