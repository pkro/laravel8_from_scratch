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
    /*\Illuminate\Support\Facades\DB::listen(function($query) {
        //\Illuminate\Support\Facades\Log::info('query executed');
        //or, shorter
        logger($query->sql, $query->bindings);
    });*/
    return view('posts', ['posts' => Post::latest('published')->with(['category', 'author'])->get()]);
});

// a getRouteKeyName method to the model that returns 'slug',
// so the post will be selected by the slug in the url, e.g. slug/my-first-post
// without the method it would default to the post id
Route::get('post/{post}', function (Post $post) {
    return view('post', ['post' => $post]);
});

// this is just another way to select the category by slug
// without adding a getRouteKeyName method to the model
Route::get('categories/{category:slug}', function(Category $category) {
    return view('posts', ['posts' => $category->posts->load(['category', 'author'])]);
});

Route::get('authors/{author:username}', function(User $author) {
    return view('posts', ['posts' => $author->posts->load(['category', 'author'])]);
});
