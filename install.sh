#!/bin/bash
# Instalador automático de Parqueadero

echo "🏍️  Instalando Parqueadero..."

# Verificar que Composer y Node están disponibles
if ! command -v composer &> /dev/null; then
    echo "❌ Composer no está instalado. Por favor instala Composer desde https://getcomposer.org"
    exit 1
fi

if ! command -v node &> /dev/null; then
    echo "❌ Node.js no está instalado. Por favor instala Node.js desde https://nodejs.org"
    exit 1
fi

echo "✅ Dependencias encontradas"
echo ""

# Instalar dependencias PHP
echo "📦 Instalando dependencias PHP..."
composer install

# Copiar archivo .env
if [ ! -f .env ]; then
    echo "⚙️  Creando archivo .env..."
    cp .env.example .env
else
    echo "⚙️  Archivo .env ya existe"
fi

# Generar clave de aplicación
echo "🔑 Generando clave de aplicación..."
php artisan key:generate

# Instalar dependencias Node
echo "📦 Instalando dependencias JavaScript..."
npm install

# Compilar assets
echo "🎨 Compilando assets..."
npm run build

# Ejecutar migraciones
echo "🗄️  Ejecutando migraciones..."
php artisan migrate --seed

echo ""
echo "✅ ¡Instalación completada!"
echo ""
echo "Pasos siguientes:"
echo "1. Edita el archivo .env con tu configuración de base de datos"
echo "2. Ejecuta: php artisan serve"
echo "3. Accede a: http://localhost:8000"
echo ""
echo "Credenciales de administrador:"
echo "Email: admin@parqueadero.local"
echo "Contraseña: password"
echo ""
echo "⚠️  IMPORTANTE: Cambia estas credenciales en producción"
