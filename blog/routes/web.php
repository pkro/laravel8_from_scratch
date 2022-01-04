<?php

use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [PostController::class, 'index'])->name('home'); // named route, optional. can be checked with request()->routIs('home') in view
Route::get('post/{post}', [PostController::class, 'post']);
Route::get('categories/{category:slug}', [PostController::class, 'categories'])->name('category');

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', ['posts' => $author->posts->load(['category', 'author']), 'categories' => Category::all()]);
});
