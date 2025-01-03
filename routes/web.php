<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('whiteboards')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Whiteboards/Index');
    })->name('whiteboards.index');

    Route::get('/create', function () {
        return Inertia::render('Whiteboards/Create');
    })->name('whiteboards.create');

    Route::get('/{whiteboard}', function () {
        return Inertia::render('Whiteboards/Show');
    })->name('whiteboards.show');

    Route::get('/{whiteboard}/edit', function (Request $request) {
        return Inertia::render('Whiteboards/Edit',['whiteboard' => $request->whiteboard]);
    })->name('whiteboards.edit');
});

require __DIR__.'/auth.php';
