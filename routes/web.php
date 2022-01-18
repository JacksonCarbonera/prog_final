<?php

use App\Http\Controllers\ProdutosController;
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




Route::get('/', [ProdutosController::class, 'index'])->name('home');

Route::prefix('/produtos')->group(function(){
    Route::view('/upload', 'produtos.create')->name('upload');
    Route::post('/upload', [ ProdutosController::class, 'create' ]);
    
    
    Route::get('/foto/{id}', [ ProdutosController::class, 'getProductPhoto' ])->name('midia');
    
    Route::get('/{id}', [ProdutosController::class, 'item' ])->name('item');
});

