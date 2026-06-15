<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductoApiController extends Controller
{
    public function store(Request $request)
    {
        try {
            // 1. Validamos los datos (dejamos la imagen como opcional por si acaso)
            $request->validate([
                'nombre' => 'required|string|max:255', 
                'descripcion' => 'required|string',
                'precio' => 'required|numeric',
                'stock' => 'required|integer',
                'talla' => 'required|string',
                'categoria' => 'required|string',
                'imagen' => 'nullable|image|max:4096', // Valida que sea foto max 4MB
            ]);

            // 📸 PROCESAMOS LA FOTO ANTES DE GUARDAR
            $rutaFoto = null;
            if ($request->hasFile('imagen')) {
                // Guarda la foto en storage/app/public/productos
                $rutaFoto = $request->file('imagen')->store('productos', 'public');
            }

            // 2. Creamos el producto en la base de datos con su foto real
            $producto = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'stock' => $request->stock,
                'talla' => $request->talla,
                'categoria' => $request->categoria,
                'imagen' => $rutaFoto, // <-- ¡Aquí ya no es NULL! Guarda la ruta real
            ]);

            // 3. Le respondemos al celular con un JSON de éxito
            return response()->json([
                'success' => true,
                'message' => '¡Producto guardado desde el celular con éxito!',
                'data' => $producto
            ], 201);

        } catch (\Exception $e) {
            // Si algo falla, lo guarda en el log y le avisa detalladamente al celular
            Log::error('Error guardando producto desde celular: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}