<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
    // ->middleware('auth');
    // What this middleware does is, doesn't allow guests to view that specific page
    // Or we can set a middleware in the controller

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.delete');

Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');
// Using user:username to choose a specific column name that we want to extract for root-model binding

Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.like');
// We are using route-model binding here, which involves entering the name of the model you want to look up
// We need to pass in the model in the controller as well, in the store method

Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.like');
