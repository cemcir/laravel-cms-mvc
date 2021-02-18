<?php

use Illuminate\Support\Facades\Route;

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


Route::namespace('App\Http\Controllers\Frontend')->group(function() {
    Route::get('/','DefaultController@index')->name('home.Index');
    
    //BLOG
    Route::get('/blog','BlogController@index')->name('blog.Index');
    Route::get('/blog/{slug}','BlogController@detail')->name('blog.Detail'); 
    
    //PAGE
    Route::get('/page/{slug}','PageController@detail')->name('page.Detail');

    //CONTACT
    Route::get('/contact','DefaultController@contact')->name('contact.Detail');
    Route::post('/contact','DefaultController@sendMail');
        
});


Route::namespace('App\Http\Controllers\Backend')->group(function() {

    Route::prefix('nedmin')->group(function() {
        Route::post('/login','DefaultController@authenticate')->name('nedmin.Authenticate');
        Route::get('/','DefaultController@index')->name('nedmin.Index')->middleware('admin');
        Route::get('/login','DefaultController@login')->name('nedmin.Login')->middleware('CheckLogin');
        Route::get('/logout','DefaultController@logout')->name('nedmin.Logout');
    });

    Route::middleware(['admin'])->group(function() {
        Route::prefix('nedmin/settings')->group(function() {
            Route::get('/','SettingsController@index')->name('settings.Index');
            Route::post('/sortable','SettingsController@sortable')->name('settings.Sortable');
            //Route::get('/nedmin/settings/delete/{id}','SettingsController@destroy')->name('settings.Destroy');
            Route::delete('/delete/{id}','SettingsController@destroy')->name('settings.Destroy');
            Route::get('/edit/{id}','SettingsController@edit')->name('settings.Edit');
            Route::post('/update/{id}','SettingsController@update')->name('settings.Update');
        });
    });
});

Route::namespace('App\Http\Controllers\Backend')->group(function() {
    Route::prefix('nedmin')->group(function() {
        Route::middleware(['admin'])->group(function() {
            //BLOG
            Route::post('/sortable','BlogController@sortable')->name('blog.Sortable');
            Route::resource('blog','BlogController');

            //USER
            Route::post('/user/sortable','UserController@sortable')->name('user.Sortable');
            Route::resource('user','UserController');
            
            //SLIDER
            Route::post('/slider/sortable','SliderController@sortable')->name('slider.Sortable');
            Route::resource('slider','SliderController');
        });
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
