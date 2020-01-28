<?php

namespace App\Listeners;

use App\Events\SaleMade;

class UpdateItemQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SaleMade  $event
     * @return void
     */
    public function handle(SaleMade $event)
    {
        $data = [];

        $remaining_quantity = $event->item->quantity - $event->quantity_bought;

        $data['quantity'] = $remaining_quantity;

        if ($remaining_quantity <= $event->item->minimum_quantity) {
            $data['saleable'] = false;
        }

        $event->item->update($data);

    }
}
