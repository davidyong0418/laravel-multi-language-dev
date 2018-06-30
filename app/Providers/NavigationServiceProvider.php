<?php

namespace App\Providers;

use Nutnet\Artifico2\Navigation\ServiceProvider;
use App\Services\Navigation;
use Nutnet\Artifico2\Navigation\App\Models\Item;

class NavigationServiceProvider extends ServiceProvider
    {
        public function register()
        {
            $this->app->singleton('artifico-navigation', function ($app) {
                return new Navigation($app->make(Item::class));

            });
        }
    }