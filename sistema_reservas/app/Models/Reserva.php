<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'propiedad_id', 'user_id', 'fecha_inicio', 'fecha_fin',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedades::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
