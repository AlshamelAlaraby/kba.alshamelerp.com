<?php

namespace App\Modules\Role\Repositories;

use Spatie\Permission\Models\Role;

class EloquentRoleRepository implements RoleRepository
{
    public function all()
    {
        return Role::get();
    }

    public function find($id)
    {
        return Role::findOrFail($id);
    }

    public function create($data)
    {
        return Role::create($data);
    }

    public function update($id,$data){
        return Role::where('id',$id)->update($data);
    }

    public function delete($id){
        return Role::destroy($id);
    }

    public function model(){
        return new Role();
    }
}
