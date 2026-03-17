<section>
    <header class="mb-6">
        <p class="text-gray-600 text-sm leading-relaxed">
            <i class="fas fa-info-circle me-2" style="color: #2563eb;"></i>
            Actualiza tu información personal y dirección de correo electrónico. Estos datos son importantes para que el sistema pueda contactarte si es necesario.
        </p>
    </header>

    <form id="profile-form" method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-user me-1" style="color: #2563eb;"></i>Nombre Completo *
            </label>
            <input id="name" name="name" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" placeholder="Tu nombre completo">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-envelope me-1" style="color: #2563eb;"></i>Correo Electrónico *
            </label>
            <input id="email" name="email" type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username" placeholder="tu@email.com">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                    <p class="text-sm text-yellow-800 mb-2">
                        <i class="fas fa-exclamation-triangle me-2"></i>Tu correo no ha sido verificado.
                    </p>

                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <button form="send-verification" type="button" onclick="sendVerificationEmail()" class="text-sm text-yellow-700 hover:text-yellow-900 font-semibold underline">
                        Reenviar correo de verificación
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-green-600 text-sm font-semibold">
                            <i class="fas fa-check-circle me-1"></i>Se ha enviado un nuevo enlace de verificación.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Botones de acción -->
        <div class="flex items-center gap-4 pt-4">
            <button type="button" onclick="confirmProfileUpdate(document.getElementById('profile-form'))" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition transform hover:scale-105">
                <i class="fas fa-save me-2"></i>Guardar Cambios
            </button>

            @if (session('status') === 'profile-updated')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: '<i class="fas fa-check-circle" style="color: #10b981;"></i> Perfil Actualizado',
                            text: 'Tu información personal ha sido actualizada exitosamente.',
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
    function confirmProfileUpdate(form) {
        const nombre = document.getElementById('name').value;
        const email = document.getElementById('email').value;

        Swal.fire({
            title: '<i class="fas fa-user-edit" style="color: #2563eb;"></i> Confirmar Cambios',
            html: `
                <div style="text-align: left; margin: 20px 0;">
                    <p><strong>Nombre:</strong> <span style="color: #2563eb;">${nombre}</span></p>
                    <p><strong>Email:</strong> <span style="color: #2563eb;">${email}</span></p>
                    <p style="font-size: 0.875rem; color: #6b7280; margin-top: 12px;"><i class="fas fa-info-circle"></i> Verifica que los datos sean correctos antes de guardar.</p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6b7280',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    function sendVerificationEmail() {
        const form = document.getElementById('send-verification');
        Swal.fire({
            title: '<i class="fas fa-envelope" style="color: #f59e0b;"></i> Reenviar Verificación',
            text: 'Se enviará un nuevo enlace de verificación a tu correo electrónico.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Enviar',
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
