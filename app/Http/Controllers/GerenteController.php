<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use App\Models\Pedido; 
use Illuminate\Http\Request;

class GerenteController extends Controller
{
    public function index()
    {
        // 1. Datos para las tarjetas (LÓGICA NUEVA)
        // Sumamos el total solo de los pedidos marcados como 'completado'
        $totalVentas = Pedido::where('estado', 'completado')->sum('total');
        
        // Contamos el total de pedidos en el sistema
        $totalPedidos = Pedido::count();

        // 2. Datos existentes
        $productos = Producto::all();
        $usuarios = User::all();
        $pedidos = Pedido::with('user')->get(); // Traemos todos para la lista
        $productosBajoStock = Producto::where('stock', '<=', 10)->count();

        // 3. Datos para la gráfica de categorías (por si la usas)
        $cantidadesCategorias = Producto::select('categoria', \DB::raw('count(*) as total'))
            ->groupBy('categoria')
            ->pluck('total', 'categoria')
            ->toArray();

        // 4. Enviamos TODO a la vista
        return view('Gerente.dashboard', compact(
            'productos', 
            'usuarios', 
            'pedidos', 
            'productosBajoStock', 
            'totalVentas', 
            'totalPedidos',
            'cantidadesCategorias'
        ));
    }

    public function updateRol(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->rol = $request->rol;
        $usuario->save();
        return redirect()->back()->with('success', 'Rol actualizado correctamente.');
    }
}