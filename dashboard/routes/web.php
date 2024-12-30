<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::get('/dashboard', function () {
    $nav = 'Forum Diskusi Immuniverse';
    return view('dashboard', compact('nav'));
})->name('dashboard');
