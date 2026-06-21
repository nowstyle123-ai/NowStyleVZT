<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    
    public function index()
    {
        $productos = Producto::all();
        return view('Usuario.dashboard', compact('productos'));
    }

    // Guarda el pedido que viene desde el carrito de la tienda
    public function guardarPedido(Request $request)
    {
        Pedido::create([
            'user_id' => auth()->id(),
            'detalles' => $request->detalles, 
            'total' => $request->total,
        ]);

        return response()->json(['success' => true]);
    }
}