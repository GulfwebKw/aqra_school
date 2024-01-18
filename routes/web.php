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
Route::get('/application/{uuid}/pay', [\App\Http\Controllers\Controller::class,'applicationPay'])->name('application.pay');
Route::get('/application/{uuid}/export/pdf', [\App\Http\Controllers\Controller::class,'applicationExport'])->name('application.export');
Route::get('/test', function () {
    //dispatch(new \App\Jobs\sendRegisterEmailJob(1));
});
