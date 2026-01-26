<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\WaiverController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ActivityController;
use App\Models\Attraction;
use App\Models\Booking;
use App\Models\Activity;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí registramos las rutas de la aplicación. Todas las rutas
| públicas del sitio web están definidas aquí.
|
*/


Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/nosotros', function () {
    return Inertia::render('aboutUs');
})->name('about');

Route::get('/actividades', function () {
    return Inertia::render('Activities');
})->name('activities');

Route::get('/precios', function () {
    return Inertia::render('Prices');
})->name('prices');

Route::get('/contacto', function () {
    return Inertia::render('Contact');
})->name('contact');

// --- PÁGINAS LEGALES Y DE AYUDA (Footer) ---

Route::get('/reglas', function () {
    return Inertia::render('Rules');
})->name('rules');

Route::get('/preguntas-frecuentes', function () {
    return Inertia::render('Faqs'); 
})->name('faqs');

// Ruta principal de waiver - redirige a reserva si no hay booking
Route::redirect('/waiver', '/reserva')->name('waiver');

// Ruta para firmar waiver - booking es opcional
Route::get('/waiver/firmar/{booking?}', function ($bookingId = null) {
    $booking = null;
    if ($bookingId) {
        $booking = Booking::find($bookingId);
        if (!$booking) {
            return redirect()->route('booking')->with('error', 'Reserva no encontrada. Por favor, crea una nueva reserva.');
        }
    }
    
    return Inertia::render('waiver', [
        'booking' => $booking
    ]); 
})->name('waiver.create');

Route::get('/reserva', function () {
    return Inertia::render('Booking', [
        // CAMBIO CLAVE: Usamos 'Activity' en lugar de 'Attraction'
        'activities' => Activity::where('active', true)->orderBy('price')->get()
    ]);
})->name('booking');

Route::get('/reserva/exito/{booking}', function (Booking $booking) {
    return Inertia::render('BookingSuccess', [
        'booking' => $booking
    ]);
})->name('booking.success');
Route::post('/waiver/guardar', [WaiverController::class, 'store'])->name('waiver.store');
Route::post('/reserva/guardar', [BookingController::class, 'store'])->name('booking.store');


// --- PÁGINAS PRIVADAS (Requieren Login) ---

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'bookings' => \App\Models\Booking::latest()->take(10)->get(),
        'waivers' => \App\Models\Waiver::latest()->take(10)->get(),
        
        // ESTA ES LA LÍNEA NUEVA:
        'activities' => \App\Models\Activity::orderBy('price')->get(),

        'stats' => [
            'income' => \App\Models\Booking::sum('total_price'),
            'total_bookings' => \App\Models\Booking::count(),
            'total_waivers' => \App\Models\Waiver::count(),
        ]
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Al usar ActivityController::class, PHP usará el "use" que pusimos arriba
    Route::post('/admin/activities', [ActivityController::class, 'store'])->name('admin.activities.store');
    Route::patch('/admin/activities/{activity}/toggle', [ActivityController::class, 'toggle'])->name('admin.activities.toggle');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::patch('/reserva/{booking}/estado', [\App\Http\Controllers\BookingController::class, 'updateStatus'])
        ->name('booking.status');
});

// --- RUTAS DE AUTENTICACIÓN (Login, Register, etc.) ---
require __DIR__.'/auth.php';