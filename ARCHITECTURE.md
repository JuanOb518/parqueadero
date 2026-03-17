# 📐 Arquitectura del Proyecto

Documentación técnica de la arquitectura y estructura del proyecto Parqueadero.

## 🏗️ Stack Tecnológico

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates + Alpine.js + Tailwind CSS
- **Build Tool**: Vite
- **Database**: MySQL/MariaDB
- **Authentication**: Laravel Breeze
- **UI Components**: Tailwind CSS + Blade Components

## 📂 Estructura de Carpetas

```
laravel/
├── app/                          # Código de aplicación
│   ├── Helpers/                 # Funciones de utilidad
│   │   └── ParkingHelper.php    # Lógica de parqueadero
│   ├── Http/
│   │   ├── Controllers/         # Controladores
│   │   └── Requests/            # Form Requests (validación)
│   ├── Models/                  # Modelos Eloquent
│   │   ├── User.php
│   │   ├── Motorcycle.php
│   │   ├── Parking.php
│   │   ├── Plan.php
│   │   └── Setting.php
│   ├── Providers/               # Service Providers
│   └── View/
│       ├── Components/          # Blade Components
│       └── Composers/           # View Composers
├── bootstrap/                   # Bootstrap de aplicación
├── config/                      # Archivos de configuración
├── database/
│   ├── factories/               # Model factories para testing
│   ├── migrations/              # Migraciones de BD
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_03_17_010842_create_plans_table.php
│   │   ├── 2026_03_17_010858_create_motorcycles_table.php
│   │   ├── 2026_03_17_010859_create_parkings_table.php
│   │   └── 2026_03_17_010859_create_settings_table.php
│   └── seeders/                 # Database seeders
│       ├── DatabaseSeeder.php
│       ├── PlanSeeder.php
│       └── SettingSeeder.php
├── public/                      # Documentos raíz públicos
│   ├── storage/                 # Link simbólico a storage/app/public
│   ├── build/                   # Assets compilados por Vite
│   └── index.php                # Entry point
├── resources/
│   ├── css/                     # Estilos
│   │   └── app.css              # Tailwind + custom CSS
│   ├── js/
│   │   ├── app.js               # Entry point JavaScript
│   │   └── bootstrap.js         # Bootstrap de la app
│   └── views/                   # Vistas Blade
│       ├── layouts/
│       │   ├── app.blade.php
│       │   └── guest.blade.php
│       ├── admin/               # Vistas administrativas
│       ├── auth/                # Vistas de autenticación
│       ├── components/          # Componentes reutilizables
│       ├── profile/             # Vistas de perfil
│       ├── public/              # Vistas públicas
│       ├── dashboard.blade.php
│       └── welcome.blade.php
├── routes/                      # Definición de rutas
│   ├── web.php                  # Rutas web
│   ├── auth.php                 # Rutas de autenticación
│   └── console.php              # Comandos Artisan
├── storage/                     # Almacenamiento de archivos
│   ├── app/
│   │   ├── private/             # Archivos privados
│   │   └── public/              # Archivos públicos
│   ├── framework/
│   │   ├── cache/
│   │   ├── sessions/
│   │   └── views/
│   └── logs/
├── tests/                       # Tests automatizados
├── artisan                      # CLI de Laravel
├── composer.json                # Dependencias PHP
├── package.json                 # Dependencias Node.js
├── tailwind.config.js           # Configuración Tailwind
├── vite.config.js               # Configuración Vite
├── .env.example                 # Ejemplo de variables de entorno
├── .gitignore                   # Archivos ignorados por git
├── GITHUB_SETUP.md              # Setup de GitHub
├── DEVELOPMENT.md               # Guía de desarrollo
├── DEPLOYMENT.md                # Guía de deployment
├── CONTRIBUTING.md              # Guía de contribución
└── README.md                    # Este archiv
```

## 🗄️ Modelos de Base de Datos

### Users
```sql
+-----+--------+-------+--------+
| id  | name   | email | password |
+-----+--------+-------+--------+
```
- Tabla de usuarios del sistema
- Solo administradores tienen acceso

### Plans
```sql
+-----+--------+---------+-------+--------+
| id  | nombre | duración| precio| descripción |
+-----+--------+---------+-------+--------+
```
- Planes de pago (Mensual, Diario, Hora)
- Define características y precios

### Motorcycles
```sql
+-----+-------+------------------+--------+------+-------+---+
| id  | placa | nombre_propietario| teléfono| marca| color | foto |
+-----+-------+------------------+--------+------+-------+---+
```
- Registro de motocicletas del parqueadero
- Asociado con propietario

### Parkings
```sql
+-----+--------------+-------+----------+----------+----------+
| id  | motorcycle_id| plan_id| entrada  | salida   | costo    |
+-----+--------------+-------+----------+----------+----------+
```
- Control de entrada/salida de motos
- Calcula automáticamente costo basado en Plan

### Settings
```sql
+-----+-------+-------+
| id  | key   | value |
+-----+-------+-------+
```
- Configuraciones del sistema (precio/hora, espacios, etc.)

## 🔄 Flujos Principales

### 1. Registro de Entrada

```
Usuario Admin
    ↓
Dashboard → Registrar Entrada
    ↓
Seleccionar Moto o Crear Nueva
    ↓
Seleccionar Plan
    ↓
Crear registro en tabla `parkings` con hora_entrada
    ↓
Actualizar estado en Dashboard (espacios disponibles)
```

### 2. Cálculo de Tarifa

```
User registra salida
    ↓
Sistema calcula tiempo desde entrada
    ↓
ParkingHelper::calculateCost()
    ↓
Obtiene tarifa del Plan seleccionado
    ↓
Actualiza total_costo en parkings
```

### 3. Flujo de Autenticación

```
Usuario accede a ruta protegida
    ↓
Middleware 'auth' verifica sesión
    ↓
¿Autenticado? → Continuar
¿No? → Redireccionar a login
    ↓
Laravel Breeze maneja login/logout
```

## 🛣️ Rutas

### Públicas (sin autenticación)
```
GET  /                          → welcome
GET  /tarifas                   → pricing page
GET  /disponibilidad            → parking status
GET  /contacto                  → contact page
```

### Autenticadas
```
GET  /dashboard                 → admin panel
GET  /plans                     → gestión de planes
POST /plans                     → crear plan
GET  /plans/{id}/edit           → editar plan
DELETE /plans/{id}              → eliminar plan

GET  /motorcycles               → lista de motos
POST /motorcycles               → registrar moto
GET  /motorcycles/{id}          → ver detalles

GET  /parkings                  → lista de parqueos
POST /parkings/entry            → registrar entrada
POST /parkings/{id}/exit        → registrar salida
GET  /parkings/history          → historial

GET  /settings                  → configuración
POST /settings                  → actualizar configuración
```

## 🎮 Controladores Clave

### DashboardController
- Resumen de datos
- Estadísticas en tiempo real
- Disponibilidad de espacios

### ParkingController
- `index()` - Lista de parqueos activos
- `store()` - Registrar entrada
- `exit()` - Registrar salida
- `history()` - Historial

### MotorcycleController
- CRUD de motocicletas
- Búsqueda/Filtrado

### PlanController
- CRUD de planes
- Validaciones de precios/duración

## 📝 Helpers

### ParkingHelper.php
Funciones de utilidad:
- `calculateCost()`- Calcula costo de parqueo
- `availableSpaces()` - Espacios disponibles
- `isSpaceAvailable()` - Verifica disponibilidad
- `formatCurrency()` - Formatea moneda

## 🔐 Seguridad

### CSRF Protection
- Token CSRF en todos los formularios
- Middleware `VerifyCsrfToken`

### SQL Injection Prevention
- Usando Eloquent ORM (prepared statements)
- Validación en Form Requests

### XSS Prevention
- Blade automáticamente escapa HTML
- Usar `{!! }}` solo con contenido de confianza

### Password Hashing
- Bcrypt con 12 rounds (configurable)

## 🏛️ Patrones Utilizados

### Service Layer
- Lógica de negocio en Helpers/Services
- Controladores solo orquestan

### Form Request Validation
- Validación centralizada
- Reutilizable en múltiples endpoints

### Eloquent Relationships
```php
User hasMany Motorcycles
Motorcycle hasMany Parkings
Plan hasMany Parkings
```

### Events & Listeners (opcional)
Puede extenderse con eventos:
- `ParkingEntered`
- `ParkingSalida`
- Notificaciones al propietario

## 📊 Consideraciones de Rendimiento

- Índices en `motorcycles.placa`
- Índices en `parkings.motorcycle_id`
- Índices en `parkings.created_at`
- Usar pagination en listas grandes
- Cache de configuraciones

## 🧪 Testing

Estructura de tests:
```
tests/
├── Feature/          # Tests de funcionalidades (end-to-end)
│   ├── ParkingTest.php
│   └── MotorcycleTest.php
└── Unit/             # Tests unitarios
    ├── ParkingHelperTest.php
    └── PriceCalculationTest.php
```

## 📈 Extensibilidad Futura

Puntos para expandir:
- **Notificaciones**: Email cuando se registra entrada/salida
- **API REST**: Para aplicación móvil
- **Reportes**: Análisis de crecimiento
- **Pagos Online**: Integración con pasarelas
- **Multi-idioma**: i18n completa
- **Roles y Permisos**: Más granularidad de acceso

---

## 📚 Recursos

- [Laravel Architecture Concepts](https://laravel.com/docs/architecture-concepts)
- [Eloquent Documentation](https://laravel.com/docs/eloquent)
- [Blade Templating](https://laravel.com/docs/blade)
