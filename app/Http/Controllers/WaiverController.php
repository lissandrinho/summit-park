<?php

namespace App\Http\Controllers;

use App\Models\Waiver;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WaiverController extends Controller
{
    public function create()
    {
        return inertia('waiver', ['booking' => null]);
    }

    public function store(Request $request)
    {
        // 1. Validar
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'document_id' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'signature' => 'required|string', 
            'terms_accepted' => 'accepted',
            'minors' => 'nullable|array|max:3',
            'minors.*.name' => 'required|string|max:255',
            'minors.*.document_id' => 'required|string|max:20',
        ]);

        // 2. Crear Waiver (Booking ID es null por ahora)
        $waiver = Waiver::create([
            'booking_id' => null, 
            'full_name' => $validated['full_name'],
            'document_id' => $validated['document_id'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'birth_date' => $validated['birth_date'],
            'minors' => $validated['minors'] ?? [], 
            'signature' => $validated['signature'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        // 3. Calcular Jumpers
        $totalJumpers = 1 + count($validated['minors'] ?? []);

        // --- AQUÍ ESTABA EL ERROR ---
        // ANTES: return to_route('home');
        // AHORA: Redirigimos al Booking pasando el ID del waiver
        return to_route('booking.create', [
            'waiver_id' => $waiver->id,
            'jumpers' => $totalJumpers
        ]);
    }
}