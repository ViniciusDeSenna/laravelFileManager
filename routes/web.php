<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('files/upFiles/', [\App\Http\Controllers\FilesController::class, 'upFiles'])->name('files.upFiles');
