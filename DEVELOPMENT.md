# 🛠️ Guía de Desarrollo Local

Este documento proporciona instrucciones detalladas para configurar un entorno de desarrollo local.

## 🚀 Instalación Rápida

### Opción 1: Script Automático (Recomendado)

**Windows:**
```powershell
.\install.bat
```

**macOS/Linux:**
```bash
bash install.sh
chmod +x install.sh
./install.sh
```

### Opción 2: Manual Step-by-Step

#### 1. Clonar el repositorio
```bash
git clone https://github.com/usuario/parqueadero.git
cd parqueadero
```

#### 2. Instalar dependencias

**PHP:**
```bash
composer install
```

**Node.js:**
```bash
npm install
```

#### 3. Configurar variables de entorno

```bash
cp .env.example .env
```

Edita `.env` con tus valores locales (base de datos, etc.):

```env
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=parqueadero_motos
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### 4. Preparar la aplicación

```bash
# Generar clave de aplicación
php artisan key:generate

# Crear base de datos (MySQL)
# Crea la base de datos primero: CREATE DATABASE parqueadero_motos;

# Ejecutar migraciones
php artisan migrate

# Cargar datos de prueba
php artisan db:seed
```

#### 5. Compilar assets

```bash
npm run build
```

#### 6. Iniciar servidor

En una terminal:
```bash
php artisan serve
```

En otra terminal:
```bash
npm run dev
```

Accede a: **http://localhost:8000**

## 🔄 Desarrollo Diario

### Modo Development Completo
Inicia ambos servidores simultáneamente:

```bash
npm run dev
```

Esto ejecuta:
- Servidor Laravel en http://localhost:8000
- Vite dev server en http://localhost:5173

### Compilar Cambios de Assets
Si cambias archivos en `resources/`:

```bash
# Development (con hot reload)
npm run dev

# Production
npm run build
```

### Ejecutar Migraciones Nuevas
```bash
# Ver migraciones pendientes
php artisan migrate:status

# Ejecutar migraciones
php artisan migrate

# Rollback último batch
php artisan migrate:rollback

# Reset completo
php artisan migrate:fresh
```

### Cargar Datos de Prueba
```bash
# Ejecutar todos los seeders
php artisan db:seed

# Ejecutar un seeder específico
php artisan db:seed --class=PlanSeeder

# Reset con seeders
php artisan migrate:fresh --seed
```

## 🐛 Debugging

### Logs en Tiempo Real
```bash
# Ver logs en vivo
php artisan pail
```

### Cache de Configuración
```bash
# Limpiar cache de configuración
php artisan config:clear

# Reeditar y cachear
php artisan config:cache
```

### Base de Datos

**phpMyAdmin:**
- Puerto: 3306
- Usuario: root
- Sin contraseña (por defecto)

**Comandos útiles:**
```bash
# Ver esquema de tabla
php artisan tinker
>>> Schema::getColumnListing('motorcycles')

# Consultar datos
>>> App\Models\Motorcycle::all()
```

## 📁 Estructura de Carpetas Importantes

```
parqueadero/
├── app/
│   ├── Http/Requests/        # Form requests (validación)
│   ├── Http/Controllers/      # Controladores
│   ├── Models/                # Modelos Eloquent
│   └── Helpers/               # Utilities
├── resources/
│   ├── js/
│   │   ├── app.js            # Entry point JS
│   │   └── bootstrap.js       # Bootstrap app
│   ├── css/
│   │   └── app.css           # Tailwind CSS
│   └── views/
│       ├── layouts/           # Layouts principales
│       ├── admin/             # Vistas admin
│       ├── public/            # Vistas públicas
│       └── components/        # Componentes reutilizables
├── routes/
│   ├── web.php               # Rutas web
│   └── auth.php              # Rutas de autenticación
├── database/
│   ├── migrations/            # Migraciones
│   ├── factories/             # Model factories (testing)
│   └── seeders/               # Database seeders
├── config/                    # Archivos de configuración
└── tests/                     # Tests automatizados
```

## 🧪 Testing

```bash
# Ejecutar todos los tests
php artisan test

# Tests con output verbose
php artisan test --verbose

# Un archivo específico
php artisan test tests/Unit/ParkingTest.php

# Un test específico
php artisan test --filter test_parking_entry
```

## 🔍 Code Quality

### Linting con Pint
```bash
# Ver problemas
./vendor/bin/pint --test

# Autoarreglar
./vendor/bin/pint
```

## 📦 Gestión de Dependencias

### PHP (Composer)
```bash
# Instalar nuevo paquete
composer require vendor/package

# Actualizar paquetes
composer update

# Ver dependencias instaladas
composer show
```

### JavaScript (NPM)
```bash
# Instalar nueva dependencia
npm install package-name

# Actualizar paquetes
npm update

# Ver dependencias instaladas
npm list
```

## 🐳 Opcional: Desarrollo con Docker

Si prefieres usar Docker:

```bash
# Instalar Laravel Sail (incluye todos los servicios)
composer require laravel/sail --dev

# Publicar configuración
php artisan sail:install

# Iniciar contenedores
sail up

# Comando alternativo
docker-compose up

# Acceder al contenedor
sail shell
# o
docker-compose exec web bash
```

## ⚙️ Troubleshooting

### "Class not found"
```bash
composer dump-autoload
```

### "Permission denied"
```bash
# Permisos en storage/
chmod -R 775 storage bootstrap/cache
```

### "Key already exists"
```bash
php artisan key:generate --force
```

### Problemas con Node/npm
```bash
# Limpiar cache
npm cache clean --force

# Reinstalar
rm -rf node_modules package-lock.json
npm install
```

### Base de datos no responde
```bash
# Verifica que MySQL esté corriendo
mysql -u root -p

# Desde PowerShell si MySQL está instalado
mysql -u root
```

## 📚 Recursos Útiles

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [Vite](https://vitejs.dev)

---

¿Problemas? Abre un issue en GitHub con:
- Tu SO
- Versión de PHP
- Error message completo
- Qué pasos ejecutaste
