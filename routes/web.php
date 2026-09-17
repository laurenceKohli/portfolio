<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canRegister' => Features::enabled(Features::registration()),
//     ]);
// })->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/', function () {
    return Inertia::render('Home');
});

Route::resource("/projects",ProjectController::class)->only(['index', 'show']);

require __DIR__.'/settings.php';

// Maintenance

Route::get('/maintenance', function () {
    return Inertia::render('Maintenance');
});