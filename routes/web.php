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
    return view('admin.frontend.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('blogs', 'BlogController');
    // Comments routes
	Route::group(['prefix' => '/comments', 'as' => 'comments.'], function() {
        // store comment route
		Route::post('/{post}', 'CommentController@store')->name('store');
	});

	// Replies routes
	Route::group(['prefix' => '/replies', 'as' => 'replies.'], function() {
        // store reply route
		Route::post('/{comment}', 'ReplyController@store')->name('store');
	});
});



