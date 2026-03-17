<section class="space-y-6">
    <header class="mb-6">
        <p class="text-red-600 text-sm leading-relaxed font-semibold">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Una vez que deletes tu cuenta, todos tus datos serán eliminados permanentemente. Esta acción no se puede deshacer.
        </p>
    </header>

    <button type="button" onclick="showDeleteAccountWarning()" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition transform hover:scale-105">
        <i class="fas fa-trash-alt me-2"></i>Eliminar Mi Cuenta
    </button>

    <!-- Modal Modal para confirmación de eliminación -->
    <div id="delete-modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.4);">
        <div style="background-color: #fefefe; margin: 10% auto; padding: 20px; border: 1px solid #888; width: 90%; max-width: 500px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-red-600">
                    <i class="fas fa-exclamation-circle me-2"></i>Confirmar Eliminación de Cuenta
                </h2>
                <button type="button" onclick="document.getElementById('delete-modal').style.display='none'" class="text-gray-600 hover:text-gray-800 text-2xl" style="background: none; border: none; cursor: pointer;">&times;</button>
            </div>

            <p class="text-gray-700 mb-4">
                <strong>Advertencia:</strong> Esta acción es <strong>irreversible</strong>. Se eliminarán:
            </p>
            <ul class="list-disc list-inside text-gray-600 text-sm mb-4 space-y-2">
                <li>Tu cuenta de usuario</li>
                <li>Todos tus datos personales</li>
                <li>Tu historial de registro</li>
                <li>Todos tus registros en el sistema</li>
            </ul>

            <form id="delete-account-form" method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock me-1" style="color: #ef4444;"></i>Ingresa tu contraseña para confirmar:
                    </label>
                    <input id="password" name="password" type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('userDeletion.password') border-red-500 @enderror" placeholder="Tu contraseña" required>
                    @error('userDeletion.password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="document.getElementById('delete-modal').style.display='none'" class="flex-1 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="button" onclick="confirmFinalDeletion(document.getElementById('delete-account-form'))" class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                        <i class="fas fa-trash-alt me-2"></i>Eliminar Definitivamente
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function showDeleteAccountWarning() {
        Swal.fire({
            title: '<i class="fas fa-exclamation-triangle" style="color: #ef4444;"></i> Eliminar Cuenta',
            html: `
                <div style="text-align: left; color: #374151;">
                    <p class="mb-4"><strong>Esta acción es PERMANENTE e IRREVERSIBLE</strong></p>
                    <p class="text-sm mb-2">Se eliminarán:</p>
                    <ul style="text-align: left; display: inline-block; color: #6b7280; font-size: 0.9rem;">
                        <li>✗ Tu cuenta de usuario</li>
                        <li>✗ Todos tus datos personales</li>
                        <li>✗ Tu historial completo</li>
                        <li>✗ Toda tu información en el sistema</li>
                    </ul>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Entiendo, continuar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-modal').style.display = 'block';
            }
        });
    }

    function confirmFinalDeletion(form) {
        const password = document.getElementById('password').value;
        
        if (!password) {
            Swal.fire({
                title: '<i class="fas fa-exclamation-circle" style="color: #ef4444;"></i> Contraseña Requerida',
                text: 'Por favor ingresa tu contraseña para confirmar la eliminación.',
                icon: 'error',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#ef4444'
            });
            return;
        }

        Swal.fire({
            title: '<i class="fas fa-skull-crossbones" style="color: #ef4444;"></i> Última Confirmación',
            html: '<p style="font-size: 1rem; color: #374151; font-weight: bold;">¿Estás 100% seguro?</p><p style="font-size: 0.875rem; color: #6b7280;">Esta es tu última oportunidad para cancelar. Escribe tu nombre para confirmar:</p><input type="text" id="confirm-name" style="width: 100%; padding: 8px; margin-top: 12px; border: 1px solid #d1d5db; border-radius: 6px;" placeholder="Tu nombre">',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar Cuenta Para Siempre',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            reverseButtons: true,
            didOpen: () => {
                document.getElementById('confirm-name').focus();
            },
            preConfirm: () => {
                const nameInput = Swal.getPopup().querySelector('#confirm-name');
                if (!nameInput.value) {
                    Swal.showValidationMessage('Por favor escribe tu nombre para confirmar');
                    return false;
                }
                return true;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    // Cerrar modal al hacer click fuera de él
    window.onclick = function(event) {
        const modal = document.getElementById('delete-modal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
    </script>
</section>
