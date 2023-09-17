<?php

namespace App\Modules\Admin\Repositories;

use App\Modules\Admin\Models\Admin;

class EloquentAdminRepository implements AdminRepository
{
    public function all()
    {
        return Admin::get();
    }

    public function find($id)
    {
        return Admin::findOrFail($id);
    }

    public function create($data)
    {
        return Admin::create($data);
    }

    public function update($id,$data){
        return Admin::where('id',$id)->update($data);
    }

    public function delete($id){
        return Admin::destroy($id);
    }

    public function model(){
        return new Admin();
    }
}
