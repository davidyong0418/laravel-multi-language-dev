<?php

namespace App\Providers;
use Nutnet\Artifico2\App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use App\Observers\RobotsObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Setting::observe(RobotsObserver::class);
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
