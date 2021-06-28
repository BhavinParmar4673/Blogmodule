<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'HomeController@index')->name('home');

// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Reset Password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::middleware(['admin.auth'])->group(function () {
    Route::get('category/allcategory', 'Categorycontroller@allcategory')->name('allcategory');
    Route::resource('category', 'Categorycontroller');

    Route::get('tag/alltag', 'Tagcontroller@alltag')->name('alltag');
    Route::resource('tag', 'Tagcontroller');

    Route::get('/project','Projectcontroller@display')->name('project');
    Route::get('/projectfilter','Projectcontroller@filter')->name('filter');
    Route::get('projects/allproject', 'Projectcontroller@allproject')->name('allproject');
    Route::delete('projects/{project}/delete','Projectcontroller@imagedestroy')->name('imagedestroy');
    Route::resource('projects', 'Projectcontroller');

    Route::get('/post','PostController@post')->name('post');
    Route::get('posts/showpost','PostController@showpost')->name('showpost');
    Route::get('posts/check_slug','PostController@checkslug')->name('checkslug');
    Route::get('/blogcategory', 'Postcontroller@blogcategory')->name('blogcategory');
    Route::get('/blogtag', 'Postcontroller@blogtag')->name('blogtag');
    Route::get('posts/allpost', 'Postcontroller@allpost')->name('allpost');
    Route::resource('posts', 'PostController');
    
    Route::get('testimonials/datatable', 'TestimonialController@datatable')->name('datatable');
    Route::resource('testimonials', 'TestimonialController');

    Route::get('sliders/allslider', 'SliderController@allslider')->name('allslider');
    Route::resource('sliders', 'SliderController');


});
