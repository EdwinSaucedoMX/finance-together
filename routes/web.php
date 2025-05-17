<?php

use App\Livewire\Movements;
use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;

Route::get('/', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth', 'verified'])
    ->name('profile');

Route::get('movements', Movements::class)
    ->middleware(['auth', 'verified'])
    ->name('movements');

require __DIR__ . '/auth.php';
