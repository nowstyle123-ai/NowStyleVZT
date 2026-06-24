<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre'        => 'required|string|max:255',
        'descripcion'   => 'nullable|string',
        'precio'        => 'required|numeric|min:0',
        'stock'         => 'required|integer|min:0',
        'tallas'        => 'required|array', 
        'categoria'     => 'required|string',
        'codigo_barras' => 'nullable|string',
    ]);

    $rutaImagen = null;
    if ($request->hasFile('imagen')) {
        $rutaImagen = $request->file('imagen')->store('productos', 'public');
    }

    // CREA UN SOLO PRODUCTO
    Producto::create([
        'nombre'        => $request->nombre,
        'descripcion'   => $request->descripcion,
        'precio'        => $request->precio,
        'stock'         => $request->stock,
        'tallas'        => $request->tallas, 
        'categoria'     => $request->categoria,
        'codigo_barras' => $request->codigo_barras,
        'imagen'        => $rutaImagen,
    ]);

    return redirect()->route('productos.index')->with('success', '¡Producto creado exitosamente con todas sus tallas!');
}

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);
        $datos = $request->all();

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($datos);

        return redirect()->route('productos.index');
    }

    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index');
    }

    public function buscarPorCodigo($codigo)
    {
        $producto = Producto::where('codigo_barras', $codigo)->first();

        if ($producto) {
            return response()->json([
                'success' => true,
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }

    // ==========================================
    // 📱 NUEVA FUNCIÓN EXCLUSIVA PARA EL CELULAR
    // ==========================================
    public function storeCelular(Request $request)
    {
        // Subir la foto una sola vez
        $rutaFoto = null;
        if ($request->hasFile('imagen')) {
            $rutaFoto = $request->file('imagen')->store('productos', 'public');
        }

        // CORRECCIÓN: Soportar tanto si el celular manda una sola talla string como si manda un array de tallas
        $tallas = $request->input('tallas');
        
        if (!is_array($tallas)) {
            // Si mandó solo un string (ej: "M"), lo convertimos en array para que el flujo sea idéntico
            $tallas = [$request->input('talla', 'M')];
        }

        $productosCreados = [];

        foreach ($tallas as $talla) {
            $producto = new Producto();
            $producto->nombre = $request->input('nombre');
            $producto->descripcion = $request->input('descripcion');
            $producto->precio = $request->input('precio');
            $producto->stock = $request->input('stock');
            $producto->tallas = $tallas; 
            $producto->categoria = $request->input('categoria');
            $producto->codigo_barras = $request->input('codigo_barras');
            $producto->imagen = $rutaFoto;
            $producto->save();

            $productosCreados[] = $producto;
        }

        return response()->json([
            'success' => true,
            'message' => '¡Productos guardados correctamente desde el celular!',
            'data' => $productosCreados
        ], 201);
    }
}