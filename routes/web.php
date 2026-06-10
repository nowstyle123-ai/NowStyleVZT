<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\GerenteController; // Asegúrate de tenerlo importado si usas GerenteController

// 🚪 Pantalla de inicio de sesión directo
Route::get('/', function () {
    return view('auth.login');
});

// 🚦 Redirección inteligente según el Rol al iniciar sesión
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


// 🔒 RUTAS PROTEGIDAS POR AUTENTICACIÓN
Route::middleware(['auth'])->group(function () {

    // ⚙️ RUTAS DEL GERENTE
    Route::get('/gerente', [GerenteController::class, 'index'])->name('gerente.index');
    Route::patch('/gerente/usuarios/{id}/rol', [GerenteController::class, 'updateRol'])->name('usuarios.updateRol');

    // 👨‍🏭 RUTAS DEL EMPLEADO (Conectadas a su propio controlador)
    Route::get('/empleado', [EmpleadoController::class, 'index'])->name('empleado.index');
    Route::post('/pedido/{id}/completar', [EmpleadoController::class, 'completarPedido'])->name('pedido.completar');

    // 🛒 RUTAS DEL CLIENTE / USUARIO
    Route::get('/usuario', [ClienteController::class, 'index'])->name('cliente.index');
    Route::post('/guardar-pedido', [ClienteController::class, 'guardarPedido'])->name('pedido.guardar');

    // 👤 PERFIL DE USUARIO
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📦 CONTROLADOR DE PRODUCTOS (CRUD)
    Route::resource('productos', ProductoController::class);
});

require __DIR__.'/auth.php';
