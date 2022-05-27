<?php

use App\Http\Controllers\AkinatorController;
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
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/sobre-nosotros', function () {
    return view('about');
})->name('about');
Route::get('/informacion', function () {
    return view('info');
})->name('info');
Route::get('/iarop/respuesta', [AkinatorController::class,'respuesta'])->name('respuesta');
Route::get('/iarop/ver', [AkinatorController::class,'ver'])->name('ver');
Route::post('/iarop/crear', [AkinatorController::class,'crear'])->name('crear');
Route::get('/iarop/{n?}{r?}{np?}', [AkinatorController::class,'index'])->name('index');
