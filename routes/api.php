<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productoController;
use App\Http\Controllers\usuarioController;

//RUTAS CRUD PARA PRODUCTO

Route::get('/producto', [productoController::class,'index']);

Route::get('/producto/{id}', [productoController::class,'show']);

Route::post('/producto', [productoController::class,'store']);

Route::put('/producto/{id}',[productoController::class,'update']);

Route::patch('/producto/{id}',[productoController::class,'updatePartial']);

Route::delete('/producto/{id}', [productoController::class,'destroy']);

//RUTAS CRUD PARA USUARIO

Route::get('/usuario', [usuarioController::class,'indexU']);

Route::get('/usuario/{id}', [usuarioController::class,'showU']);

Route::post('/usuario', [usuarioController::class,'storeU']);

Route::put('/usuario/{id}',[usuarioController::class,'updateU']);

Route::patch('/usuario/{id}',[usuarioController::class,'updatePartialU']);

Route::delete('/usuario/{id}', [usuarioController::class,'destroyU']);


