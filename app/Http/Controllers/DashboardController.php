<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Activity;
use App\Models\Attraction;
use App\Models\Waiver;
use Illuminate\Http\Request; // Importante para detectar al usuario
use Inertia\Inertia;
use Carbon\Carbon; // Para manejar fechas

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Obtenemos el usuario logueado
        $user = $request->user();

        // ------------------------------------------------------
        // ESCENARIO 1: ES ADMINISTRADOR
        // ------------------------------------------------------
        if ($user->role === 'admin') {
            return Inertia::render('Admin/Dashboard', [
                // 1. OPERACIONES: Datos procesados para la tabla
                'bookings' => Booking::with('waiver')
                    ->latest()
                    ->take(50)
                    ->get()
                    ->map(function ($booking) {
                        return [
                            'id' => $booking->id,
                            'status' => $booking->status,
                            'customer_name' => $booking->waiver ? $booking->waiver->full_name : '⚠️ Firma Pendiente',
                            'email' => $booking->email_contact,
                            'jumpers' => $booking->jumpers,
                            'duration' => $booking->duration,
                            'total_price' => $booking->total_price,
                            'date' => $booking->date,
                            'time_slot' => $booking->time_slot,
                            'waiver_id' => $booking->waiver ? $booking->waiver->id : null,
                        ];
                    }),
                
                // 2. CONFIGURACIÓN (Pases)
                'activities' => Activity::orderBy('price')->get(),
                
                // 3. MARKETING (Atracciones)
                'attractions' => Attraction::latest()->get(),
                
                // 4. ESTADÍSTICAS (KPIs)
                'stats' => [
                    'income' => Booking::where('status', '!=', 'cancelled')->sum('total_price'),
                    'total_bookings' => Booking::count(),
                    'total_waivers' => Waiver::count(),
                    'active_jumpers' => Booking::where('status', 'checked_in')->sum('jumpers'),
                ]
            ]);
        }

        // ------------------------------------------------------
        // ESCENARIO 2: ES CLIENTE (CUSTOMER)
        // ------------------------------------------------------
        return Inertia::render('Client/Dashboard', [
            // Buscamos las reservas vinculadas a este email
            'my_bookings' => Booking::where('email_contact', $user->email)
                ->orderBy('date', 'desc')
                ->orderBy('time_slot', 'desc')
                ->get()
                ->map(function ($booking) {
                    return [
                        'id' => $booking->id,
                        'date' => $booking->date,
                        'time' => $booking->time_slot,
                        'jumpers' => $booking->jumpers,
                        'total' => $booking->total_price,
                        'status' => $booking->status,
                        // Calculamos si es pasado para mostrarlo en el historial
                        'is_past' => Carbon::parse($booking->date)->endOfDay()->isPast()
                    ];
                }),
            'user' => $user
        ]);
    }
}