<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'incidencia_id', 'descripcion', 'estado', 'quien_asume_costo', 'encargado_id', 'costo', 'comentario',
    ];

    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class);
    }
// En el modelo Tarea
    public function encargado()
    {
        return $this->belongsTo(User::class, 'encargado');
    }


}
