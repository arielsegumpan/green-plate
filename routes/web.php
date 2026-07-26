<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::public.home')->name('home.page');
Route::livewire('/about', 'pages::public.about')->name('about.page');
Route::livewire('/contact', 'pages::public.contact')->name('contact.page');
