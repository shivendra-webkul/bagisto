<?php

namespace Webkul\BookingProduct\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Webkul\BookingProduct\Console\Commands\Booking as BookingCommand;
use Webkul\BookingProduct\Models\Cart;
use Webkul\Checkout\Models\Cart as BaseCart;

class BookingProductServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'booking');

        // $this->loadViewsFrom(__DIR__.'/../Resources/views', 'booking');

        Blade::anonymousComponentPath(__DIR__.'/../Resources/views/components', 'booking');

        $this->app->bind(BaseCart::class, Cart::class);

        $this->app->register(EventServiceProvider::class);

        $this->app->register(ModuleServiceProvider::class);

        $this->publishAssets();
    }

    /**
     * publishing Assets.
     */
    protected function publishAssets(): void
    {
        $this->publishes([
            __DIR__.'/../../publishable/build' => public_path('themes/booking/build'),
        ], 'public');
    }
}
