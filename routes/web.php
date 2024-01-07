<?php

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

Route::get('/', \App\Livewire\RegisterForm::class);
Route::get('/callback', [\App\Http\Controllers\Controller::class,'callback'])->name('callback');
Route::get('/application/{uuid}', [\App\Http\Controllers\Controller::class,'application'])->name('application.show');
