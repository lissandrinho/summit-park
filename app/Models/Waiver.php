<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiver extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'full_name',
        'document_id',
        'email',
        'phone',
        'birth_date',
        'minors', // Importante: Debe ser casted a array
        'signature',
        'ip_address',
        'user_agent'
    ];

    // Convierte automáticamente el JSON de la BD a Array en PHP
    protected $casts = [
        'minors' => 'array',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}