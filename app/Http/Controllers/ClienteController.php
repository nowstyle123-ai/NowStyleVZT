<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    
    public function index()
    {
        
        $productos = Producto::where('stock', '>', 0)->get();
        
        return view('Usuario.dashboard', compact('productos'));
    }

   
    public function guardarPedido(Request $request)
    {
       
        $items = json_decode($request->detalles, true);

        if (is_array($items)) {
            foreach ($items as $item) {
               
                if (isset($item['id'])) {
                    $producto = Producto::find($item['id']);
                    
                    if ($producto) {
                        
                        $cantidadComprada = isset($item['cantidad']) ? $item['cantidad'] : 1;
                        
                        
                        $nuevoStock = max(0, $producto->stock - $cantidadComprada);
                        $producto->update(['stock' => $nuevoStock]);
                    }
                }
            }
        }

        
        Pedido::create([
            'user_id' => auth()->id(),
            'detalles' => $request->detalles, 
            'total' => $request->total,
        ]);

        return response()->json(['success' => true]);
    }
}