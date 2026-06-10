<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Campos que permitimos guardar en la base de datos
    protected $fillable = ['user_id', 'detalles', 'total', 'estado'];

    // Relación para saber qué usuario hizo el pedido
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}