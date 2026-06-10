<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class GerenteController extends Controller
{
    public function index()
    {

        $productos = Producto::all();
        $usuarios = User::all();


        return view('gerente.dashboard', compact('productos', 'usuarios'));
    }

public function updateRol(Request $request, string $id)
{
    // 1. Buscamos al usuario por su ID
    $usuario = \App\Models\User::findOrFail($id);
    
    // 2. Le asignamos el rol que viene del formulario
    $usuario->rol = $request->rol; 
    
    // 3. Guardamos los cambios en la base de datos
    $usuario->save();

    // 4. Recargamos la página para ver el cambio
    return redirect()->back();
}
}