<?php

namespace Webkul\BookingProduct\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\BookingProduct\Contracts\BookingProductAppointmentSlot;

class BookingProductAppointmentSlotRepository extends Repository
{
    /**
     * Specify Model class name
     */
    public function model(): string
    {
        return BookingProductAppointmentSlot::class;
    }
}
