<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*view()->composer('app',function ($view) { 
        if(Auth::check()) 
        {$view->with('username', Auth::user()->username);}          
            });*/
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
