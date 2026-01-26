<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validar
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|string',
            'duration' => 'required|integer|in:60,90,120',
            'jumpers' => 'required|integer|min:1|max:50',
            'email_contact' => 'required|email', // Necesario para enviar el comprobante
            'total_price' => 'required|numeric',
        ]);

        // 2. Guardar en Base de Datos
        $booking = Booking::create($validated);

        // Redirigir al waiver para que firmen antes de ver el éxito
        return to_route('waiver.create', $booking->id);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:checked_in,cancelled,pending'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Estado de la reserva actualizado.');
    }
}