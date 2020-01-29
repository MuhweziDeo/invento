<?php


namespace App\Http\Controllers\ServiceSale;


use App\Contracts\Repository;
use App\Models\Service;
use App\Models\ServiceSale;
use Illuminate\Database\Eloquent\Model;

class ServiceSaleRepository implements Repository
{
    public $model;

    public function __construct(ServiceSale $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model::all();
    }

    public function findOneOrFail($id): ?Model
    {
        return $this->model::findOrFail($id);
    }

    public function findByKey($key, $value): ?Model
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
