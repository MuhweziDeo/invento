<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $fillable = ['cost', 'size', 'quantity', 'minimum_quantity', 'brand', 'code', 'saleable', 'name'];


}
