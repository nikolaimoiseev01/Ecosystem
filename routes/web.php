<?php

use App\Livewire\Pages\Account\LessonsPage;
use App\Livewire\Pages\Account\SettingsPage as SettingsPageAlias;
use App\Livewire\Pages\Portal\IndexPage as IndexPageAlias;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', IndexPageAlias::class);

// ---------  ЛИЧНЫЙ КАБИНЕТ --------- //

Route::middleware(['auth'])->prefix('account')->group(callback: function () {
    Route::get('lessons', LessonsPage::class)->name('account.courses');
    Route::get('settings', SettingsPageAlias::class)->name('account.settings');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
