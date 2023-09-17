<?php

namespace App\Http\Controllers\Backend;

use App\Modules\Common\Support\PermissionsTrait;
use App\Modules\Role\Requests\CreateRoleRequest;
use App\Modules\Role\Requests\EditRoleRequest;
use App\Modules\Role\RoleLibrary;

class RoleController extends BaseController
{
    use PermissionsTrait;

    private $roleLibrary;

    public function __construct(RoleLibrary $roleLibrary)
    {
        $this->roleLibrary = $roleLibrary;
        view()->composer('backend.roles._form',function($view){
            $view->with('permissions', array_pluck($this->getPermissions(), 'permission'));
        });
        $this->updatePermissionsTable();
        parent::__construct();
    }

    public function index()
    {
        $list = $this->roleLibrary->all();
        return view('backend.roles.index',compact('list'));
    }

    public function create()
    {
        $record = $this->roleLibrary->model();
        return view('backend.roles.create',compact('record'));
    }

    public function store(CreateRoleRequest $request)
    {
        $data = $request->except('_token');
        $this->roleLibrary->create($data);
        return redirect()->route('backend.roles.index')->with('alert-success','New record has been added successfully');
    }

    public function edit($id)
    {
        $record = $this->roleLibrary->find($id);
        return view('backend.roles.edit',compact('record'));
    }

    public function update(EditRoleRequest $request,$id)
    {
        $data = $request->except('_token','_method');
        $this->roleLibrary->update($id,$data);
        return redirect()->route('backend.roles.index')->with('alert-success','The record has been updated successfully');
    }

    public function destroy($id){
        return $this->roleLibrary->delete($id);
    }
}
