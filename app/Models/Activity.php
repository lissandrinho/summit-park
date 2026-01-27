<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    // ESTA ES LA LÍNEA QUE TE FALTA
    protected $fillable = ['name', 'duration', 'price', 'active']; 
}