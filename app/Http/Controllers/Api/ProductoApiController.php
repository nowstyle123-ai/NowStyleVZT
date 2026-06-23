<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductoApiController extends Controller
{
    public function store(Request $request)
    {
        try {
            // 1. Validamos los datos (asegúrate de que los nombres coincidan con Android)
            $request->validate([
                'nombre'      => 'required|string|max:255',
                'descripcion' => 'required|string|max:1000',
                'precio'      => 'required|numeric',
                'stock'       => 'required|integer',
                'tallas'       => 'required|string',
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
                'codigo_barras' => 'VZT-' . time(), // Código automático
                'nombre'        => $request->nombre,
                'descripcion'   => $request->descripcion,
                'precio'        => $request->precio,
                'stock'         => $request->stock,
                'tallas'         => $request->tallas,
                'categoria'     => $request->categoria,
                'imagen'        => $rutaImagen, // Guardamos la ruta de la foto
            ]);

            // 4. Respuesta de éxito
            return response()->json([
                'success' => true,
                'message' => '¡Producto guardado con éxito!',
                'data'    => $producto
            ], 201);

        } catch (\Exception $e) {
            // Si hay un error, lo guardamos en el log para saber qué pasó
            Log::error('Error en ProductoApiController: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error en el servidor',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}