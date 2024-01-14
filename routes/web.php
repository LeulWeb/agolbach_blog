<?php

use App\Livewire\Blog;
use App\Livewire\BlogListing;
use App\Livewire\CreateBlog;
use App\Livewire\ProfileUpdate;
use App\Livewire\ShowBlog;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});




Route::group(['middleware' => ['auth']], function () {

    // Blog routes
    Route::get('/blog', Blog::class)->name('blog');
    Route::get('/blog/create', CreateBlog::class);
    Route::get('/blog/{id}', ShowBlog::class);

    // Route for profile
    Route::get('profile', ProfileUpdate::class)->name('profile');
});







require __DIR__ . '/auth.php';
