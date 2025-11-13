<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerTTHController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// CRUD 
// >> Data Customer (/customer)
Route::prefix('/customer')->group( function(){
    Route::get('/getAll', [CustomerController::class, 'index']);
    Route::post('/add', [CustomerController::class, 'store']);
    Route::post('delete', [CustomerController::class, 'delete']);
});

// >> Data Customer TTH (/customertth)
Route::prefix('/customerTTH')->group(function(){
    Route::get('/getAll', [CustomerTTHController::class, 'index']);
    Route::post('/add', [CustomerTTHController::class, 'store']);
    Route::post('delete', [CustomerTTHController::class, 'delete']);
});

// >> Data Customer TTH Detail 
Route::prefix('/tthDetail')->group(function(){
    // 
});
