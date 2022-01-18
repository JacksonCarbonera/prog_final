<?php

use App\Http\Controllers\FotoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', [FotoController::class, 'index'])->name('home');

Route::prefix('/galeria')->group(function(){
    Route::view('/upload', 'midia.create')->name('upload');
    Route::post('/upload', [ FotoController::class, 'create' ]);
    
    
    Route::get('/foto/{id}', [ FotoController::class, 'get' ])->name('midia');
    
    Route::get('/{id}', [FotoController::class, 'item' ])->name('item');
});

