@echo off
REM Instalador automático de Parqueadero para Windows

echo 🏍️  Instalando Parqueadero...
echo.

REM Verificar que Composer existe
where composer >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo ❌ Composer no está instalado. Por favor instala Composer desde https://getcomposer.org
    pause
    exit /b 1
)

REM Verificar que Node existe
where node >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo ❌ Node.js no está instalado. Por favor instala Node.js desde https://nodejs.org
    pause
    exit /b 1
)

echo ✅ Dependencias encontradas
echo.

REM Instalar dependencias PHP
echo 📦 Instalando dependencias PHP...
call composer install

REM Copiar archivo .env
if not exist .env (
    echo ⚙️  Creando archivo .env...
    copy .env.example .env
) else (
    echo ⚙️  Archivo .env ya existe
)

REM Generar clave de aplicación
echo 🔑 Generando clave de aplicación...
php artisan key:generate

REM Instalar dependencias Node
echo 📦 Instalando dependencias JavaScript...
call npm install

REM Compilar assets
echo 🎨 Compilando assets...
call npm run build

REM Ejecutar migraciones
echo 🗄️  Ejecutando migraciones...
php artisan migrate --seed

echo.
echo ✅ ¡Instalación completada!
echo.
echo Pasos siguientes:
echo 1. Edita el archivo .env con tu configuración de base de datos
echo 2. Ejecuta: php artisan serve
echo 3. Accede a: http://localhost:8000
echo.
echo Credenciales de administrador:
echo Email: admin@parqueadero.local
echo Contraseña: password
echo.
echo ⚠️  IMPORTANTE: Cambia estas credenciales en producción
echo.
pause
