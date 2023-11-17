<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMovimientoProducto extends Model
{
    use HasFactory;

    protected $table = 'detalles_movimientos_productos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'producto_id',
        'tipo_movimiento',
        'cantidad',
        'fecha_hora',
    ];

    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
