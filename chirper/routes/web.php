<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactionController;
use Illuminate\Support\Facades\Route;

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

Route::resource('chirps',ChirpController::class)
->only(['index', 'store', 'edit', 'update','destroy'])
->middleware(['auth','verified']);

Route::get('/wall', [ChirpController::class, 'index'])->name('chirps.index');
Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.store');
Route::post('/chirps/{chirp}/reactions', [ReactionController::class, 'store'])->name('reactions.store');
require __DIR__.'/auth.php';
