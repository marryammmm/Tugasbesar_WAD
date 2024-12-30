<?php

use App\Models\Post;
use App\Models\Forum;
use App\Models\Comment;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return redirect(route('forumdiskusi'));
});

Route::get('/forumdiskusi', function () {
    $nav = 'Forum Diskusi Immuniverse';
    $forums = Forum::latest()->get();
    $stats = [
        'pengguna' => Pengguna::count(),
        'forums' => Forum::count(),
        'posts' => Post::count(),
        'comments' => Comment::count(),
    ];
    return view('forumdiskusi', compact('nav', 'forums','stats'));
})->name('forumdiskusi');

Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
Route::get('/forum/{forum}', [ForumController::class, 'show'])->name('forum.show');
Route::get('forum/{forum}/edit', [ForumController::class, 'edit'])->name('forum.edit');
Route::put('forum/{forum}', [ForumController::class, 'update'])->name('forum.update');
Route::delete('/forum/{forum}', [ForumController::class, 'destroy'])->name('forum.destroy');

Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/post/create/{forumId}', [PostController::class, 'create'])->name('post.create');
Route::post('/post/{forumId}', [PostController::class, 'store'])->name('post.store');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::get('/comment', [CommentController::class, 'index'])->name('comment.index');
Route::get('/comment/create/{postId}', [CommentController::class, 'create'])->name('comment.create');
Route::post('/comment/{postId}', [CommentController::class, 'store'])->name('comment.store');
Route::get('/comment/{comment}', [CommentController::class, 'show'])->name('comment.show');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
