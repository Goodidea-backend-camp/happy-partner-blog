<?php

use App\Http\Controllers\Frontend\PostController;
use Illuminate\Support\Facades\Route;

// Blog routes
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

/**
 * TODO: 目前不開放前台使用者進入後台，但尚無時間檢查並刪除相關檔案，因此暫時用註解讓使用者無法訪問，後續應考慮將相關檔案刪除
 */
// Route::get('dashboard', function () {
//    return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
//
// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';
