<?php

use App\Livewire\DashboardPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', DashboardPage::class);
