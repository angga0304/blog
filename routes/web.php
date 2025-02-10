<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('homepage');
Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');
Route::get('/post/{slug}', [HomeController::class, 'postdetail'])->name('post.detail');
Route::post('/post/{slug}/post-comment', [CommentController::class, 'store'])->name('post.comment');
Route::get('/post/{comment}/destroy', [CommentController::class, 'destroy'])->name('comment.delete');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::prefix('tag')->middleware(['web', 'auth'])->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('tag.index');
        Route::get('/create', [TagController::class, 'create'])->name('tag.create');
        Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('tag.edit');
        Route::post('/stores', [TagController::class, 'store'])->name('tag.stores');
        Route::get('/{tag}/delete', [TagController::class, 'destroy'])->name('tag.delete');
        Route::post('/{tag}/updates', [TagController::class, 'update'])->name('tag.updates');
    });

    Route::prefix('post')->middleware(['web', 'auth'])->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::post('/stores', [PostController::class, 'store'])->name('post.stores');
        Route::get('/{post}/delete', [PostController::class, 'destroy'])->name('post.delete');
        Route::post('/{post}/updates', [PostController::class, 'update'])->name('post.updates');
    });
});

require __DIR__.'/auth.php';
