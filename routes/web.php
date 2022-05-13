<?php

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

Route::get('/{n?}{r?}{np?}', [\App\Http\Controllers\AkinatorController::class,'index']);
Route::get('/akinator/respuesta', [\App\Http\Controllers\AkinatorController::class,'respuesta']);
Route::post('/akinator/crear', [\App\Http\Controllers\AkinatorController::class,'crear']);
