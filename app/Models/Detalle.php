<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detalle extends Model
{
    use HasFactory;

    // Desactivamos timestamps ya que no hay created_at ni updated_at en la tabla
    public $timestamps = false;

    protected $fillable = [
        'cantidad',
        'preciototal',
        'producto_id',
        'pedido_id',
    ];

    /**
     * Relación: Un detalle pertenece a un producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    /**
     * Relación: Un detalle pertenece a un pedido.
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
