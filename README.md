# 🏍️ Sistema de Gestión de Parqueadero de Motocicletas

Un sistema web completo y robusto para gestionar un parqueadero exclusivo de motocicletas, desarrollado con Laravel 10 y Tailwind CSS.

## Características Principales

### Panel de Administrador
- **Dashboard**: Resumen en tiempo real del estado del parqueadero
- **Gestión de Planes**: CRUD de planes de pago (Mes, Día, Hora)
- **Registro de Motocicletas**: Entrada con datos del propietario y foto
- **Control de Parqueos**: Registro de entrada y salida con cálculo automático de tarifas
- **Historial de Transacciones**: Reporte detallado de todos los parqueos
- **Configuración**: Ajustes del sistema (espacios, tarifas, información)

### Sitio Web Público
- **Página de Inicio**: Información general del parqueadero
- **Tarifas**: Visualización clara de planes y precios
- **Disponibilidad**: Información en tiempo real de espacios disponibles
- **Contacto**: Ubicación, horarios y formulario de contacto

## Requerimientos

- PHP 8.2+
- Laravel 10.x
- Composer
- Node.js y NPM (opcional)
- MySQL/MariaDB o SQLite

## Instalación Rápida

### 1. Instalar dependencias PHP
```bash
composer install
```

### 2. Configurar .env
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Ejecutar migraciones
```bash
php artisan migrate
php artisan db:seed
```

### 4. Iniciar servidor
```bash
php artisan serve
```

Accede a: **http://localhost:8000**

## Credenciales de Acceso

- **Email**: admin@parqueadero.com
- **Contraseña**: password

## Estructura de Base de Datos

### users
```
id, name, email, password, timestamps
```

### plans
```
id, nombre, duracion, precio, descripcion, timestamps
```

### motorcycles
```
id, placa, nombre_propietario, telefono, correo, marca, color, foto, timestamps
```

### parkings
```
id, motorcycle_id, plan_id, hora_entrada, hora_salida, total_costo, pago, timestamps
```

### settings
```
id, key, value, timestamps
```

## Configuración Inicial

Los seeders crean automáticamente:

- 3 planes de pago predefinidos
- 50 espacios de parqueo
- Tarifa por hora: $500
- Información de contacto del parqueadero

Puedes cambiar estos valores en el panel de **Configuración**.

## Funcionalidades

✅ Autenticación segura con Laravel Breeze
✅ Responsive design con Tailwind CSS
✅ Cálculo automático de tarifas
✅ Gestión de planes de pago
✅ Registro fotográfico de motocicletas
✅ Historial completo de transacciones
✅ Disponibilidad en tiempo real
✅ Validación de datos en cliente y servidor
✅ Protección contra CSRF
✅ Interfaz bilingüe (español/inglés)

## Rutas Principales

### Públicas
- `/` - Página de inicio
- `/tarifas` - Planes y precios
- `/disponibilidad` - Estado del parqueadero
- `/contacto` - Información de contacto

### Administrativas (requieren autenticación)
- `/dashboard` - Panel principal
- `/planes` - Gestión de planes
- `/motos` - Registro de motocicletas
- `/parqueos` - Control de entrada/salida
- `/configuracion` - Ajustes del sistema

## Tips de Uso

1. **Registrar entrada**: Ve a "Parqueos" > "Registrar Entrada"
2. **Registrar salida**: Busca la moto en la lista activa y haz clic en "Registrar Salida"
3. **Ver historial**: Ve a "Parqueos" > "Historial"
4. **Cambiar configuración**: Ve a "Configuración" y actualiza los valores

## Soporte

Para reportar errores o sugerencias, contact...

## Licencia

MIT
