<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

use Hash;

class ValidatorProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('MatchingUserPassword',function ($attribute, $value, $parameters)
        {
            $UserPassword=Auth::user()->password;
            return Hash::check($value,$UserPassword);
        });

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
