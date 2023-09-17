<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use App\Modules\Admin\AdminLibrary;
use App\Modules\Admin\Models\Admin;
use App\Modules\Admin\Requests\CreateAdminRequest;
use App\Modules\Admin\Requests\EditAdminRequest;
use Spatie\Permission\Models\Role;

class AdminController extends BaseController
{
    private $adminLibrary;

    public function __construct(AdminLibrary $adminLibrary)
    {
        $this->adminLibrary = $adminLibrary;
        view()->composer('backend.admins._form',function($view){
            $view->with('roles',Role::pluck('name')->all());
        });

        parent::__construct();
    }

    public function index()
    {
        $list = $this->adminLibrary->all();
        return view('backend.admins.index',compact('list'));
    }

    public function create()
    {
        $record = $this->adminLibrary->model();
        return view('backend.admins.create',compact('record'));
    }

    public function store(CreateAdminRequest $request)
    {
        $data = $request->except('_token');
        $setting = Setting::where('key','max_allowed_users')->first();
        $userCount = Admin::query()->count();
        if($userCount >= $setting->value){
            return redirect()->route('backend.admins.index')->with('alert-danger','تعديت عدد المستخدمين المسموح به');
        }
        $this->adminLibrary->create($data);
        return redirect()->route('backend.admins.index')->with('alert-success','New record has been added successfully');
    }

    public function edit($id)
    {
        $record = $this->adminLibrary->find($id);
        if(request()->ajax()){
            return view('backend.admins.editajax',compact('record'));
        }
        return view('backend.admins.edit',compact('record'));
    }

    public function update(EditAdminRequest $request,$id)
    {
        $data = $request->except('_token','_method');
        $this->adminLibrary->update($id,$data);
        return redirect()->route('backend.admins.index')->with('alert-success','The record has been updated successfully');
    }

    public function destroy($id){
        return $this->adminLibrary->delete($id);
    }
}
