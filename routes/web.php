<?php

use Illuminate\Support\Facades\Route; 

Route::view('/', 'livewire.app')->name('permuta');
Route::view('cliente', 'livewire.app')->name('cliente');
Route::view('imovel', 'livewire.app')->name('imovel');
