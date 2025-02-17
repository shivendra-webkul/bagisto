<?php

namespace Webkul\BookingProduct\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\BookingProduct\Contracts\BookingProductTableSlot;

class BookingProductTableSlotRepository extends Repository
{
    /**
     * Specify Model class name
     */
    public function model(): string
    {
        return BookingProductTableSlot::class;
    }
}
