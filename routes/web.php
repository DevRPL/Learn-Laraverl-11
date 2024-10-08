<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('about', function () {
    return view('about', ['name' => 'Muhamad Jamil Firdaus', 'title' => 'About']);
})->name('about');

Route::get('posts', function () {
    return view('posts', ['title' => 'Blog', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(5)
    ->withQueryString()]);
})->name('posts');

Route::get('posts/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single Post', 'post' => $post]);
})->name('post.show');

Route::get('authors/{user:username}', function (User $user) {

    // $posts = $user->posts->load('category', 'author');

    return view('posts', ['title' => count($user->posts) . ' Articles By '. $user->name, 'posts' => $user->posts]);
});

Route::get('categories/{category:slug}', function (Category $category) {

    // $posts = $category->posts->load('category', 'author');

    return view('posts', ['title' => ' Articles in: '. $category->name, 'posts' => $category->posts]);
});


Route::get('contact', function () {
    return view('contact', ['title' => 'Contact']);
})->name('contact');
