<?php

namespace App\Http\Controllers\Backend;

use App\Models\Degree;
use Illuminate\Http\Request;

class DegreeController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $list = Degree::get();
        return view('backend.degrees.index',compact('list'));
    }

    public function create()
    {
        $record = new Degree();
        return view('backend.degrees.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Degree::create($data);
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Degree::find($id);
        return view('backend.degrees.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Degree::find($id);
        $record->update($data);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Degree::destroy($id);
    }

}
