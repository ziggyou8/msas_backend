<?php

namespace App\Repositories;

use Illuminate\Database\QueryException;

abstract class ResourceRepository
{

    protected $model;

    public function getPaginate($n)
    {
        return $this->model->paginate($n);
    }

    public function store(Array $inputs)
    {
        return $this->model->create($inputs);
    }

    public function getData()
    {
        return $this->model->get();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, Array $inputs)
    {
        return $this->getById($id)->update($inputs);
    }

    public function destroy($id)
    {
        try {
            $this->getById($id)->delete();
            return true;
        } catch (QueryException $e) {
            return "error";
        }
    }

    public function getNb()
    {
        return $this->model->count();
    }

    protected function getBooleanValue($value)
    {
        return isset($value) && $value == "oui" ? 1 : 0;
    }
}
