<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ProyectoMaterialController;
use App\Http\Controllers\ParametroDetalleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/materials',MaterialController::class);
Route::apiResource('/proyects',ProyectoController::class);
Route::apiResource('/proyects-materials',ProyectoMaterialController::class);

Route::get('/parametro-detalle/{id}', [ParametroDetalleController::class, 'getByParametro']);
