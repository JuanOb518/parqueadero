<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Parqueadero'))</title>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='48' fill='%232563eb'/><path d='M25 55 L35 40 L40 45 L50 35 L60 45 L65 40 L75 55 M30 60 Q30 70 40 70 Q50 70 50 60 M60 70 Q50 70 50 60' stroke='white' stroke-width='3' fill='none' stroke-linecap='round' stroke-linejoin='round'/></svg>">
        <link rel="apple-touch-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 180 180'><circle cx='90' cy='90' r='88' fill='%232563eb'/><path d='M45 100 L63 72 L72 81 L90 63 L108 81 L117 72 L135 100 M54 108 Q54 126 72 126 Q90 126 90 108 M108 126 Q90 126 90 108' stroke='white' stroke-width='5' fill='none' stroke-linecap='round' stroke-linejoin='round'/></svg>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --bs-primary: #2563eb;
                --bs-secondary: #6b7280;
                --bs-success: #10b981;
                --bs-danger: #ef4444;
                --bs-warning: #f59e0b;
                --bs-info: #0ea5e9;
            }

            body {
                background-color: #f3f4f6;
            }

            .navbar {
                background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%) !important;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }

            .navbar-brand {
                font-weight: 700;
                font-size: 1.5rem;
                transition: all 0.3s ease;
            }

            .navbar-brand:hover {
                transform: scale(1.05);
            }

            .btn {
                font-weight: 600;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
            }

            .btn-primary {
                background-color: #2563eb;
                border-color: #2563eb;
            }

            .btn-primary:hover {
                background-color: #1e40af;
                border-color: #1e40af;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            }

            .btn-success {
                background-color: #10b981;
                border-color: #10b981;
            }

            .btn-success:hover {
                background-color: #059669;
                border-color: #059669;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            }

            .btn-warning {
                background-color: #f59e0b;
                border-color: #f59e0b;
            }

            .btn-warning:hover {
                background-color: #d97706;
                border-color: #d97706;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
            }

            .btn-danger {
                background-color: #ef4444;
                border-color: #ef4444;
            }

            .btn-danger:hover {
                background-color: #dc2626;
                border-color: #dc2626;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            }

            .btn-sm {
                font-size: 0.875rem;
                padding: 0.375rem 0.75rem;
            }

            .card {
                border: none;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                border-radius: 0.75rem;
                transition: all 0.3s ease;
            }

            .card:hover {
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transform: translateY(-2px);
            }

            .table {
                font-size: 0.95rem;
            }

            .badge {
                padding: 0.5rem 0.75rem;
                font-weight: 600;
            }

            .sidebar {
                background: #fff;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                border-radius: 0.75rem;
                overflow: hidden;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <div class="container-fluid py-4">
                <!-- Page Heading -->
                @isset($header)
                    <header class="mb-4">
                        <div class="bg-white rounded-lg shadow-sm p-4">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    @yield('content')
                </main>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
