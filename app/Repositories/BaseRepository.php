<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }
    public function find($id, $with = [], $select = '*', $withCount = [])
    {
        return $this->model->select($select)->withCount($withCount)->with($with)->find($id);
    }
    public function get($with = [])
    {
        return $this->model->with($with)->get();
    }
    public function first()
    {
        return $this->model->first();
    }
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }
}
