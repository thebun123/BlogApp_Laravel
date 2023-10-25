<?php

use App\Http\Controllers\BlogController;
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

// Blog
Route::get('/', function(){
    return view('welcome');
});
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{blog}', [BlogController::class, 'show']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // restrict actions on the blog
    Route::get('/blog/{blog}/edit', [BlogController::class, 'edit']);
    Route::post('/blog/{blog}/edit', [BlogController::class, 'update']);
    Route::get('/blog/{blog}/delete', [BlogController::class, 'destroy']);
    Route::get('/blog/create/new', [BlogController::class, 'create']);
    Route::post('/blog/create/new', [BlogController::class, 'store']);
});

require __DIR__.'/auth.php';
