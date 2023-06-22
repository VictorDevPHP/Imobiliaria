<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\masterController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\cadastroUsuarioController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\logoutController;

Route::get('/', [masterController::class, 'index']);

Route::get('/login', [loginController::class, 'index']);
Route::post('/login', [loginController::class, 'auth']);

Route::get('/cadastro', [cadastroUsuarioController::class, 'index']);
Route::post('/cadastro', [cadastroUsuarioController::class, 'store']);

Route::get('/admin', [adminController::class, 'index']);
Route::post('/admin', [adminController::class, 'search']);
Route::get('/admin/cadastrar', [adminController::class, 'item']);
Route::post('/admin/cadastrar', [adminController::class, 'store']);

Route::post('/logout', [logoutController::class, 'index']);
