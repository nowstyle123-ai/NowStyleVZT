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
    // 1. En lugar de $request->all(), validamos y filtramos los datos obligatorios
    $datos = $request->validate([
        'nombre'        => 'required|string|max:255',
        'descripcion'   => 'nullable|string',
        'precio'        => 'required|numeric|min:0',
        'stock'         => 'required|integer|min:0',
        'talla'         => 'nullable|string',
        'categoria'     => 'required|string',
        'codigo_barras' => 'nullable|string',
    ]);

    // 2. Procesamos la imagen si el usuario la subió
    if ($request->hasFile('imagen')) {
        $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
    }

    // 3. Guardamos en la base de datos de manera segura
    Producto::create($datos);

    return redirect()->route('productos.index');
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

    
    return response()->json(['success' => false]);
}
}