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
        </div>
    </div>

    @include('components.validation-alerts')
</x-app-layout>
