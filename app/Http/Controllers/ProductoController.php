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
        'tallas'        => 'required|array', // Recibe el array de checkboxes de la vista
        'categoria'     => 'required|string',
        'codigo_barras' => 'nullable|string',
    ]);

    $rutaImagen = null;
    if ($request->hasFile('imagen')) {
        $rutaImagen = $request->file('imagen')->store('productos', 'public');
    }

    // 🔥 CORRECCIÓN: Unimos el array de checkboxes ['S', 'M', 'L'] en una cadena con guiones "S-M-L"
    $tallasConGuiones = implode('-', $request->tallas);

    // CREA UN SOLO PRODUCTO CON LAS COLUMNAS REALES DE TU BD
    Producto::create([
        'nombre'        => $request->nombre,
        'descripcion'   => $request->descripcion,
        'precio'        => $request->precio,
        'stock'         => $request->stock,
        'talla'         => $tallasConGuiones, // Usamos 'talla' en singular que es tu columna real
        'categoria'     => $request->categoria,
        'codigo_barras' => $request->codigo_barras,
        'imagen'        => $rutaImagen,
    ]);


    return redirect()->route('productos.index')->with('success', '¡Producto creado exitosamente con todas sus tallas!');
}

  public function show(string $id)
{
    // Buscamos el producto por su ID
    $producto = Producto::findOrFail($id);

    // Como usas cast de array, Laravel convierte automáticamente el JSON de la BD a un array de PHP
    // Si por alguna razón está vacío o es nulo, nos aseguramos de pasar un array vacío.
    $tallasDisponibles = is_array($producto->tallas) ? $producto->tallas : [];

    // Retornamos la vista del detalle del producto pasándole los datos
    return view('productos.show', compact('producto', 'tallasDisponibles'));
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

    // 🔥 CORRECCIÓN PARA EDITAR: Si se cambian las tallas en la edición, también las une con guiones
    if ($request->has('tallas') && is_array($request->tallas)) {
        $datos['talla'] = implode('-', $request->tallas);
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
            $producto->tallas = $tallas; // Asignamos la talla correspondiente
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