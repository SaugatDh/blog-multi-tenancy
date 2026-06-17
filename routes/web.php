<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test', function () {
    try {
        DB::connection()->getPdo();
        return "Database connected! MariaDB version: " . DB::connection()->getPdo()->getAttribute(PDO::ATTR_SERVER_VERSION);
    } catch (\Exception $e) {
        return "Database error: " . $e->getMessage();
    }
});




Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Admin
Route::middleware('auth')
->prefix('posts')
->name('posts.')
->group(function () {
    Route::post('/images/upload', [ImageController::class, 'upload'])->name('images.upload');
    Route::get('/', [PostController::class, 'adminIndex'])->name('myblogs');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/posts', [PostController::class, 'store'])->name('store');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::put('/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');

    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('like');
});


    // Comments
    // Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    // Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    // Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
