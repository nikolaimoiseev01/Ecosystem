<?php

use App\Livewire\Pages\Account\LessonPage;
use App\Livewire\Pages\Account\LessonsPage;
use App\Livewire\Pages\Account\SettingsPage as SettingsPageAlias;
use App\Livewire\Pages\Auth\RegisterPage as RegisterPageAlias;
use App\Livewire\Pages\Portal\IndexPage as IndexPageAlias;
use App\Livewire\Pages\Portal\MasterskayaPage;
use App\Livewire\Pages\Portal\MediaClubPage;
use App\Livewire\Pages\Preview\TestPreviewPage as TestPreviewPageAlias;
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
Route::get('/media-club', MediaClubPage::class);
Route::get('/masterskaya', MasterskayaPage::class)->name('portal.masterskaya');

require __DIR__.'/auth.php';

Route::get('/register', RegisterPageAlias::class)->name('register');
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/preview-test/{token}', TestPreviewPageAlias::class)->name('preview-test');

// ---------  ЛИЧНЫЙ КАБИНЕТ --------- //

Route::middleware(['auth'])->prefix('account')->group(callback: function () {
    Route::get('lessons', LessonsPage::class)->name('account.courses');
    Route::get('lessons/{id}', LessonPage::class)->name('account.course');
    Route::get('settings', SettingsPageAlias::class)->name('account.settings');
});

//Route::get('/diploma/{name}', \App\Livewire\Components\Diploma::class)->name('diploma');

Route::get('/diploma/{user_id}', [\App\Http\Controllers\Controller::class, 'downloadDiploma'])->name('diploma');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
