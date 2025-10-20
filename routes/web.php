<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Livewire\Admin\Users\Create as CreateUser;
use App\Livewire\KaryawanEdit;
use App\Livewire\MyProfile;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/karyawan/{karyawan}/edit', KaryawanEdit::class)->name('karyawan.edit');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
    Route::get('/karyawan/tambah', function () {
        return view('karyawan.create'); // <-- Menunjuk ke file baru yang akan kita buat
    })->name('karyawan.create');

    Route::get('/karyawan', function () {
        return view('karyawan.index');
    })->name('karyawan.index');

    Route::get('/profil-saya', MyProfile::class)->name('my-profile');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
