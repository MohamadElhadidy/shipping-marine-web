<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::post('/loginApi', [LoginController::class, 'loginApi'])->name('loginApi');
