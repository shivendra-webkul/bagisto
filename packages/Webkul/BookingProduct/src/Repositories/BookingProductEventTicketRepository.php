<?php

namespace Webkul\BookingProduct\Repositories;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Webkul\Core\Eloquent\Repository;
use Webkul\BookingProduct\Contracts\BookingProductEventTicket;
use Webkul\BookingProduct\Contracts\BookingProduct;

class BookingProductEventTicketRepository extends Repository
{
    /**
     * Specify Model class name
     */
    public function model(): string
    {
        return BookingProductEventTicket::class;
    }

    /**
     * Summary of save Event Tickets.
     */
    public function saveEventTickets(array $data, BookingProduct $bookingProduct): void
    {
        Event::dispatch('booking_product.booking.event-ticket.save.before', ['data' => $data, 'bookingProduct' => $bookingProduct]);

        $previousTicketIds = $bookingProduct->event_tickets()->pluck('id');

        if (isset($data['tickets'])) {
            foreach ($data['tickets'] as $ticketId => &$ticketInputs) {
                $this->sanitizeInput('special_price', $ticketInputs);

                $this->sanitizeInput('special_price_from', $ticketInputs);

                $this->sanitizeInput('special_price_to', $ticketInputs);

                if (Str::contains($ticketId, 'ticket_')) {
                    $ticket = $this->create(array_merge([
                        'booking_product_id' => $bookingProduct->id,
                    ], $ticketInputs));
                } else {
                    if (is_numeric($index = $previousTicketIds->search($ticketId))) {
                        $previousTicketIds->forget($index);
                    }

                    $ticket = $this->update($ticketInputs, $ticketId);
                }

                $savedTickets[$ticketId]['ticket'] = $ticket;

                $savedTickets[$ticketId]['ticketInputs'] = $ticketInputs;
            }

            Event::dispatch('booking_product.booking.event-ticket.save.after', ['tickets' => $savedTickets]);
        }

        foreach ($previousTicketIds as $previousTicketId) {
            $this->delete($previousTicketId);
        }
    }

    /**
     * Summary of sanitize Input.
     *
     * @param string $fieldName
     * @param array $inputs
     */
    private function sanitizeInput($fieldName, &$inputs)
    {
        $fieldValue = $inputs[$fieldName] ?? null;

        if (
            ! isset($fieldValue)
            || empty($fieldValue)
            || $fieldValue === '0.0000'
            || $fieldValue === '0000-00-00 00:00:00'
        ) {
            $inputs[$fieldName] = null;
        }
    }
}
