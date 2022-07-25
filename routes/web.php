<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\SessionController;


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

Route::get('/', [TodoController::class, 'index'])->middleware(['auth']);
Route::post('/add', [TodoController::class, 'create'])->middleware(['auth']);
;
Route::post('/edit', [TodoController::class, 'update'])->middleware(['auth']);
;
Route::post('/delete', [TodoController::class, 'remove'])->middleware(['auth']);
;
Route::get('/todo/find', [TodoController::class, 'find'])->middleware(['auth']);
;
Route::get('/todo/search', [TodoController::class, 'search'])->middleware(['auth']);
;

require __DIR__.'/auth.php';
