<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Controladores Principales
use App\Http\Controllers\WaiverController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ActivityController;

// Modelos
use App\Models\Attraction;
use App\Models\Booking;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTAS PÚBLICAS ---

Route::get('/', function () {
    return Inertia::render('Home'); 
})->name('home');

Route::get('/nosotros', function () {
    return Inertia::render('aboutUs'); 
})->name('about');

Route::get('/actividades', function () {
    return Inertia::render('Activities', [
        'attractions' => Attraction::all()
    ]);
})->name('activities');

Route::get('/precios', function () {
    return Inertia::render('Prices'); 
})->name('prices');

Route::get('/contacto', function () {
    return Inertia::render('Contact'); 
})->name('contact');


// --- LEGALES Y AYUDA ---

Route::get('/reglas', function () {
    return Inertia::render('Rules'); 
})->name('rules');

Route::get('/preguntas-frecuentes', function () {
    return Inertia::render('Faqs'); 
})->name('faqs');


// --- FLUJO LINEAL: WAIVER -> RESERVA -> ÉXITO ---

// 1. WAIVER (Inicio del flujo)
Route::get('/waiver', [WaiverController::class, 'create'])->name('waiver.create');
Route::post('/waiver/guardar', [WaiverController::class, 'store'])->name('waiver.store');

// 2. RESERVA (Venta vinculada al waiver)
Route::get('/reserva', [BookingController::class, 'create'])->name('booking.create');
Route::post('/reserva/guardar', [BookingController::class, 'store'])->name('booking.store');

// 3. ÉXITO (Confirmación final)
Route::get('/reserva/exito/{booking}', function (Booking $booking) {
    // CORRECCIÓN CRÍTICA: Cargamos la relación 'waiver' para mostrar los nombres en el ticket
    return Inertia::render('BookingSuccess', [ 
        'booking' => $booking->load('waiver') 
    ]);
})->name('booking.success');


// --- DASHBOARD (Área Privada) ---

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// --- ADMINISTRACIÓN ---
Route::middleware(['auth', 'verified'])->group(function () {
    // Gestión de Pases (Precios)
    Route::post('/admin/activities', [ActivityController::class, 'store'])->name('admin.activities.store');
    Route::patch('/admin/activities/{activity}/toggle', [ActivityController::class, 'toggle'])->name('admin.activities.toggle');
    Route::delete('/admin/activities/{activity}', [ActivityController::class, 'destroy'])->name('admin.activities.destroy');

    // Gestión de Atracciones (Marketing)
    Route::post('/admin/attractions', [ActivityController::class, 'storeAttraction'])->name('admin.attractions.store');
    Route::delete('/admin/attractions/{attraction}', [ActivityController::class, 'destroyAttraction'])->name('admin.attractions.destroy');

    // Estado de Reserva (Operaciones)
    Route::patch('/reserva/{booking}/estado', [BookingController::class, 'updateStatus'])->name('booking.status');
});


// --- PERFIL DE USUARIO ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';