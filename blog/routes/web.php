<?php

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
Route::get('/', function () {
    $posts = Post::latest('published')->with(['category', 'author']);

    if (request('search')) {
        $posts
            ->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%');
    }
    return view('posts', [
        'posts' => $posts->get(),
        'categories' => Category::all(),
        'currentCategory' => null,
        'searchTerm' => request('search')
    ]);
})->name('home'); // named route, optional. can be checked with request()->routIs('home') in view

// a getRouteKeyName method to the model that returns 'slug',
// so the post will be selected by the slug in the url, e.g. slug/my-first-post
// without the method it would default to the post id
Route::get('post/{post}', function (Post $post) {
    return view('post', ['post' => $post]);
});

// this is just another way to select the category by slug
// without adding a getRouteKeyName method to the model
Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts->load(['category', 'author']),
        'categories' => Category::all(),
        'currentCategory' => $category
    ]);
})->name('category');

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', ['posts' => $author->posts->load(['category', 'author']), 'categories' => Category::all()]);
});
