<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use domain\Facades\UserFacade;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });



Route::get('/', function () {
    return Inertia::render('Dashboard/index');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, "index"])->name('home');
    Route::get('/list', [HomeController::class, "list"])->name('list');
    Route::get('delete/{id}', [HomeController::class, "delete"])->name('student.delete');
    Route::get('status/{id}', [HomeController::class, "status"])->name('student.status');
    Route::post('/add', [HomeController::class, "add"])->name('student.add');
    Route::post('/update', [HomeController::class, "update"])->name('student.update');
});

require __DIR__.'/auth.php';
