<?php

namespace Webkul\BookingProduct\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\BookingProduct\Contracts\BookingProductRentalSlot;

class BookingProductRentalSlotRepository extends Repository
{
    /**
     * Specify Model class name
     */
    public function model(): string
    {
        return BookingProductRentalSlot::class;
    }
}
