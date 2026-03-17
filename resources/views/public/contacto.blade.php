@extends('layouts.public')

@section('content')
<div class="space-y-12">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Contacto</h2>
        <p class="text-gray-600 text-lg">¿Tienes preguntas? Ponte en contacto con nosotros</p>
    </div>

    <!-- Información de contacto -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-lg shadow p-6 text-center hover:shadow-lg transition">
            <i class="fas fa-map-marker-alt text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Ubicación</h3>
            <p class="text-gray-600">{{ $direccion ?? 'Calle 123' }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center hover:shadow-lg transition">
            <i class="fas fa-phone text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Teléfono</h3>
            <p class="text-gray-600">{{ $telefono ?? '+57 300 000 0000' }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center hover:shadow-lg transition">
            <i class="fas fa-envelope text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Correo</h3>
            <p class="text-gray-600">{{ $correo ?? 'info@parqueadero.com' }}</p>
        </div>
    </div>

    <!-- Detalles de ubicación -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <!-- Mapa (simulado) -->
        <div class="bg-gray-200 rounded-lg shadow h-96 flex items-center justify-center">
            <div class="text-center">
                <i class="fas fa-map text-6xl text-gray-400 mb-4"></i>
                <p class="text-gray-600">Mapa interactivo</p>
                <p class="text-sm text-gray-500">{{ $direccion ?? 'Calle Principal 123' }}</p>
            </div>
        </div>

        <!-- Horarios -->
        <div class="bg-white rounded-lg shadow p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Horario de Atención</h3>
            
            <div class="space-y-4">
                <div class="border-l-4 border-blue-600 pl-4">
                    <p class="font-bold text-gray-900">Lunes a Viernes</p>
                    <p class="text-gray-600">6:00 AM - 11:00 PM</p>
                </div>

                <div class="border-l-4 border-blue-600 pl-4">
                    <p class="font-bold text-gray-900">Sábado</p>
                    <p class="text-gray-600">7:00 AM - 8:00 PM</p>
                </div>

                <div class="border-l-4 border-blue-600 pl-4">
                    <p class="font-bold text-gray-900">Domingo</p>
                    <p class="text-gray-600">8:00 AM - 8:00 PM</p>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded p-4 mt-6">
                    <p class="text-sm text-blue-800">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Nota:</strong> En días festivos nuestro horario puede variar. Por favor contacta con nosotros.
                    </p>
                </div>
            </div>

            <!-- Links de contacto -->
            <div class="mt-8 pt-6 border-t border-gray-200 space-y-2">
                <a href="tel:{{ str_replace([' ', '+'], '', $telefono ?? '+57 300 000 0000') }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition">
                    <i class="fas fa-phone mr-2"></i>Llamar
                </a>
                <a href="mailto:{{ $correo ?? 'info@parqueadero.com' }}" class="block text-center bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-lg transition">
                    <i class="fas fa-envelope mr-2"></i>Enviar Correo
                </a>
            </div>
        </div>
    </div>

    <!-- Formulario de contacto -->
    <div class="bg-white rounded-lg shadow p-8 max-w-2xl mx-auto">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Envíanos un Mensaje</h3>

        <form class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre*</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Correo*</label>
                    <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                <input type="tel" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Asunto*</label>
                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje*</label>
                <textarea rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition">
                <i class="fas fa-paper-plane mr-2"></i>Enviar Mensaje
            </button>
        </form>

        <p class="text-sm text-gray-600 text-center mt-4">Te responderemos en el menor tiempo posible</p>
    </div>

    <!-- Preguntas frecuentes -->
    <div class="bg-gray-50 rounded-lg p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Preguntas Frecuentes</h3>

        <div class="space-y-4">
            <details class="bg-white rounded-lg shadow p-4 cursor-pointer">
                <summary class="font-bold text-gray-900 flex justify-between items-center">
                    ¿Cuál es el horario de atención?
                    <span>+</span>
                </summary>
                <p class="text-gray-600 mt-4">Estamos abiertos de 6 AM a 8 PM de lunes a viernes, sábados de 7 AM a 8 PM y domingos de 8 AM a 6 PM.</p>
            </details>

            <details class="bg-white rounded-lg shadow p-4 cursor-pointer">
                <summary class="font-bold text-gray-900 flex justify-between items-center">
                    ¿Qué métodos de pago aceptan?
                    <span>+</span>
                </summary>
                <p class="text-gray-600 mt-4">Aceptamos efectivo, tarjetas de crédito/débito y transferencias bancarias.</p>
            </details>

            <details class="bg-white rounded-lg shadow p-4 cursor-pointer">
                <summary class="font-bold text-gray-900 flex justify-between items-center">
                    ¿Hay vigilancia física?
                    <span>+</span>
                </summary>
                <p class="text-gray-600 mt-4">Sí, contamos con personal de vigilancia y cámaras de seguridad disponibles 24/7.</p>
            </details>

            <details class="bg-white rounded-lg shadow p-4 cursor-pointer">
                <summary class="font-bold text-gray-900 flex justify-between items-center">
                    ¿Puedo cancelar mi plan?
                    <span>+</span>
                </summary>
                <p class="text-gray-600 mt-4">Sí, puedes cancelar tu plan en cualquier momento sin penalización contactando con nosotros directamente.</p>
            </details>
        </div>
    </div>
</div>
@endsection
