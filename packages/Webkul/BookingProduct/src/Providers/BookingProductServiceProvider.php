<?php

namespace Webkul\BookingProduct\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BookingProductServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'booking');

        Blade::anonymousComponentPath(__DIR__.'/../Resources/views/components', 'booking');

        $this->app->register(EventServiceProvider::class);

        $this->app->register(ModuleServiceProvider::class);
    }
}
