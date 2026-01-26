<?php

namespace App\Http\Controllers;

use App\Models\Waiver;
use App\Models\Booking; // Importante para la validación
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WaiverController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validar los datos incluyendo el array de menores
        $validated = $request->validate([
            // Vínculo con la reserva (opcional)
            'booking_id' => 'nullable|exists:bookings,id',

            // Datos del Adulto Responsable
            'full_name' => 'required|string|max:255',
            'document_id' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',

            // Lógica Grupal: Ahora es un array de menores
            'minors' => 'nullable|array', 
            'minors.*.name' => 'required|string|max:255',
            'minors.*.document_id' => 'required|string|max:50',
            'minors.*.birth_date' => 'required|date',

            // Legales
            'signature' => 'required|string', 
            'terms_accepted' => 'accepted',
        ]);

        try {
            $totalInWaiver = 1 + count($request->get('minors', []));

            // Si hay booking_id, validamos el límite de saltadores
            if ($request->booking_id) {
                $booking = Booking::findOrFail($request->booking_id);

                if ($totalInWaiver > $booking->jumpers) {
                    return back()->withErrors([
                        'error' => "Este deslinde cubre a {$totalInWaiver} personas, pero tu reserva es solo para {$booking->jumpers}. Por favor, ajusta los menores o contacta a soporte."
                    ]);
                }
            }

            // 3. Preparar datos para guardar
            $validated['ip_address'] = $request->ip();
            $validated['minors'] = json_encode($request->minors);

            Waiver::create($validated);

            // Redirigir según si hay booking o no
            if ($request->booking_id) {
                return to_route('booking.success', $request->booking_id);
            } else {
                return redirect()->route('home')->with('success', 'Waiver firmado exitosamente. ¡Gracias!');
            }

        } catch (\Exception $e) {
            Log::error('Error guardando waiver grupal: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Error en el servidor al procesar la firma.']);
        }
    }
}