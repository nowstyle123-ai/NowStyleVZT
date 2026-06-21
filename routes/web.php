<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\PedidoController;


Route::get('/buscar-producto/{codigo}', [App\Http\Controllers\ProductoController::class, 'buscarPorCodigo']);
Route::post('/pedidos', [PedidoController::class, 'guardar'])
    ->name('pedido.guardar');

Route::get('/mis-pedidos', [PedidoController::class, 'misPedidos'])
    ->name('pedido.index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $rol = Auth::user()->rol;

    if ($rol === 'gerente') {
        return redirect('/gerente');
    }

    if ($rol === 'empleado') {
        return redirect('/empleado');
    }

    return redirect('/usuario');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // RUTAS DEL GERENTE
    Route::get('/gerente', [GerenteController::class, 'index'])->name('gerente.index');
    Route::patch('/gerente/usuarios/{id}/rol', [GerenteController::class, 'updateRol'])->name('usuarios.updateRol');

    // RUTAS DEL EMPLEADO
    Route::get('/empleado', [EmpleadoController::class, 'index'])->name('empleado.index');
    Route::post('/pedido/{id}/completar', [EmpleadoController::class, 'completarPedido'])->name('pedido.completar');

    // RUTAS DEL CLIENTE / USUARIO
    Route::get('/usuario', [ClienteController::class, 'index'])->name('cliente.index');

    // PERFIL DE USUARIO
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PRODUCTOS (CRUD)
    Route::resource('productos', ProductoController::class);

});

require __DIR__.'/auth.php';