<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Attraction; // Asegúrate de importar esto
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Para borrar fotos

class ActivityController extends Controller
{
    // --- GESTIÓN DE PASES (ACTIVITIES) ---

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Activity::create($validated + ['active' => true]);

        return back();
    }

    public function toggle(Activity $activity)
    {
        $activity->update(['active' => !$activity->active]);
        return back();
    }

    // FALTABA ESTE:
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return back();
    }


    // --- GESTIÓN DE ATRACCIONES (GALERÍA) ---

    // FALTABA ESTE:
    public function storeAttraction(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|max:2048', // Max 2MB
        ]);

        // Guardar imagen en storage/app/public/attractions
        $path = $request->file('image')->store('attractions', 'public');

        Attraction::create([
            'title' => $request->title,
            'description' => $request->description, // Opcional
            'image_path' => '/storage/' . $path, // Guardamos la URL pública
        ]);

        return back();
    }

    // FALTABA ESTE:
    public function destroyAttraction(Attraction $attraction)
    {
        // Opcional: Borrar el archivo físico
        // Storage::disk('public')->delete(str_replace('/storage/', '', $attraction->image_path));
        
        $attraction->delete();
        return back();
    }
}