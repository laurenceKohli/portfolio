<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canRegister' => Features::enabled(Features::registration()),
//     ]);
// })->name('home');
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('dashboard', [ProjectController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::resource('/projects', ProjectController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
});

Route::resource("/projects",ProjectController::class)->only(['index', 'show']);

require __DIR__.'/settings.php';

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

// Maintenance

Route::get('/maintenance', function () {
    return Inertia::render('Maintenance');
});