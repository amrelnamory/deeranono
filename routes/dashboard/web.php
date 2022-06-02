<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => 'ar',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],

    function () {
        // Dashboard Routes
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('markAsRead/{id}', function ($id) {
                auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
            })->name('markAsRead');

            Route::get('/', 'WelcomeController@index')->name('welcome');

            // User Routes    
            Route::get('users/{id}/changePassword', 'UserController@changePassword')->name('users.changePassword');
            Route::put('users/{id}/updatePassword', 'UserController@updatePassword')->name('users.updatePassword');
            Route::get('users/notifications/{id}', 'UserController@notifications')->name('users.notifications');
            Route::resource('users', 'UserController')->except(['show']);

            Route::put('categories/updateStatus/{id}', 'CategoryController@updateStatus')->name('categories.updateStatus');
            Route::resource('categories', 'CategoryController')->except(['show']);

            Route::put('products/updateStatus/{id}', 'ProductController@updateStatus')->name('products.updateStatus');
            Route::resource('products', 'ProductController');

            Route::resource('articles', 'ArticleController');

            Route::resource('slides', 'SlidesController');

            Route::resource('brands', 'BrandsController');

            Route::put('orders/updateOrder/{id}', 'OrderController@updateOrder')->name('orders.updateOrder');
            Route::get('orders/invoice/{id}', 'OrderController@invoice')->name('orders.invoice');
            Route::resource('orders', 'OrderController');

            Route::resource('messages', 'ContactController');

            Route::resource('settings', 'SettingController')->except(['show', 'create' . 'store', 'edit', 'destroy']);
        });
        // End of Dashboard Routes

    }
);
