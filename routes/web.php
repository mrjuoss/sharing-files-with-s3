<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/upload', [FileController::class, 'upload'])->name('upload');
Route::get('/files/{file}', [FileController::class, 'files'])->name('files');
Route::get('/downloads/{file}', [FileController::class, 'downloadFile'])->name('file.download');
Route::delete('/delete/{file}', [FileController::class, 'deleteFile'])->name('file.delete');
