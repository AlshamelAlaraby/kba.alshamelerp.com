<?php

namespace App\Http\Controllers\Backend;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Group::get();
        return view('backend.groups.index',compact('list'));
    }

    public function create()
    {
        $record = new Group();
        return view('backend.groups.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Group::create($data);
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Group::find($id);
        return view('backend.groups.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Group::find($id);
        $record->update($data);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Group::destroy($id);
    }

}
