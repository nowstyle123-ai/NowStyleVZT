<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    
    public function index()
    {
        // PASO 1.1: Traer solo productos con existencias reales (mayor a cero)
        $productos = Producto::where('stock', '>', 0)->get();
        
        return view('Usuario.dashboard', compact('productos'));
    }

    // Guarda el pedido que viene desde el carrito de la tienda y descuenta stock
    public function guardarPedido(Request $request)
    {
        // PASO 1.2: Procesar los detalles para descontar las cantidades del inventario
        // Asumiendo que desde el JavaScript de tu carrito envías los detalles como un JSON array
        $items = json_decode($request->detalles, true);

        if (is_array($items)) {
            foreach ($items as $item) {
                // Buscamos el producto por su ID o por su Nombre/Talla/Código de barras según lo tengas estructurado
                // Si en el carrito guardas el ID del producto base:
                if (isset($item['id'])) {
                    $producto = Producto::find($item['id']);
                    
                    if ($producto) {
                        // Restamos la cantidad comprada (por defecto 1 si no viene definida)
                        $cantidadComprada = isset($item['cantidad']) ? $item['cantidad'] : 1;
                        
                        // Evitamos que el stock quede en negativo por si acaso
                        $nuevoStock = max(0, $producto->stock - $cantidadComprada);
                        $producto->update(['stock' => $nuevoStock]);
                    }
                }
            }
        }

        // PASO 1.3: Creamos el registro del pedido de forma normal
        Pedido::create([
            'user_id' => auth()->id(),
            'detalles' => $request->detalles, 
            'total' => $request->total,
        ]);

        return response()->json(['success' => true]);
    }
}