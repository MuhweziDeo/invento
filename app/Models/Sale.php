<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['quantity', 'customer_id', 'item_id', 'staff_id'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function sold_by()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
