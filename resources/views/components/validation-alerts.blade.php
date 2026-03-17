<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mostrar errores de validación en pop-up
    @if ($errors->any())
        const errors = {!! json_encode($errors->all()) !!};
        let errorHTML = '<ul style="text-align: left; margin: 20px 0;">';
        errors.forEach(error => {
            errorHTML += '<li style="margin: 8px 0; font-size: 0.95rem;">' + error + '</li>';
        });
        errorHTML += '</ul>';

        Swal.fire({
            title: '<i class="fas fa-exclamation-circle" style="color: #ef4444;"></i> Validación Fallida',
            html: errorHTML,
            icon: 'error',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#2563eb',
            allowOutsideClick: false,
            didOpen: () => {
                // Scroll al primer campo con error
                const firstErrorField = document.querySelector('.is-invalid, input.border-red-500');
                if (firstErrorField) {
                    firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstErrorField.focus();
                }
            }
        });
    @endif

    // Mostrar mensajes de éxito
    @if (session('success'))
        Swal.fire({
            title: '<i class="fas fa-check-circle" style="color: #10b981;"></i> ¡Éxito!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Continuar',
            confirmButtonColor: '#10b981',
            timer: 3000,
            timerProgressBar: true,
            didClose: () => {
                // Opcional: redirigir después de mostrar el mensaje
            }
        });
    @endif

    // Mostrar mensajes de error general
    @if (session('error'))
        Swal.fire({
            title: '<i class="fas fa-times-circle" style="color: #ef4444;"></i> Error',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#ef4444',
            allowOutsideClick: false
        });
    @endif

    // Mostrar mensajes de advertencia
    @if (session('warning'))
        Swal.fire({
            title: '<i class="fas fa-exclamation-triangle" style="color: #f59e0b;"></i> Advertencia',
            text: '{{ session('warning') }}',
            icon: 'warning',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#f59e0b'
        });
    @endif

    // Mostrar mensajes de información
    @if (session('info'))
        Swal.fire({
            title: '<i class="fas fa-info-circle" style="color: #0ea5e9;"></i> Información',
            text: '{{ session('info') }}',
            icon: 'info',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#0ea5e9'
        });
    @endif

    // Confirmación antes de eliminar
    document.querySelectorAll('.delete-confirm').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const itemName = this.dataset.name || 'este elemento';
            
            Swal.fire({
                title: '<i class="fas fa-trash-alt" style="color: #ef4444;"></i> ¿Eliminar?',
                html: '¿Estás seguro de que deseas eliminar <strong>' + itemName + '</strong>?<br><small style="color: #666;">Esta acción no se puede deshacer.</small>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
                didOpen: () => {
                    // Hacer foco en el botón de cancelar por seguridad
                    document.querySelector('.swal2-cancel').focus();
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
