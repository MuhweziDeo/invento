<?php

namespace App\Http\Controllers\Sale;

use App\Contracts\Repository;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;

class SaleRepository implements Repository
{
    public $model;

    public function __construct(Sale $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
       return $this->model::all();
    }


    public function findOneOrFail($id)
    {
        return $this->model::findOrFail($id);
    }

    public function findByKey($key, $value)
    {
        return $this->model::where($key, $value)->first();
    }

    public function findManyByKey($key, $value)
    {
        return $this->model::where($key, $value)->get();
    }

    public function paginate($number)
    {
        return $this->model::paginate($number);
    }
}
