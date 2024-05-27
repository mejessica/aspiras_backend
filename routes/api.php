<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\FeriadoController;
use App\Http\Controllers\HoraController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/users', [UserController::class, 'store']);
Route::get('/user-profile', [UserController::class, 'urlPrefix']);
Route::patch('/users/{id}', [UserController::class, 'update']);
Route::get('/users/{id}', [UserController::class, 'findUser']);

Route::post('/auth', [AuthController::class, 'login']);

Route::get('/todos', [TodoController::class, 'findAll']);
Route::get('/todos/{id}', [TodoController::class, 'findItem']);
Route::post('/todos', [TodoController::class, 'store']);
Route::delete('/todos/{id}', [TodoController::class, 'destroy']);

Route::get('/items', [ItemController::class, 'findAll']);
Route::post('/items', [ItemController::class, 'store']);

Route::patch('/items/{id}', [ItemController::class, 'update']);
Route::get('/items/{id}',[ItemController::class, 'findItem']);
Route::delete('/items/{id}', [ItemController::class, 'destroy']);

Route::post('/configurations', [ConfigurationController::class, 'store']);
Route::get('/configurations', [ConfigurationController::class, 'findAll']);
Route::patch('/configurations/{id}', [ConfigurationController::class, 'update']);
Route::get('/configurations/{id}', [ConfigurationController::class, 'findConfig']);

Route::post('/feriados', [FeriadoController::class, 'store']);
Route::get('/feriados', [FeriadoController::class, 'findAll']);
Route::patch('/feriados/{id}', [FeriadoController::class, 'update']);
Route::get('/feriados/{id}', [FeriadoController::class, 'findItem']);
Route::delete('/feriados/{id}', [FeriadoController::class, 'destroy']);

Route::post('/horas', [HoraController::class, 'store']);
Route::get('/horas', [HoraController::class, 'findAll']);
Route::patch('/horas/{id}', [HoraController::class, 'update']);








