<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $nombreParqueadero ?? 'Parqueadero Premium' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <nav class="bg-white shadow">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">
                <i class="fas fa-motorcycle"></i> {{ $nombreParqueadero ?? 'Parqueadero Premium' }}
            </h1>
            <div class="space-x-4">
                <a href="{{ route('public.inicio') }}" class="text-gray-700 hover:text-blue-600">Inicio</a>
                <a href="{{ route('public.tarifas') }}" class="text-gray-700 hover:text-blue-600">Tarifas</a>
                <a href="{{ route('public.disponibilidad') }}" class="text-gray-700 hover:text-blue-600">Disponibilidad</a>
                <a href="{{ route('public.contacto') }}" class="text-gray-700 hover:text-blue-600">Contacto</a>
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Administración</a>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-6 mt-12">
        <p>&copy; 2026 {{ $nombreParqueadero ?? 'Parqueadero Premium' }}. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
