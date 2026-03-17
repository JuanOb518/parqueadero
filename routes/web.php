<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', [PublicController::class, 'inicio'])->name('public.inicio');
Route::get('/tarifas', [PublicController::class, 'tarifas'])->name('public.tarifas');
Route::get('/disponibilidad', [PublicController::class, 'disponibilidad'])->name('public.disponibilidad');
Route::get('/contacto', [PublicController::class, 'contacto'])->name('public.contacto');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Panel de control
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Gestión de planes
    Route::resource('planes', PlanController::class);

    // Gestión de motocicletas
    Route::resource('motos', MotorcycleController::class);
    Route::get('/motos-buscar', [MotorcycleController::class, 'buscar'])->name('motos.buscar');

    // Gestión de parqueos
    Route::resource('parqueos', ParkingController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::get('/parqueos/historial', [ParkingController::class, 'show'])->name('parqueos.historial');

    // Configuración
    Route::get('/configuracion', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/configuracion', [SettingController::class, 'update'])->name('settings.update');

    // Profile routes (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
