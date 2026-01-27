<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Waiver;
use App\Models\Activity; 
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    // 1. MOSTRAR FORMULARIO
    public function create(Request $request)
    {
        return Inertia::render('Booking', [
            // Datos que vienen del Waiver (si existen)
            'prefilled' => [
                'waiver_id' => $request->waiver_id ?? null, 
                'jumpers' => $request->jumpers ? (int)$request->jumpers : 1 
            ],
            // IMPORTANTE: Enviamos las actividades activas para calcular precios
            'activities' => Activity::where('active', true)->orderBy('price')->get()
        ]);
    }

    // 2. GUARDAR RESERVA
    public function store(Request $request)
    {
        // A. Validar
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|string',
            'duration' => 'required|integer', // Aceptamos cualquier duración válida de la DB
            'jumpers' => 'required|integer|min:1|max:50',
            'email_contact' => 'required|email',
            'total_price' => 'required|numeric',
            'waiver_id' => 'nullable|exists:waivers,id'
        ]);

        // B. Crear Reserva (quitamos waiver_id del array de datos)
        $bookingData = collect($validated)->except(['waiver_id'])->toArray();
        $bookingData['status'] = 'pending'; 
        
        $booking = Booking::create($bookingData);

        // C. VINCULACIÓN: Si viene de un waiver, actualizamos ese waiver
        if ($request->waiver_id) {
            Waiver::where('id', $request->waiver_id)->update([
                'booking_id' => $booking->id
            ]);
        }

        // D. REDIRECCIÓN AL ÉXITO
        // Nota: No necesitamos cargar la relación aquí porque es un redirect.
        // La carga de datos (load('waiver')) se hace en la ruta GET /reserva/exito/{booking} en web.php
        return to_route('booking.success', ['booking' => $booking->id]);
    }

    // 3. ACTUALIZAR ESTADO (Para el Dashboard / Check-in)
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:checked_in,cancelled,pending,confirmed,completed'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Estado actualizado correctamente.');
    }
}