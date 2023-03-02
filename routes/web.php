<?php

use App\Http\Controllers\UfsController;
use Illuminate\Support\Facades\Route;


Route::get('/',[UfsController::class, 'index'])->name('ufs.index');

Route::post('/store',[UfsController::class, 'store'])->name('ufs.store');
Route::post('/edit/{id}',[UfsController::class, 'edit'])->name('ufs.edit');

