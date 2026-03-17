# 🚀 Deployment en Producción

Guía para desplegar Parqueadero en un servidor de producción.

## 📋 Requerimientos de Servidor

- **PHP**: 8.2 o superior con extensiones: mysql, pdo, json, mbstring, tokenizer, xml
- **Web Server**: Nginx (recomendado) o Apache
- **Base de Datos**: MySQL 5.7+ o MariaDB 10.3+
- **Node.js**: 18+ (solo para build inicial)
- **Composer**: Última versión

## 🔒 Pre-Deployment Checklist

- [ ] Todas las variables sensibles están en `.env` (no en código)
- [ ] `APP_DEBUG=false` en producción
- [ ] `APP_ENV=production`
- [ ] Base de datos resguardada
- [ ] SSL/HTTPS configurado
- [ ] Logs rotados y monitoreados
- [ ] Backup automático configurado

## 📦 Pasos de Deployment

### 1. Preparar Servidor

```bash
# Loguear como usuario deploy
ssh user@servidor.com

# Instalar dependencias del sistema
sudo apt update
sudo apt install -y php8.2-curl php8.2-mysql php8.2-xml php8.2-mbstring
sudo apt install -y nginx mysql-server
```

### 2. Clonar Repositorio

```bash
# En /var/www/ o tu directorio preferido
cd /var/www
git clone https://github.com/usuario/parqueadero.git
cd parqueadero

# Checkout a rama deseada
git checkout main
```

### 3. Instalar Dependencias

```bash
# Composer
composer install --no-dev --optimize-autoloader

# Node.js (temporal para build)
npm install
npm run build

# Limpiar node_modules después (opcional)
# rm -rf node_modules package-lock.json
```

### 4. Configurar Entorno

```bash
cp .env.example .env
```

Edita `.env` con valores de producción:

```env
APP_NAME="Parqueadero Motos"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

# Base de datos
DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=parqueadero_prod
DB_USERNAME=parqueadero_user
DB_PASSWORD=contraseña_segura_aqui

# Aplicación
APP_KEY=<corre php artisan key:generate>

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_email@gmail.com
MAIL_PASSWORD=app_password
MAIL_FROM_ADDRESS=noreply@parqueadero.com

# Cache
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Seguridad
CSRF_TRUSTED_HOSTS=.tudominio.com
```

### 5. Generar Llave de Aplicación

```bash
php artisan key:generate
```

### 6. Preparar Base de Datos

```bash
# Crear base de datos
mysql -u root -p
CREATE DATABASE parqueadero_prod CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'parqueadero_user'@'localhost' IDENTIFIED BY 'contraseña_segura';
GRANT ALL PRIVILEGES ON parqueadero_prod.* TO 'parqueadero_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

```bash
# Ejecutar migraciones
php artisan migrate --force

# Cargar datos iniciales
php artisan db:seed --force
```

### 7. Optimizaciones Laravel

```bash
# Cache de configuración
php artisan config:cache

# Cache de rutas
php artisan route:cache

# Cache de vistas
php artisan view:cache

# Optimización de autoload
composer install --no-dev --optimize-autoloader
```

### 8. Configurar Permisos

```bash
# Propietario de archivos
sudo chown -R www-data:www-data /var/www/parqueadero

# Permisos de carpetas
sudo chmod -R 755 /var/www/parqueadero

# Permisos de escritura para storage
sudo chmod -R 775 /var/www/parqueadero/storage
sudo chmod -R 775 /var/www/parqueadero/bootstrap/cache
```

### 9. Configurar Nginx

Crear archivo `/etc/nginx/sites-available/parqueadero`:

```nginx
server {
    listen 80;
    server_name tudominio.com www.tudominio.com;
    
    # Redirigir a HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name tudominio.com www.tudominio.com;
    root /var/www/parqueadero/public;
    index index.php;

    # SSL Certificates (Let's Encrypt)
    ssl_certificate /etc/letsencrypt/live/tudominio.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/tudominio.com/privkey.pem;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header X-XSS-Protection "1; mode=block";
    add_header Referrer-Policy "no-referrer-when-downgrade";

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.ht {
        deny all;
    }

    # Cache estático
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

Habilitar sitio:
```bash
sudo ln -s /etc/nginx/sites-available/parqueadero /etc/nginx/sites-enabled/
sudo nginx -s reload
```

### 10. SSL con Let's Encrypt

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot certonly --nginx -d tudominio.com -d www.tudominio.com

# Auto-renovación
sudo systemctl enable certbot.timer
sudo systemctl start certbot.timer
```

### 11. Supervisor para Queue (opcional)

```bash
sudo apt install supervisor
```

Crear `/etc/supervisor/conf.d/parqueadero.conf`:

```ini
[program:parqueadero-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/parqueadero/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
numprocs=4
redirect_stderr=true
stdout_logfile=/var/www/parqueadero/storage/logs/worker.log
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start parqueadero-worker:*
```

### 12. Backups Automáticos

```bash
# Script de backup
sudo nano /usr/local/bin/backup-parqueadero.sh
```

```bash
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backups/parqueadero"
mkdir -p $BACKUP_DIR

# Backup de base de datos
mysqldump -u parqueadero_user -p'contraseña' parqueadero_prod | gzip > $BACKUP_DIR/db_$DATE.sql.gz

# Backup de archivos
tar -czf $BACKUP_DIR/files_$DATE.tar.gz /var/www/parqueadero/storage/app

# Mantener solo últimos 30 días
find $BACKUP_DIR -type f -mtime +30 -delete
```

```bash
sudo chmod +x /usr/local/bin/backup-parqueadero.sh

# Agregar a crontab (diario a las 2 AM)
sudo crontab -e
# 0 2 * * * /usr/local/bin/backup-parqueadero.sh
```

### 13. Monitoreo y Logs

```bash
# Ver logs
tail -f /var/www/parqueadero/storage/logs/laravel.log

# Logs rotativos
sudo apt install logrotate
```

Crear `/etc/logrotate.d/parqueadero`:

```
/var/www/parqueadero/storage/logs/*.log {
    daily
    missingok
    rotate 14
    compress
    notifempty
    create 0640 www-data www-data
    sharedscripts
}
```

## 📊 Post-Deployment

### Verificaciones

```bash
# Status de aplicación
php artisan tinker
>>> config('app.debug')  # Debe ser false

# Verificar conexiones
php artisan db:show

# Status de workers
sudo supervisorctl status parqueadero-worker:*
```

### Monitoreo Recomendado

- CPU y Memoria
- Espacio en disco
- MySQL performance
- Nginx logs
- Laravel logs
- Backups

Usar herramientas como:
- **Datadog**
- **New Relic**
- **Sentry** (error tracking)

## 🔄 Actualizar en Producción

```bash
# Puller cambios
git pull origin main

# Instalar dependencias nuevas
composer install --no-dev

# Compilar assets
npm install
npm run build

# Migraciones
php artisan migrate --force

# Limpiar cache
php artisan cache:clear
php artisan config:clear

# Reiniciar workers
sudo supervisorctl restart parqueadero-worker:*

# Reiniciar nginx
sudo systemctl restart nginx
```

## 🆘 Troubleshooting

**"500 Internal Server Error":**
```bash
tail -f /var/log/nginx/error.log
tail -f /var/www/parqueadero/storage/logs/laravel.log
```

**Base de datos no conecta:**
```bash
php artisan db:show
# Verifica credenciales en .env
```

**Permiso denegado:**
```bash
sudo chown -R www-data:www-data /var/www/parqueadero/storage
```

---

¿Preguntas? Contacta al equipo de soporte.
