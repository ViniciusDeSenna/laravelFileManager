<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\FilesController::class, 'viewFiles'])->name('files.view');

Route::post('files/up_files/', [\App\Http\Controllers\FilesController::class, 'upFiles'])->name('files.upload');
