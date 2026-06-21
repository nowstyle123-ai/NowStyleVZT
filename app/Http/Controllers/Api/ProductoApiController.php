<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoApiController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validamos los datos (con los nombres exactos que enviamos desde Android)
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio'      => 'required|numeric',
            'stock'       => 'required|integer',
            'talla'       => 'required|string',
            'categoria'   => 'required|string',
            'imagen'      => 'nullable|image|mimes:jpg,jpeg,png|max:4096' 
        ]);

        // 2. Manejo de la imagen (si el celular la envió)
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            // Guarda la imagen en storage/app/public/productos
            $rutaImagen = $request->file('imagen')->store('productos', 'public');
        }

        // 3. Creamos el producto en la base de datos
        $producto = Producto::create([
            'codigo_barras' => 'VZT-' . time(), // Generamos uno automático
            'nombre'        => $request->nombre,
            'descripcion'   => $request->descripcion,
            'precio'        => $request->precio,
            'stock'         => $request->stock,
            'talla'         => $request->talla,
            'categoria'     => $request->categoria,
            'imagen'        => $rutaImagen, // Guardamos la ruta de la foto
        ]);

        // 4. Respuesta de éxito
        return response()->json([
            'success' => true,
            'message' => '¡Producto guardado con éxito!',
            'data'    => $producto
        ], 201);
    }
}