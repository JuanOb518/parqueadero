# 🔧 CONFIGURACIÓN AVANZADA

## Cambiar a MySQL

Si prefieres usar MySQL en lugar de SQLite, sigue estos pasos:

### 1. Crear la base de datos
```bash
mysql -u root -p
CREATE DATABASE parqueadero_motos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 2. Configurar .env
Edita el archivo `.env` y cambia:

```env
APP_DEBUG=true

# Cambiar a MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=parqueadero_motos
DB_USERNAME=root
DB_PASSWORD=tu_contrasena_aqui
```

### 3. Ejecutar migraciones
```bash
php artisan migrate
php artisan db:seed
```

### 4. Test de conexión
```bash
php artisan tinker
DB::connection()->getPdo()
```

---

## Configurar en Servidor Producción

### Requisitos Mínimos
- PHP 8.2+
- Composer
- MySQL 5.7+ o MariaDB 10.3+
- Apache/Nginx

### Pasos de Despliegue

#### 1. Clonar el repositorio
```bash
git clone <url> /var/www/parqueadero
cd /var/www/parqueadero
```

#### 2. Instalar dependencias
```bash
composer install --no-dev
npm install --production
npm run build
```

#### 3. Configurar .env
```bash
cp .env.example .env
php artisan key:generate

# Editar .env con datos de producción
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=parqueadero_prod
DB_USERNAME=usuario_db
DB_PASSWORD=contrasena_segura
```

#### 4. Hacer directorios escribibles
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

#### 5. Ejecutar migraciones
```bash
php artisan migrate --force
php artisan db:seed --force
```

#### 6. Configurar Apache (ejemplo con .htaccess)

El archivo `public/.htaccess` ya viene configurado. Verifica que `mod_rewrite` esté habilitado:

```bash
a2enmod rewrite
systemctl restart apache2
```

#### 7. Configurar Nginx (si aplica)

```nginx
server {
    listen 80;
    server_name tudominio.com;

    root /var/www/parqueadero/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

#### 8. SSL con Let's Encrypt (recomendado)
```bash
certbot certonly --webroot -w /var/www/parqueadero/public -d tudominio.com
```

---

## Optimización de Performance

### 1. Cache de configuración
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Autoloader de Composer
```bash
composer install --optimize-autoloader --no-dev
```

### 3. Modo debug apagado
En `.env`:
```
APP_DEBUG=false
```

### 4. Backup automático
```bash
# Cron job diario
0 2 * * * cd /var/www/parqueadero && php artisan backup:run
```

---

## Copias de Seguridad

### Manual
```bash
# Base de datos
mysqldump -u root -p parqueadero_motos > backup_$(date +%Y%m%d).sql

# Archivos
tar -czf parqueadero_backup_$(date +%Y%m%d).tar.gz /var/www/parqueadero
```

### Automático (Cron)
```bash
# Agregar a crontab
0 3 * * * /bin/bash /var/www/parqueadero/backup.sh
```

---

## Monitoreo

### Logs
```bash
tail -f storage/logs/laravel*.log
```

### Verificar conexión a base de datos
```bash
php artisan db:validate
```

### Ejecutar tests (si existen)
```bash
php artisan test
```

---

## Troubleshooting

### Permiso denegado en storage
```bash
chmod -R 777 storage/
chmod -R 777 bootstrap/cache/
```

### Problema con migraciones
```bash
php artisan migrate:rollback
php artisan migrate
```

### Cache corrupto
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Limpiar datos de sesión
```bash
php artisan session:table
php artisan migrate
```

---

## Variables de Entorno Importantes

```env
# Aplicación
APP_NAME="Parqueadero Motos"
APP_ENV=production
APP_URL=https://tudominio.com

# Base de Datos
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=parqueadero_db
DB_USERNAME=usuario_db

# Mail (opcional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_email@gmail.com
MAIL_PASSWORD=tu_contraseña_app
MAIL_FROM_ADDRESS=noreply@tudominio.com

# AWS S3 (para almacenar imágenes en nube)
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
```

---

## Escalabilidad Futura

Para preparar el sistema para un mayor número de usuarios:

1. **Usar Redis** para caché y sessions
2. **Configurar queue workers** para procesos en background
3. **Setup de CDN** para imágenes
4. **Load balancing** con nginx
5. **Clustering de base de datos**

---

## Soporte y Documentación

- Laravel Docs: https://laravel.com/docs
- Tailwind CSS: https://tailwindcss.com/docs
- Laravel Breeze: https://github.com/laravel/breeze

---

#  ¡Listo para producción! 🚀
