<?php

namespace App\Providers;

use App\SMSGateway\Setting;
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
        $setting = new Setting;
        if (Schema::hasTable($setting->getTable())) {
            Setting::all()->map(function($setting){
                config([$setting->key => $setting->value]);
            });
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
