<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'subtotal',
        'impuesto',
        'total',
        'entregado',
        'user_id',
    ];

    /**
     * Relación: Un pedido pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un pedido tiene muchos detalles.
     */
    public function detalles()
    {
        return $this->hasMany(Detalle::class);
    }
}
