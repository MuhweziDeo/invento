<?php


namespace App\Http\Controllers\Item;

use App\Contracts\Repository;
use App\Models\Item;
use Illuminate\Database\Eloquent\Model;

class ItemRepository implements Repository
{
	public $model;

	public function __construct(Item $model)
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
