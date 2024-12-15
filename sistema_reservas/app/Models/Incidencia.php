<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'propiedad_id', 'user_id', 'descripcion', 'estado',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedades::class);
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}
