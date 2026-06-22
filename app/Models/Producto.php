<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

   protected $fillable = ['nombre', 
   'descripcion',
    'precio', 
    'stock', 
    'tallas', 
    'categoria', 
    'imagen',
     'codigo_barras'];

// Esto le dice a Laravel que "tallas" se guarda como JSON pero lo usas como Array
protected $casts = [
    'tallas' => 'array',
];
}