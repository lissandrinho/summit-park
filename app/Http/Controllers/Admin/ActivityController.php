<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // Guardar un nuevo pase (1h, 2h, etc)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Activity::create($validated + ['active' => true]);

        return back()->with('success', 'Pase creado con éxito.');
    }

    // Activar/Desactivar pase
    public function toggle(Activity $activity)
    {
        $activity->update(['active' => !$activity->active]);
        return back();
    }
}