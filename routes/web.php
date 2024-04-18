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

Route::get('/', function () {
    return view('login');
});

// Util
Route::get('files/{file_id}/{view_mode}/', [\App\Http\Controllers\UtilController::class, 'view'])->name('folder.view');

// Folders
Route::post('folder/create/', [\App\Http\Controllers\FilesController::class, 'newFolder'])->name('folder.create');

// Files
Route::post('files/upload/', [\App\Http\Controllers\FilesController::class, 'newFile'])->name('files.upload');
Route::post('files/favorite', [\App\Http\Controllers\FilesController::class, 'favoriteFile'])->name('files.favorite');
Route::get('files/download', [\App\Http\Controllers\FilesController::class, 'downloadFile'])->name('files.download');
