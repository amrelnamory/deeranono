<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();


        $settings = Setting::first();
        $categories = Category::where('status', 1)->where('parent', null)->get();
        config(
            [
                'global.settings' => $settings,
                'global.categories' => $categories
            ]
        );
    }
}
