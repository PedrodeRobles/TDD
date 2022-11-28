<?php

use App\Http\Controllers\PageController;
use App\Models\Repository;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('repositories', App\Http\Controllers\RepositoryController::class)
    ->middleware('auth');
