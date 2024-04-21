<?php

use App\Http\Controllers\ProfileController;
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
    return redirect()->route('folder.view', ['file_id' => '1', 'view_mode' => 'card']);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Util
    Route::get('files/{file_id}/{view_mode}', [\App\Http\Controllers\UtilController::class, 'view'])->name('folder.view');
    Route::post('files/templink', [\App\Http\Controllers\UtilController::class, 'returnTempLink'])->name('files.templink');
    Route::get('user/logout', [\App\Http\Controllers\UtilController::class, 'userLogout'])->name('user.logout');

    // Folders
    Route::post('folder/create', [\App\Http\Controllers\FoldersController::class, 'newFolder'])->name('folder.create');

    // Files
    Route::post('files/upload', [\App\Http\Controllers\FilesController::class, 'newFile'])->name('files.upload');
    Route::post('files/favorite', [\App\Http\Controllers\FilesController::class, 'favoriteFile'])->name('files.favorite');
    Route::get('files/download', [\App\Http\Controllers\FilesController::class, 'downloadFile'])->name('files.download');
    Route::get('files/delete', [\App\Http\Controllers\FilesController::class, 'deleteFile'])->name('files.delete');
    Route::post('files/rename', [\App\Http\Controllers\FilesController::class, 'renameFile'])->name('files.rename');

    // Landing-Page
    Route::get('storage17/landingpage', [\App\Http\Controllers\LandingPageController::class, 'index'])->name('files.index');
    Route::get('storage17/register', [\App\Http\Controllers\LandingPageController::class, 'register'])->name('files.register');
});

require __DIR__.'/auth.php';
