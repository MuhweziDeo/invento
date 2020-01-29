<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSale extends Model
{
    protected $fillable = ['service_id', 'item_id', 'optional', 'customer_id'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
