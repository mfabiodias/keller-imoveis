<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Cliente\{
    ListCliente,
    CreateCliente
};

Route::get('/cliente', ListCliente::class)->name("cliente");
Route::get('/cliente-novo', CreateCliente::class);

Route::get('/', function () {
    return view('welcome');
});
