<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'livewire.app')->name('home');
Route::view('cliente', 'livewire.app')->name('cliente');
Route::view('imovel', 'livewire.app')->name('imovel');
