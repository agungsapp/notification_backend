<?php

use App\Livewire\Auth\LoginPage;
use App\Livewire\DashboardPage;
use App\Livewire\ManageMemoPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', LoginPage::class)->name('login')->middleware('guest');

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardPage::class)->name('dashboard');
    Route::get('manage-memo', ManageMemoPage::class)->name('manage-memo');
});
