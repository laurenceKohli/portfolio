<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
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
    Route::get('/dashboard/skills/{tech}/edit', [SkillController::class, 'edit'])->name('skills.edit');
    Route::put('/dashboard/skills/{tech}', [SkillController::class, 'update'])->name('skills.update');
});

Route::resource("/projects",ProjectController::class)->only(['index', 'show']);
Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');

require __DIR__.'/settings.php';

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

// Maintenance

Route::get('/maintenance', function () {
    return Inertia::render('Maintenance');
});