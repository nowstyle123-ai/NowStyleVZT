<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_barras',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'talla',
        'categoria',
        'imagen' 
    ];
}