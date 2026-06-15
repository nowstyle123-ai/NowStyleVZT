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
        // Tomamos todos los datos del formulario (nombre, precio, stock, talla, categoria)
        $datos = $request->all();

        // Si el empleado subió una foto, la guardamos de forma segura
        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        // Guardamos todo en la base de datos con tu método rápido
        Producto::create($datos);

        return redirect()->route('productos.index');
    }

    public function show(string $id)
    {
        // No lo necesitas por ahora para la tienda, lo dejamos vacío
    }

    // 1. MOSTRAR LA PANTALLA PARA EDITAR EL PRODUCTO
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    // 2. GUARDAR LOS CAMBIOS MODIFICADOS
    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);
        $datos = $request->all();

        // Si subió una nueva foto, la cambiamos
        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($datos);

        return redirect()->route('productos.index');
    }

    // 3. ELIMINAR EL PRODUCTO SI SE AGOTÓ
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index');
    }

    // ==========================================
    // 📱 NUEVA FUNCIÓN EXCLUSIVA PARA EL CELULAR
    // ==========================================
    public function storeCelular(Request $request)
    {
        // 1. Recolectamos los textos de forma manual y segura
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->stock = $request->input('stock');
        $producto->talla = $request->input('talla');
        $producto->categoria = $request->input('categoria');

        // 2. 📸 Procesamos el archivo real de la foto
        if ($request->hasFile('imagen')) {
            // El método 'store' guarda el archivo en 'storage/app/public/productos'
            // y nos devuelve la ruta exacta (ej: 'productos/abc123xyz.jpg')
            $rutaFoto = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $rutaFoto;
        } else {
            $producto->imagen = null;
        }

        // 3. Guardamos en la base de datos
        $producto->save();

        // 4. Le respondemos un JSON lindo al celular Honor para que no falle
        return response()->json([
            'success' => true,
            'message' => '¡Producto guardado desde el celular!',
            'data' => $producto
        ], 201);
    }
} // <-- Esta es la última llave de cierre de tu controlador
