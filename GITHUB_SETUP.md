# 📱 Sincronización con GitHub - Parqueadero

El proyecto **Parqueadero** ya está configurado como repositorio Git local y listo para ser compartido en GitHub.

## 🚀 Pasos para sincronizar con GitHub

### Paso 1: Crear repositorio en GitHub

1. Abre https://github.com/new
2. Completa los datos:
   - **Repository name**: `parqueadero-motorcycles`
   - **Description**: Motorcycle Parking Management System with Laravel 10
   - **Visibility**: Public (para compartir) o Private (solo tú)
   - **NO** inicialices con README, .gitignore o LICENSE

3. Click en **Create repository**

### Paso 2: Conectar el repositorio local

GitHub te mostrará instrucciones. Ejecuta en PowerShell:

```powershell
cd e:\parqueadero

git branch -M main

git remote add origin https://github.com/TU_USUARIO/parqueadero-motorcycles.git

git push -u origin main
```

> **Reemplaza `TU_USUARIO`** con tu nombre de usuario de GitHub

### Paso 3: Primera autenticación

GitHub requiere:
- **Token de acceso personal** (más seguro): https://github.com/settings/tokens
- O usar **SSH** (recomendado)

## 🔐 Configurar SSH (Recomendado)

Evita ingresar contraseñas cada vez:

```powershell
# Generar clave
ssh-keygen -t ed25519 -C "tu_email@github.com"
# Presiona Enter sin contraseña

# Ver tu clave pública
type $env:USERPROFILE\.ssh\id_ed25519.pub
# Cópiala

# Agregar a GitHub: https://github.com/settings/ssh/new
# Pega la clave completa

# Cambiar URL a SSH
git remote set-url origin git@github.com:TU_USUARIO/parqueadero-motorcycles.git
```

## 📤 Subir cambios

```powershell
git push
```

## 📥 Compartir con otros usuarios

Una vez en GitHub, comparte el enlace:
```
https://github.com/TU_USUARIO/parqueadero-motorcycles
```

Para que otros clonen el proyecto:

```powershell
git clone https://github.com/TU_USUARIO/parqueadero-motorcycles.git
cd parqueadero-motorcycles

# Instalar dependencias
composer install
npm install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Base de datos
php artisan migrate --seed

# Ejecutar
php artisan serve
```

## 📝 Flujo de trabajo diario

```powershell
# Ver cambios
git status

# Agregar cambios
git add .

# Crear commit
git commit -m "Descripción clara del cambio"

# Subir
git push
```

## 🌿 Ramas para desarrollo en equipo

```powershell
# Crear rama para feature
git checkout -b feature/nombre-del-feature

# Hacer cambios...

# Subir rama
git push origin feature/nombre-del-feature

# En GitHub: Crear Pull Request → Merge
```

---

**📋 Estado actual del repositorio local:**
- `master` branch listo ✓
- `.gitignore` configurado ✓
- Primer commit creado ✓
- Listo para conectar con GitHub ✓

**¿Dudas?** Ver: https://docs.github.com/en/get-started
