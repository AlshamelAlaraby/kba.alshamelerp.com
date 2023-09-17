<?php

namespace App\Modules\Common\Support;

class BaseLibrary
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function all(){
        return $this->repository->all();
    }

    public function find($id){
        return $this->repository->find($id);
    }

    public function create($data){
        return $this->repository->create($data);
    }
    public function update($id,$data){
        return $this->repository->update($id,$data);
    }

    public function model(){
        return $this->repository->model();
    }
    public function delete($id){
        return $this->repository->delete($id);
    }

}
