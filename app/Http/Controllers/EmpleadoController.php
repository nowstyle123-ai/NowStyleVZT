<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    public function index()
    {
       // Las consultas que ya tenías para tus pedidos y productos
    $pedidos = \App\Models\Pedido::where('estado', 'pendiente')->get(); // O como lo tengas
    $productos = \App\Models\Producto::all();

    // 🚀 NUEVA CONSULTA: Traer las últimas 10 ventas uniendo la tabla pedidos con users
    $ultimasVentas = DB::table('pedidos')
        ->join('users', 'pedidos.user_id', '=', 'users.id')
        ->select('pedidos.*', 'users.name as cliente_nombre')
        ->orderBy('pedidos.created_at', 'desc')
        ->take(10)
        ->get();

    // Importante: Agrega 'ultimasVentas' dentro del compact()
    return view('Empleado.dashboard', compact('pedidos', 'productos', 'ultimasVentas'));
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