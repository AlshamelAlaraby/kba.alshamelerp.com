<?php

namespace App\Http\Controllers\Backend;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Status::get();
        return view('backend.status.index',compact('list'));
    }

    public function create()
    {
        $record = new Status();
        return view('backend.status.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Status::create($data);
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Status::find($id);
        return view('backend.status.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Status::find($id);
        $record->update($data);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Status::destroy($id);
    }

}
