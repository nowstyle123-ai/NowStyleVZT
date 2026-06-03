<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
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

Route::get('/gerente', function () {
    return view('gerente.dashboard');
})->middleware('auth');

Route::get('/empleado', function () {
    return view('empleado.dashboard');
})->middleware('auth');

Route::get('/usuario', function () {
    return view('usuario.dashboard');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
