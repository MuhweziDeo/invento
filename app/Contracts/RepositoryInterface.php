<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

Interface Repository {

    public function findAll();

    public function findOneOrFail($id): ? Model;

    public function findByKey($key, $value): ? Model;

    public function findManyByKey($key, $value);

    public function paginate($number);
}
