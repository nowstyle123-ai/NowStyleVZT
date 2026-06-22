<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        // Validar que sea gerente O empleado. Si es usuario común, se le deniega el acceso.
        if (auth()->user()->rol !== 'gerente' && auth()->user()->rol !== 'empleado') {
            abort(403, 'Acceso denegado. No tienes permisos para ver los reportes.');
        }

        // Consultas de totales
        $totalIngresos = DB::table('pedidos')->sum('total');
        $totalPedidos = DB::table('pedidos')->count();
        $ticketPromedio = $totalPedidos > 0 ? ($totalIngresos / $totalPedidos) : 0;
        $totalClientes = DB::table('users')->where('rol', 'usuario')->count(); // Cuenta solo clientes reales

        // Consulta de últimas ventas usando JOIN directo
        $ultimasVentas = DB::table('pedidos')
            ->join('users', 'pedidos.user_id', '=', 'users.id')
            ->select('pedidos.*', 'users.name as cliente_nombre') // Guarda el nombre como cliente_nombre
            ->orderBy('pedidos.created_at', 'desc')
            ->take(10)
            ->get();

        return view('reportes', compact('totalIngresos', 'totalPedidos', 'ticketPromedio', 'totalClientes', 'ultimasVentas'));
    }
}