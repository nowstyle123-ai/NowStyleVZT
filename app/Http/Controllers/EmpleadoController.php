<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        // Traemos los pedidos pendientes de estampado
        $pedidos = Pedido::with('user')->whereIn('estado', ['pendiente', 'en proceso'])->orderBy('created_at', 'desc')->get();
        
        //  Traemos todos los productos para que el empleado los gestione
        $productos = Producto::all();

        return view('Empleado.dashboard', compact('pedidos', 'productos'));
    }

  public function completarPedido($id)
{
    $pedido = Pedido::findOrFail($id);
    
    // CAMBIADO / VERIFICADO: El estado debe coincidir con la lógica del Blade 
    $pedido->estado = 'completado'; 
    $pedido->save();

    return redirect()->back()->with('success', '¡Pedido marcado como Listo!');
}
}