<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('file-sharing')->group(function()
{
    Route::get('/', [HomeController::class, 'index'])->name('file.sharing.home');
    Route::post('/upload', [FileController::class, 'upload'])->name('file.sharing.upload');
    Route::get('/files/{file}', [FileController::class, 'files'])->name('file.sharing.files');
    Route::get('/download/{file}', [FileController::class, 'downloadFile'])->name('file.sharing.download');
    Route::delete('/delete/{file}', [FileController::class, 'deleteFile'])->name('file.sharing.delete');
});

Route::get('/', function(){
   return view('welcome');
});
