<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Campos autorizados para guardarse en la base de datos
protected $fillable = [
    'user_id',
    'detalles',
    'diseno_imagen',
    'total',
    'estado'
];

    /**
     * Relación con el usuario dueño del pedido
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}