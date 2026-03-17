# 🏍️ Sistema de Gestión de Parqueadero de Motocicletas

Un sistema web completo y robusto para gestionar un parqueadero exclusivo de motocicletas, desarrollado con Laravel 12, Tailwind CSS y Vite.

## 📋 Requerimientos

- **PHP**: 8.2 o superior
- **Composer**: Gestor de dependencias de PHP
- **Node.js**: 18+ y npm (para compilar assets)
- **MySQL/MariaDB**: Base de datos (o SQLite para desarrollo)
- **Git**: Control de versiones

## 🚀 Instalación Rápida (Clonado desde GitHub)

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu_usuario/parqueadero.git
cd parqueadero
```

### 2. Instalar dependencias

```bash
# Instalar dependencias PHP
composer install

# Instalar dependencias JavaScript
npm install
```

### 3. Configurar archivo de entorno

```bash
# Copiar archivo de ejemplo
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```

### 4. Configurar base de datos

Edita el archivo `.env` y configura:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=parqueadero_motos
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

Luego ejecuta las migraciones:

```bash
php artisan migrate --seed
```

### 5. Compilar assets

```bash
npm run build
```

### 6. Ejecutar servidor

```bash
php artisan serve
```

Accede a: **http://localhost:8000**

## 👤 Credenciales de Acceso (Después de las migraciones)

Los seeders crean automáticamente un usuario administrador:

- **Email**: admin@parqueadero.local
- **Contraseña**: password

⚠️ **Importante**: Cambia estas credenciales en producción.

## 📦 Características Principales

### Panel de Administrador
- ✅ **Dashboard**: Resumen en tiempo real del estado del parqueadero
- ✅ **Gestión de Planes**: CRUD de planes de pago (Mes, Día, Hora)
- ✅ **Registro de Motocicletas**: Entrada con datos del propietario y foto
- ✅ **Control de Parqueos**: Registro de entrada y salida con cálculo automático de tarifas
- ✅ **Historial de Transacciones**: Reporte detallado de todos los parqueos
- ✅ **Configuración**: Ajustes del sistema (espacios, tarifas, información)

### Sitio Web Público
- ✅ **Página de Inicio**: Información general del parqueadero
- ✅ **Tarifas**: Visualización clara de planes y precios
- ✅ **Disponibilidad**: Información en tiempo real de espacios disponibles
- ✅ **Contacto**: Ubicación, horarios y formulario de contacto

### Funcionalidades Técnicas
- ✅ Autenticación segura con Laravel Breeze
- ✅ Responsive design con Tailwind CSS
- ✅ Cálculo automático de tarifas
- ✅ Registro fotográfico de motocicletas
- ✅ Historial completo de transacciones
- ✅ Disponibilidad en tiempo real
- ✅ Validación de datos en cliente y servidor
- ✅ Protección contra CSRF
- ✅ Interfaz en español

## 🔧 Comandos de Desarrollo

```bash
# Ejecutar servidor Laravel + Vite en paralelo
npm run dev

# O ejecutar por separado:
php artisan serve           # Servidor Laravel
npm run dev                 # Vite dev server

# Ejecutar migraciones
php artisan migrate

# Ejecutar seeders
php artisan db:seed

# Resetear base de datos
php artisan migrate:fresh --seed

# Compilar assets para producción
npm run build

# Ejecutar tests (si existen)
php artisan test

# Ver logs en tiempo real
php artisan pail
```

## 📁 Estructura de Base de Datos

### Tablas principales

| Tabla | Descripción |
|-------|-------------|
| `users` | Usuarios del sistema (administradores) |
| `plans` | Planes de pago disponibles |
| `motorcycles` | Registro de motocicletas con propietario |
| `parkings` | Control de entrada/salida de motos |
| `settings` | Configuraciones del sistema |

## 🔐 Configuración para Producción

1. Cambia el archivo `.env`:
   ```env
   APP_DEBUG=false
   APP_ENV=production
   ```

2. Genera clave de aplicación (si no la tienes):
   ```bash
   php artisan key:generate
   ```

3. Ejecuta optimizaciones:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

4. Compila assets:
   ```bash
   npm run build
   ```

5. Configura tu servidor web para apuntar a `/public`

## 📖 Rutas Principales

### Públicas (sin autenticación)
- `/` - Página de inicio
- `/tarifas` - Planes y precios
- `/disponibilidad` - Estado actual del parqueadero
- `/contacto` - Información de contacto

### Administrativas (requieren login)
- `/dashboard` - Panel principal
- `/planes` - Gestión de planes
- `/motos` - Registro de motocicletas
- `/parqueos` - Control de entrada/salida
- `/configuracion` - Ajustes del sistema

## 💡 Tips de Uso

1. **Registrar entrada**: Ve a "Parqueos" > "Registrar Entrada"
2. **Registrar salida**: Busca la moto en la lista activa y haz clic en "Registrar Salida"
3. **Ver historial**: Ve a "Parqueos" > "Historial"
4. **Cambiar configuración**: Ve a "Configuración" y actualiza los valores

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Fork el repositorio
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Licencia

Este proyecto está licenciado bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

## 📧 Contacto & Soporte

Para reportar bugs o sugerencias, por favor abre un issue en el repositorio de GitHub.

---

**Desarrollado con ❤️ usando Laravel y Tailwind CSS**
