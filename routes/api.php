<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/produto', [ProdutoController::class, 'store']); //Cria o produto ou cadastrar

Route::get('/produto', [ProdutoController::class, 'index']); //Mostra todos os produtos cadastrados ou listar
Route::get('/produto/{id}', [ProdutoController::class, 'show']); //Lista por id

Route::put('/produto/{id}', [ProdutoController::class, 'update']); // atualiza

Route::delete('/produto/{id}', [ProdutoController::class, 'delete']); // Deleta tal produto

Route::post('/cliente', [ClienteController::class, 'store']);

Route::get('/cliente', [ClienteController::class, 'index']); 
Route::get('/cliente/{id}', [ClienteController::class, 'show']);

Route::put('/cliente/{id}', [ClienteController::class, 'update']);

Route::delete('/cliente/{id}', [ClienteController::class, 'delete']);