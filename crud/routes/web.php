<?php

use App\Models\Crud;
use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('index',[MyController::class,'index'])->name('index');
Route::get('addUser',[MyController::class,'create'])->name('insert');
Route::post('auser',[MyController::class,'store'])->name('store');
Route::get('view',[MyController::class,'view'])->name('view');
Route::get('/cruds/{crud}/edit',[MyController::class,'edit'])->name('crud.edit');
Route::put('/cruds/{crud}/{$id}', [MyController::class,'update'])->name('crud.update');