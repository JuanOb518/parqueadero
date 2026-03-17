# GUÍA DE INICIO RÁPIDO

## 🚀 Primeros Pasos

### 1. Iniciar el Servidor
```bash
php artisan serve
```

El sistema estará disponible en: **http://localhost:8000**

### 2. Acceder al Panel Administrativo

**URL**: http://localhost:8000/login

**Credenciales**:
- Email: `admin@parqueadero.com`
- Contraseña: `password`

### 3. Configuración Inicial

Después de iniciar sesión, ve a **Configuración** y personaliza:
- Nombre del parqueadero
- Dirección de ubicación
- Teléfono de contacto
- Correo electrónico
- Número total de espacios
- Tarifa por hora

## 📋 Flujo de Trabajo Diario

### Registrar Entrada de Motocicleta
1. Haz clic en **Parqueos** > **Registrar Entrada**
2. Ingresa la placa de la motocicleta
3. (Opcional) Selecciona un plan de pago
4. Confirma la entrada

### Registrar Salida de Motocicleta
1. Ve a **Parqueos** (sección de activos)
2. Busca la motocicleta parqueada
3. Haz clic en **Registrar Salida**
4. Verifica el costo calculado
5. Marca si el pago fue recibido
6. Confirma la salida

### Gestionar Planes
1. Ve a **Planes**
2. Crea nuevos planes o edita los existentes
3. Define: Nombre, Duración, Precio y Descripción

### Ver Historial de Transacciones
1. Ve a **Parqueos** > **Historial**
2. Ve todos los parqueos completados
3. Consulta montos totales por estado de pago

## 🔑 Información de Configuración Inicial

### Planes Predefinidos
- **Mensualidad**: $50,000 (acceso completo 1 mes)
- **Día Completo**: $2,500 (acceso 24 horas)
- **Hora**: $500 (por hora o fracción)

### Configuración del Sistema
- **Total de espacios**: 50
- **Tarifa por hora** (sin plan): $500
- **Ocupación máxima**: se controla automáticamente

## 📱 Vista Pública

Los visitantes pueden acceder a:
- **Inicio**: Información general http://localhost:8000/
- **Tarifas**: Planes disponibles http://localhost:8000/tarifas
- **Disponibilidad**: Espacios libres http://localhost:8000/disponibilidad
- **Contacto**: Información de ubicación http://localhost:8000/contacto

## 🔐 Cambiar Contraseña Admin

1. Haz clic en tu nombre (arriba a la derecha)
2. Ve a **Perfil**
3. Cambia tu contraseña

## 📊 Reportes y Estadísticas

En el **Dashboard** puedes ver:
- Motos parqueadas actualmente
- Espacios disponibles
- Ingresos del día
- Últimas transacciones
- Motocicletas actualmente estacionadas

## ⚙️ Troubleshooting

### El servidor no inicia
```bash
php artisan cache:clear
php artisan config:clear
php artisan serve
```

### Problemas con base de datos
```bash
php artisan migrate:fresh --seed
```

### Permisos de almacenamiento
```bash
php artisan storage:link
```

## 📝 Notas Importantes

- Los datos se guardan en SQLite (database/database.sqlite)
- Las fotos se almacenan en storage/app/public/motos
- Todos los datos son locales (no requiere servidor externo)
- El sistema es para uso local/LAN

¡Listo para usar! 🎉
