<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::public.home')->name('home.page');
Route::livewire('/about', 'pages::public.about')->name('about.page');
Route::livewire('/contact', 'pages::public.contact')->name('contact.page');
Route::name('login')->get('/login', function () {
    return redirect('/auth/login');
});

Route::middleware(['auth', 'role:driver'])
->group(function () {
    Route::livewire('/driver', 'pages::driver.index')->name('driver.page');
    Route::livewire('/dirver/settings', 'pages::driver.settings')->name('settings.page');
    Route::livewire('/dirver/profile', 'pages::driver.profile')->name('profile.page');
});
