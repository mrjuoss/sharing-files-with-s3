<?php

use App\Http\Controllers\Invoices\InvoiceController;
use App\Http\Controllers\WSF\FileController;
use Illuminate\Support\Facades\Route;

Route::prefix('file-sharing')->group(function()
{
    Route::get('/', [App\Http\Controllers\WSF\HomeController::class, 'index'])->name('file.sharing.home');
    Route::post('/upload', [FileController::class, 'upload'])->name('file.sharing.upload');
    Route::get('/files/{file}', [FileController::class, 'files'])->name('file.sharing.files');
    Route::get('/download/{file}', [FileController::class, 'downloadFile'])->name('file.sharing.download');
    Route::delete('/delete/{file}', [FileController::class, 'deleteFile'])->name('file.sharing.delete');
});

Route::get('/', function(){
   return view('welcome');
});

//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth'])->prefix('invoices')->group(function()
{
    // Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/store', [InvoiceController::class, 'store'])->name('invoices.store');
});
