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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// sample routes
Route::get('/sample', [\App\Http\Controllers\Sample\IndexController::class, 'show']);
Route::get('/sample/{id}', [\App\Http\Controllers\Sample\IndexController::class, 'showId']);

// review routes
Route::get('/review', \App\Http\Controllers\Review\IndexController::class)->name('review.index');
Route::middleware('auth')->group(function () 
{
    Route::get('/review/create', \App\Http\Controllers\Review\CreateController::class)->name('review.create');
    Route::post('/review/create', \App\Http\Controllers\Review\CreateController::class)->name('review.create');
    // update routes
    Route::get('/review/update/{reviewId}', \App\Http\Controllers\Review\Update\IndexController::class)->name('review.update.index');
    Route::put('/review/update/{reviewId}', \App\Http\Controllers\Review\Update\PutController::class)->name('review.update.put');
    // delete routes
    Route::delete('/review/delete/{reviewId}', \App\Http\Controllers\Review\DeleteController::class)->name('review.delete');
});

require __DIR__.'/auth.php';