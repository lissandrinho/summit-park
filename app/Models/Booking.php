<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // SEGURIDAD: Definimos campos permitidos
    protected $fillable = [
        'customer_name',
        'email_contact',
        'phone_contact',
        'date',
        'time_slot',
        'duration',
        'jumpers',
        'total_price',
        'status', // 'pending', 'confirmed', 'checked_in', 'cancelled'
        'payment_status'
    ];

    protected $appends = ['waiver_signed']; // Para que Vue lo reciba siempre

    // RELACIÓN
    public function waiver()
    {
        return $this->hasOne(Waiver::class);
    }

    // ACCESOR: Permite usar booking.waiver_signed en Vue
    public function getWaiverSignedAttribute()
    {
        return $this->waiver()->exists();
    }
}