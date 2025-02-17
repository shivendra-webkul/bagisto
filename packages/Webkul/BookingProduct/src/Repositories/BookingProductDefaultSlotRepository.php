<?php

namespace Webkul\BookingProduct\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\BookingProduct\Contracts\BookingProductDefaultSlot;

class BookingProductDefaultSlotRepository extends Repository
{
    /**
     * Specify Model class name
     */
    public function model(): string
    {
        return BookingProductDefaultSlot::class;
    }
}
