<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Activity;
use App\Models\Attraction;
use App\Models\Waiver;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            // 1. OPERACIONES: Datos procesados para la tabla
            // Usamos 'map' para formatear nombre, precio y duración exactamente como lo necesitas
            'bookings' => Booking::with('waiver')
                ->latest()
                ->take(50) // Traemos las últimas 50 para tener buen historial
                ->get()
                ->map(function ($booking) {
                    return [
                        'id' => $booking->id,
                        'status' => $booking->status,
                        
                        // A NOMBRE DE QUIÉN:
                        // Si hay waiver, usamos el nombre real. Si no, mostramos advertencia.
                        'customer_name' => $booking->waiver ? $booking->waiver->full_name : '⚠️ Firma Pendiente',
                        'email' => $booking->email_contact,
                        
                        // DATOS DE VENTA:
                        'jumpers' => $booking->jumpers,       // Cantidad de personas
                        'duration' => $booking->duration,     // Duración (Horas/Minutos)
                        'total_price' => $booking->total_price, // Cuánto pagó
                        
                        // FECHA Y HORA:
                        'date' => $booking->date,
                        'time_slot' => $booking->time_slot,
                        
                        // Útil para lógica de frontend
                        'waiver_id' => $booking->waiver ? $booking->waiver->id : null,
                    ];
                }),
            
            // 2. ATRACCIONES (Se mantiene igual para no romper props, aunque no lo toquemos hoy)
            'attractions' => Attraction::latest()->get(),
            
            // 3. PASES Y PRECIOS (Se mantiene igual)
            'activities' => Activity::orderBy('price')->get(),
            
            // 4. ESTADÍSTICAS (KPIs)
            'stats' => [
                'income' => Booking::where('status', '!=', 'cancelled')->sum('total_price'),
                'total_bookings' => Booking::count(),
                'total_waivers' => Waiver::count(),
                'active_jumpers' => Booking::where('status', 'checked_in')->sum('jumpers'),
            ]
        ]);
    }
}