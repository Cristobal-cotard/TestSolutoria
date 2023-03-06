<?php

use App\Http\Controllers\UfsController;
use Illuminate\Support\Facades\Route;


Route::get('/',[UfsController::class, 'index'])->name('ufs.index');

Route::post('/store',[UfsController::class, 'store'])->name('ufs.store');
Route::post('/update/{id}',[UfsController::class, 'update'])->name('ufs.update');
Route::get('/destroy/{id}',[UfsController::class, 'destroy'])->name('ufs.destroy');
Route::get('/show/{id}',[UfsController::class, 'show'])->name('ufs.show');
Route::post('/chartData',[UfsController::class, 'chartData'])->name('ufs.chartData');

