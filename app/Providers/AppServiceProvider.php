<?php

namespace App\Providers;

use Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Carbon::SetLocale(config('app.locale'));

        Schema::defaultStringLength(191);
        if (Schema::hasTable('settings') and ! Setting::has('name')) {
            Setting::set('name', config('app.name'));
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
