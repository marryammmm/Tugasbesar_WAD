<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;

// Halaman utama
Route::get('/', function () {
    return view('welcome'); // Sesuaikan dengan tampilan utama yang Anda inginkan
});

// Explicitly defined routes for Articles
// Create
Route::get('admin/articles/create', [ArticlesController::class, 'create'])->name('articles.create');

// Store (for storing data after creation)
Route::post('admin/articles', [ArticlesController::class, 'store'])->name('articles.store');

// Edit
Route::get('admin/articles/{article}/edit', [ArticlesController::class, 'edit'])->name('articles.edit');

// Update (for updating data after edit)
Route::put('admin/articles/{article}', [ArticlesController::class, 'update'])->name('articles.update');

// Destroy (for deleting an article)
Route::delete('admin/articles/{article}', [ArticlesController::class, 'destroy'])->name('articles.destroy');

// Index (to view all articles)
Route::get('admin/articles', [ArticlesController::class, 'index'])->name('articles.index');

// Show (to view a single article)
Route::get('articles/{article}', [ArticlesController::class, 'show_user'])->name('user.articles.show');

Route::get('articles', [ArticlesController::class, 'index_user'])->name('user.articles.index');
