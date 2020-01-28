<?php

namespace App\Events;


use App\Models\Item;
use Illuminate\Queue\SerializesModels;

class SaleMade
{
    use SerializesModels;

    public $item;
    public $quantity_bought;

    /**
     * Create a new event instance.
     *
     * @param Item $item
     * @param $quantity_bought
     */
    public function __construct(Item $item, int $quantity_bought)
    {
        $this->item = $item;
        $this->quantity_bought = $quantity_bought;
    }


}
