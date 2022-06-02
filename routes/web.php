<?php


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

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],

    function () {
        Auth::routes(['register' => false]);

        Route::get('/', 'PagesController@index')->name('website.index');

        Route::get('/articles', 'PagesController@articles')->name('website.articles');
        Route::get('/articles/{id}', 'PagesController@singleArticle')->name('website.singleArticle');

        Route::get('/products', 'PagesController@products')->name('website.products');

        Route::get(LaravelLocalization::transRoute('routes.subCategory'), ['uses' => 'PagesController@subCategory'])->name('website.subCategory');

        Route::get('/product/{id}', 'PagesController@singleProduct')->name('website.singleProduct');

        Route::get('/cart', 'PagesController@viewCart')->name('website.viewCart');

        Route::post('/addToCart/{id}', 'PagesController@addToCart')->name('website.addToCart');

        Route::get('/completeOrder', 'PagesController@completeOrder')->name('website.completeOrder');

        Route::get('/orderSuccess', 'PagesController@orderSuccess')->name('website.orderSuccess');

        Route::get('/contactUs', 'PagesController@contactUs')->name('website.contactUs');

        Route::get('markAsRead/{id}', function ($id) {
            auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        })->name('markAsRead');

        Route::get('markAsUnRead/{id}', function ($id) {
            DB::table('notifications')->where('id', $id)->update(['read_at' => null]);
        })->name('markAsUnRead');
    }
);
