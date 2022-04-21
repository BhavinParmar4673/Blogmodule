<?php

use App\Http\Controllers\Categorycontroller;
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

Route::get('/', function () {
    return view('frontend.index');
});
Route::get('project', 'Projectcontroller@display')->name('project');
Route::get('project/{id}', 'Projectcontroller@singleProject')->name('project.show');
Route::get('post', 'PostController@post')->name('post');
Route::get('post/{slug}', 'PostController@show')->name('post.show');
Route::get('/contact', 'ContactController@contactForm')->name('contact');
Route::post('/contact', 'ContactController@storeContactForm')->name('contact.store');
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