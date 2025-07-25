<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'tipo',      // tipo 1 = cliente, 0 = admin
        'estado',    // activado = 1, no activado = 0
        'direccion',
        'Telefono'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed', // ❌ Esto se elimina
    ];

    // ✅ Este mutador se encarga de hashear la contraseña
    public function setPasswordAttribute($value)
    {
        // Solo lo hashea si no está ya hasheado
        if (!Hash::needsRehash($value)) {
            $value = Hash::make($value);
        }

        $this->attributes['password'] = $value;
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
