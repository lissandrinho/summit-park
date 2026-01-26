<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia; // Importante para conectar con Vue

class HomeController extends Controller
{
    public function index()
    {
        // Aquí luego cargaremos las atracciones de la base de datos.
        // Por ahora, solo le decimos: "Muestra la vista llamada Home"
        return Inertia::render('Home', [
            'canLogin' => \Illuminate\Support\Facades\Route::has('login'),
            'canRegister' => \Illuminate\Support\Facades\Route::has('register'),
        ]);
    }
}