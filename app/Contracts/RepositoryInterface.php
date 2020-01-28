<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;


//TODO create baseRepository that others will extend


Interface Repository {

    public function findAll();

    public function findOneOrFail($id);

    public function findByKey($key, $value);

    public function findManyByKey($key, $value);

    public function paginate($number);
}
