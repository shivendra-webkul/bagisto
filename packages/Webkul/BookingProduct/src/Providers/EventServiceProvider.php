<?php

namespace Webkul\BookingProduct\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Webkul\Theme\ViewRenderEventManager;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'checkout.order.save.after' => [
            'Webkul\BookingProduct\Listeners\Order@afterPlaceOrder',
        ],
    ];

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        parent::boot();

        Event::listen('bagisto.admin.catalog.product.edit.form.inventories.controls.before', static function (ViewRenderEventManager $viewRenderEventManager) {
            if (View::exists('booking::admin.catalog.products.edit.inventories')) {
                $viewRenderEventManager->addTemplate('booking::admin.catalog.products.edit.inventories');
            }
        });
    }
}
