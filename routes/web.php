<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('web'));
Route::get('/login', fn() => redirect(route('filament.web.auth.login')))->name('login');
Route::get('/logout', fn() => redirect('web'));
Route::get('/web/logout', fn() => redirect('web'));
