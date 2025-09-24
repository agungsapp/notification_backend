<?php

use App\Livewire\Auth\LoginPage;
use App\Livewire\DashboardPage;
use App\Livewire\DataPengguna;
use App\Livewire\EvaluationFormPage;
use App\Livewire\EvaluationQuestionPage;
use App\Livewire\ManageMemoPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->to('/dashboard');
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
    Route::get('data-pengguna', DataPengguna::class)->name('data-pengguna');
    Route::get('evaluation-question', EvaluationQuestionPage::class)->name('evaluation-question');
    Route::get('evaluation-form', EvaluationFormPage::class)->name('evaluation-form');
    Route::get('manage-memo', ManageMemoPage::class)->name('manage-memo');
});
