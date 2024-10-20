<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommendeController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/commandes', [CommendeController::class, 'index']);
Route::get('/commandes/{id}', [CommendeController::class, 'show']);
Route::delete('/commandes/{id}', [CommendeController::class, 'destroy']);
Route::put('/commandes/{id}', [CommendeController::class, 'update']);
