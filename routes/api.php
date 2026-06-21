<?php

use App\Http\Controllers\Api\ProductoApiController;

Route::post('/productos/celular', [ProductoApiController::class, 'store']);