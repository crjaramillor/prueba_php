<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedades extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'price_per_night',
        'owner_id',
        'description',
    ];
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
