@extends('layouts.public')

@section('content')
<div class="space-y-12">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg shadow-lg p-12 text-center">
        <h1 class="text-4xl font-bold mb-4">Bienvenido a {{ $nombreParqueadero ?? 'Parqueadero Premium' }}</h1>
        <p class="text-xl text-blue-100 mb-8">El mejor parqueadero para tu motocicleta</p>
        <div class="space-x-4">
            <a href="{{ route('public.disponibilidad') }}" class="inline-block bg-white text-blue-600 font-bold px-8 py-3 rounded-lg hover:bg-blue-50">Ver Disponibilidad</a>
            <a href="{{ route('public.tarifas') }}" class="inline-block bg-blue-700 text-white font-bold px-8 py-3 rounded-lg hover:bg-blue-900">Ver Tarifas</a>
        </div>
    </div>

    <!-- Características -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <i class="fas fa-shield-alt text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Seguridad</h3>
            <p class="text-gray-600">Tu motocicleta está completamente segura bajo vigilancia 24/7</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <i class="fas fa-clock text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Flexibilidad</h3>
            <p class="text-gray-600">Paga por hora, día o mes según tus necesidades</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <i class="fas fa-map-marker-alt text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Ubicación</h3>
            <p class="text-gray-600">Ubicados en el centro de la ciudad, de fácil acceso</p>
        </div>
    </div>

    <!-- Información de contacto -->
    <div class="bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">¿Dónde nos encontramos?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Ubicación</h3>
                <div class="space-y-3 text-gray-600">
                    <p>
                        <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                        <strong>Dirección:</strong> {{ $direccion ?? 'Calle Principal 123' }}
                    </p>
                    <p>
                        <i class="fas fa-phone text-blue-600 mr-2"></i>
                        <strong>Teléfono:</strong> {{ $telefono ?? '+57 300 000 0000' }}
                    </p>
                    <p>
                        <i class="fas fa-envelope text-blue-600 mr-2"></i>
                        <strong>Correo:</strong> {{ $correo ?? 'info@parqueadero.com' }}
                    </p>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Horario de Atención</h3>
                <div class="text-gray-600">
                    <p><strong>Lunes a Viernes:</strong> 6:00 AM - 11:00 PM</p>
                    <p><strong>Sábado:</strong> 7:00 AM - 8:00 PM</p>
                    <p><strong>Domingo:</strong> 8:00 AM - 8:00 PM</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-blue-600 text-white rounded-lg shadow p-8 text-center">
        <h2 class="text-2xl font-bold mb-4">¿Listo para parquear tu moto?</h2>
        <p class="text-lg mb-6">Visítanos hoy y disfruta de los mejores servicios de parqueo</p>
        <a href="{{ route('public.contacto') }}" class="inline-block bg-white text-blue-600 font-bold px-8 py-3 rounded-lg hover:bg-blue-50">Contáctanos</a>
    </div>
</div>
@endsection
