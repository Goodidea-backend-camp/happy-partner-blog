<?php

use App\Http\Controllers\Frontend\PostController;
use Illuminate\Support\Facades\Route;

// Blog routes
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

/**
 * TODO: 目前暫時不開放前台使用者進入後台，但之後預期會開放，因此使用註解。
 * 後續開放需驗證 Route 有效性。
 */
//Route::get('dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//require __DIR__.'/settings.php';
//require __DIR__.'/auth.php';
