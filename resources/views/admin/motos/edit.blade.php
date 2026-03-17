@extends('layouts.app')

@section('title', 'Editar Motocicleta - Parqueadero')
@section('heading', 'Editar Motocicleta')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8">
    <form method="POST" action="{{ route('motos.update', $moto) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="placa" class="block text-sm font-medium text-gray-700 mb-2">
                    Placa* <span class="text-gray-500 text-xs">(Formato: ABC 12A)</span>
                </label>
                <input type="text" id="placa" name="placa" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 uppercase @error('placa') border-red-500 @enderror" value="{{ old('placa', $moto->placa) }}" maxlength="8" required oninput="formatPlaca(this)">
                <p class="text-gray-500 text-xs mt-1">3 letras, espacio, 2 números, espacio, 1 letra</p>
                @error('placa')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="marca" class="block text-sm font-medium text-gray-700 mb-2">Marca*</label>
                <input type="text" id="marca" name="marca" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('marca') border-red-500 @enderror" value="{{ old('marca', $moto->marca) }}" required>
                @error('marca')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nombre_propietario" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Propietario*</label>
                <input type="text" id="nombre_propietario" name="nombre_propietario" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('nombre_propietario') border-red-500 @enderror" value="{{ old('nombre_propietario', $moto->nombre_propietario) }}" required>
                @error('nombre_propietario')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Color*</label>
                <input type="text" id="color" name="color" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('color') border-red-500 @enderror" value="{{ old('color', $moto->color) }}" required>
                @error('color')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">Teléfono*</label>
                <input type="tel" id="telefono" name="telefono" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('telefono') border-red-500 @enderror" value="{{ old('telefono', $moto->telefono) }}" required>
                @error('telefono')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico*</label>
                <input type="email" id="correo" name="correo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('correo') border-red-500 @enderror" value="{{ old('correo', $moto->correo) }}" required>
                @error('correo')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto de la Motocicleta</label>
            @if($moto->foto)
                <div class="mb-4">
                    <img src="{{ Storage::url($moto->foto) }}" alt="{{ $moto->placa }}" class="w-48 h-32 object-cover rounded-lg">
                </div>
            @endif
            <input type="file" id="foto" name="foto" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('foto') border-red-500 @enderror" accept="image/*">
            <p class="text-gray-500 text-sm mt-2">Máximo 2 MB. Deja en blanco para mantener la foto actual</p>
            @error('foto')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition">
                <i class="fas fa-save mr-2"></i>Actualizar Motocicleta
            </button>
            <a href="{{ route('motos.index') }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 rounded-lg text-center transition">
                <i class="fas fa-times mr-2"></i>Cancelar
            </a>
        </div>
    </form>
</div>

<script>
function formatPlaca(input) {
    let value = input.value.toUpperCase().replace(/\s/g, '');
    let formatted = '';
    
    // Formato: ABC 12A (3 letras, espacio, 2 números, espacio, 1 letra)
    if (value.length >= 1) {
        formatted = value.substring(0, 3); // ABC
    }
    if (value.length >= 4) {
        formatted += ' ' + value.substring(3, 5); // ABC 12
    }
    if (value.length >= 6) {
        formatted += ' ' + value.substring(5, 6); // ABC 12A
    }
    
    input.value = formatted.substring(0, 8);
}

// Validar que solo permitimos letras y números
document.getElementById('placa').addEventListener('keypress', function(e) {
    const char = String.fromCharCode(e.which);
    if (!/[A-Z0-9]/.test(char)) {
        e.preventDefault();
    }
});
</script>
@endsection
