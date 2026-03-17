<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                <i class="fas fa-user-circle me-3" style="color: #2563eb;"></i>Mi Perfil
            </h2>
            <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Card: Información del Perfil -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-user-edit me-2"></i>Información Personal
                    </h3>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Card: Cambiar Contraseña -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-lock me-2"></i>Seguridad - Cambiar Contraseña
                    </h3>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Card: Información de la Cuenta -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-info-circle me-2"></i>Información de la Cuenta
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Estado de Verificación -->
                        <div class="border-l-4 border-purple-500 pl-4">
                            <p class="text-sm text-gray-600 font-semibold mb-1">
                                <i class="fas fa-check-circle me-1" style="color: #8b5cf6;"></i>Estado de Verificación
                            </p>
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <p class="text-lg font-bold text-orange-600">
                                    <i class="fas fa-exclamation-circle me-1"></i>Pendiente de Verificación
                                </p>
                                <p class="text-xs text-gray-500 mt-1">Verifica tu correo para acceso completo</p>
                            @else
                                <p class="text-lg font-bold text-green-600">
                                    <i class="fas fa-check-circle me-1"></i>Verificado
                                </p>
                                <p class="text-xs text-gray-500 mt-1">Tu cuenta está completamente activada</p>
                            @endif
                        </div>

                        <!-- Rol de Usuario -->
                        <div class="border-l-4 border-purple-500 pl-4">
                            <p class="text-sm text-gray-600 font-semibold mb-1">
                                <i class="fas fa-user-tag me-1" style="color: #8b5cf6;"></i>Rol de Usuario
                            </p>
                            @if (Auth::user()->email === 'admin@parqueadero.com')
                                <p class="text-lg font-bold text-blue-600">
                                    <i class="fas fa-shield-alt me-1"></i>Administrador
                                </p>
                                <p class="text-xs text-gray-500 mt-1">Acceso completo al sistema</p>
                            @else
                                <p class="text-lg font-bold text-gray-700">
                                    <i class="fas fa-user me-1"></i>Usuario Regular
                                </p>
                                <p class="text-xs text-gray-500 mt-1">Acceso a funciones básicas</p>
                            @endif
                        </div>

                        <!-- Fecha de Registro -->
                        <div class="border-l-4 border-purple-500 pl-4">
                            <p class="text-sm text-gray-600 font-semibold mb-1">
                                <i class="fas fa-calendar-alt me-1" style="color: #8b5cf6;"></i>Miembro Desde
                            </p>
                            <p class="text-lg font-bold text-gray-800">
                                {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                            </p>
                        </div>

                        <!-- Última Actualización -->
                        <div class="border-l-4 border-purple-500 pl-4">
                            <p class="text-sm text-gray-600 font-semibold mb-1">
                                <i class="fas fa-sync-alt me-1" style="color: #8b5cf6;"></i>Última Actualización
                            </p>
                            <p class="text-lg font-bold text-gray-800">
                                {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <!-- Acciones Rápidas -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-bolt me-1" style="color: #8b5cf6;"></i>Acciones Rápidas
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 bg-purple-100 hover:bg-purple-200 text-purple-700 rounded-lg transition font-semibold">
                                <i class="fas fa-chart-line me-2"></i>Ir al Dashboard
                            </a>
                            <button type="button" onclick="location.reload()" class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition font-semibold">
                                <i class="fas fa-sync-alt me-2"></i>Refrescar Datos
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Eliminar Cuenta -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-trash-alt me-2"></i>Zona de Peligro
                    </h3>
                </div>
                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Nota de Seguridad -->
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6 flex gap-4">
                <div class="flex-shrink-0">
                    <i class="fas fa-shield-alt text-blue-600 text-2xl mt-1"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-blue-900 mb-1">
                        <i class="fas fa-lock me-2"></i>Consejos de Seguridad
                    </h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>✓ Usa una contraseña única y segura que no uses en otros sitios</li>
                        <li>✓ Verifica tu correo electrónico regularmente por cambios de seguridad</li>
                        <li>✓ No compartas tu contraseña con nadie</li>
                        <li>✓ Usa contraseñas con mayúsculas, minúsculas, números y caracteres especiales</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('components.validation-alerts')
</x-app-layout>
