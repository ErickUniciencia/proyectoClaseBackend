<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oportunidad extends Model
{
    use HasFactory;

    protected $table = 'oportunidades'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'cliente_id',
        'nombre',
        'estado',
        'monto',
        'fecha_creacion',
    ];

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
