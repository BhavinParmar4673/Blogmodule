<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', 'IndexController@index')->name('index.home');
Route::get('/portfolio/{id}', 'IndexController@singlePortfolio')->name('single');
Route::post('/contact', 'IndexController@storeContactForm')->name('contact.store');


Route::get('/filter', 'IndexController@filter')->name('filter');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('portfolio', 'ProjectController@display')->name('project');
// Route::get('portfolio/{id}', 'ProjectController@singleProject')->name('project.show');
// Route::get('/portfolio-filter', 'ProjectController@filter')->name('filter');
Route::get('post', 'PostController@post')->name('post');
Route::get('post/{slug}', 'PostController@show')->name('post.show');

// Route::post('/contact', 'ContactController@storeContactForm')->name('contact.store');
Route::post('/newsletter', 'ContactController@storeNewsletter')->name('newsletter.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('blogs', 'BlogController');
    // Comments routes
    Route::group(['prefix' => '/comments', 'as' => 'comments.'], function () {
        // store comment route
        Route::post('/{post}', 'CommentController@store')->name('store');
    });

    // Replies routes
    Route::group(['prefix' => '/replies', 'as' => 'replies.'], function () {
        // store reply route
        Route::post('/{comment}', 'ReplyController@store')->name('store');
    });
});