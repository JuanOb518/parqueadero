# Guía de Contribución - Parqueadero

¡Gracias por tu interés en contribuir a Parqueadero! Este documento proporciona directrices y procesos para contribuir.

## 🚀 Cómo Empezar

### Prerrequisitos
- Git instalado
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL/MariaDB para base de datos

### Configuración Local

1. **Fork el repositorio**
   - Haz clic en "Fork" en la página de GitHub

2. **Clona tu fork**
   ```bash
   git clone https://github.com/TU_USUARIO/parqueadero.git
   cd parqueadero
   ```

3. **Configura el upstream**
   ```bash
   git remote add upstream https://github.com/USUARIO_ORIGINAL/parqueadero.git
   ```

4. **Instala dependencias**
   ```bash
   # Opción 1: Usar script automático (Ubuntu/macOS)
   ./install.sh
   
   # Opción 2: Usar script automático (Windows)
   install.bat
   
   # Opción 3: Manual
   composer install
   npm install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   ```

## 📝 Proceso de Contribución

### 1. Crear una Nueva Rama
```bash
# Actualiza master
git checkout develop
git pull upstream develop

# Crea tu rama
git checkout -b feature/tu-feature-descriptiva
```

**Convención de nombres de ramas:**
- `feature/descripcion` - Para nuevas características
- `fix/descripcion` - Para correcciones de bugs
- `docs/descripcion` - Para cambios en documentación
- `refactor/descripcion` - Para refactorización de código

### 2. Hacer los Cambios

- Mantén los commits pequeños y descriptivos
- Una funcionalidad por commit cuando sea posible
- Usa mensajes descriptivos en español o inglés

```bash
# Ejemplo de buen commit
git commit -m "feat: agregar validación de placa de moto"
```

### 3. Pruebas

Antes de hacer push:

```bash
# Ejecutar tests (si existen)
php artisan test

# Verificar código con linter
./vendor/bin/pint

# Compilar assets
npm run build
```

### 4. Hacer Push y Pull Request

```bash
# Push a tu branch
git push origin feature/tu-feature-descriptiva
```

**En GitHub:**
1. Ve a tu fork
2. Haz clic en "Compare & pull request"
3. Rellena la descripción:
   - Qué cambios haces
   - Por qué son necesarios
   - Referencia a issues relacionados (#123)

**Ejemplo de descripción:**
```
## Descripción
Agrega validación mejorada de placas de motocicleta.

## Cambios
- Valida formato de placa según país
- Agrega mensajes de error personalizados
- Actualiza tests

Cierra #123
```

## 📋 Estándares de Código

### PHP/Laravel
- Usa PSR-2 para estilo de código
- Documenta métodos públicos con docblocks
- Usa type hints
- Sigue convenciones de Laravel

```php
/**
 * Registra una nueva moto en el sistema
 *
 * @param  array  $data
 * @return \App\Models\Motorcycle
 */
public function registerMotorcycle(array $data): Motorcycle
{
    // ...
}
```

### JavaScript
- Usa ES6+ syntax
- Declara variables con `const` o `let`
- Sigue la guía de Airbnb

### SQL
- Usa lowercase para keywords
- Usa snake_case para nombres de columnas
- Comenta cambios complejos

## 🐛 Reportar Bugs

1. Verifica que el bug no esté reportado
2. Usa el título descriptivo
3. Proporciona:
   - Pasos para reproducir
   - Comportamiento esperado
   - Comportamiento actual
   - Screenshots si es relevante
   - Tu entorno (PHP version, OS, etc)

## 🎨 Solicitar Características

1. **Título**: Describe la característica brevemente
2. **Contexto**: Explica por qué es útil
3. **Ejemplos**: Proporciona casos de uso
4. **Alternativas**: Describe alternativas consideradas

## ✅ Checklist Antes de Hacer Submit

- [ ] Mi código sigue los estándares del proyecto
- [ ] He actualizado la documentación relevante
- [ ] He agregado tests si es aplicable
- [ ] Los tests pasan localmente
- [ ] Mis cambios no crean nuevas advertencias
- [ ] He limpiado commits inútiles de mi rama

## 📚 Recursos

- [Documentación de Laravel](https://laravel.com/docs)
- [Guía de Tailwind CSS](https://tailwindcss.com/docs)
- [Estándares PSR](https://www.php-fig.org/psr/)

## 🤝 Código de Conducta

Por favor sé respetuoso con otros contribuidores. Nos reservamos el derecho de rechazar contribuciones que violen el código de conducta.

---

**¡Gracias por contribuir a hacer Parqueadero mejor!** 🙏
