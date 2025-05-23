<?php

use App\Livewire\Admin;
use App\Livewire\Groups;
use App\Livewire\JoinGroup;
use App\Livewire\Movements;
use App\Livewire\SpecificGroup;
use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;

Route::get('/', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth', 'verified'])
    ->name('profile');

Route::get('movements', Movements::class)
    ->middleware(['auth', 'verified'])
    ->name('movements');


Route::get('groups/{id}', SpecificGroup::class)
    ->middleware(['auth', 'verified'])
    ->name('specific-group');

Route::get('groups', Groups::class)
    ->middleware(['auth', 'verified'])
    ->name('groups');


Route::get('join', JoinGroup::class)->middleware(['canJoinGroup'])->name('join');


Route::get('login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');
require __DIR__ . '/auth.php';


Route::get('admin', Admin::class)
    ->middleware(['auth', 'verified'])
    ->name('admin');


