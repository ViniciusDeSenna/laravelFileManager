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

// Folders
Route::post('folder/create/', [\App\Http\Controllers\FilesController::class, 'newFolder'])->name('folder.create');

// Files
Route::get('files/{file_id}/{view_mode}/', [\App\Http\Controllers\FilesController::class, 'viewFiles'])->name('folder.view');
Route::post('files/upload/', [\App\Http\Controllers\FilesController::class, 'upFiles'])->name('files.upload');
Route::post('files/favorite', [\App\Http\Controllers\FilesController::class, 'favoriteFile'])->name('files.favorite');
