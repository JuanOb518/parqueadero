<section>
    <header class="mb-6">
        <p class="text-gray-600 text-sm leading-relaxed">
            <i class="fas fa-shield-alt me-2" style="color: #f59e0b;"></i>
            Para mantener tu cuenta segura, usa una contraseña larga y aleatoria. Evita contraseñas que uses en otros sitios.
        </p>
    </header>

    <form id="password-form" method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Contraseña Actual -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-key me-1" style="color: #f59e0b;"></i>Contraseña Actual *
            </label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('updatePassword.current_password') border-red-500 @enderror" autocomplete="current-password" placeholder="Ingresa tu contraseña actual">
            @error('updatePassword.current_password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nueva Contraseña -->
        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-lock me-1" style="color: #f59e0b;"></i>Nueva Contraseña *
            </label>
            <input id="update_password_password" name="password" type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('updatePassword.password') border-red-500 @enderror" autocomplete="new-password" placeholder="Crea una contraseña nueva y segura">
            @error('updatePassword.password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
            <p class="text-xs text-gray-500 mt-2">
                <i class="fas fa-lightbulb me-1"></i>Usa al menos 8 caracteres, incluyendo mayúsculas, minúsculas y números.
            </p>
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-lock-open me-1" style="color: #f59e0b;"></i>Confirmar Contraseña *
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('updatePassword.password_confirmation') border-red-500 @enderror" autocomplete="new-password" placeholder="Repite tu nueva contraseña">
            @error('updatePassword.password_confirmation')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones de acción -->
        <div class="flex items-center gap-4 pt-4">
            <button type="button" onclick="confirmPasswordUpdate(document.getElementById('password-form'))" class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg transition transform hover:scale-105">
                <i class="fas fa-save me-2"></i>Actualizar Contraseña
            </button>

            @if (session('status') === 'password-updated')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: '<i class="fas fa-check-circle" style="color: #10b981;"></i> Contraseña Actualizada',
                            text: 'Tu contraseña ha sido cambiada exitosamente.',
                            icon: 'success',
                            confirmButtonText: 'Continuar',
                            confirmButtonColor: '#10b981',
                            timer: 3000,
                            timerProgressBar: true
                        });
                    });
                </script>
            @endif
        </div>
    </form>

    <script>
    function confirmPasswordUpdate(form) {
        const current = document.getElementById('update_password_current_password').value;
        const newPass = document.getElementById('update_password_password').value;
        const confirm = document.getElementById('update_password_password_confirmation').value;

        if (!current || !newPass || !confirm) {
            Swal.fire({
                title: '<i class="fas fa-exclamation-circle" style="color: #ef4444;"></i> Campos Requeridos',
                text: 'Por favor completa todos los campos.',
                icon: 'error',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#ef4444'
            });
            return;
        }

        if (newPass !== confirm) {
            Swal.fire({
                title: '<i class="fas fa-times-circle" style="color: #ef4444;"></i> Contraseñas No Coinciden',
                text: 'La nueva contraseña y su confirmación no son iguales.',
                icon: 'error',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#ef4444'
            });
            return;
        }

        if (newPass.length < 8) {
            Swal.fire({
                title: '<i class="fas fa-shield-alt" style="color: #f59e0b;"></i> Contraseña Débil',
                text: 'La contraseña debe tener al menos 8 caracteres.',
                icon: 'warning',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#f59e0b'
            });
            return;
        }

        Swal.fire({
            title: '<i class="fas fa-lock" style="color: #f59e0b;"></i> Cambiar Contraseña',
            html: '<p style="font-size: 1rem; color: #374151;">¿Estás seguro de que deseas cambiar tu contraseña?</p><p style="font-size: 0.875rem; color: #6b7280; margin-top: 8px;"><i class="fas fa-info-circle"></i> Deberás iniciar sesión nuevamente después del cambio.</p>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, cambiar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#f59e0b',
            cancelButtonColor: '#6b7280',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
    </script>
</section>
