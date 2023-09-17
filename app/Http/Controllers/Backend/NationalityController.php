<?php

namespace App\Http\Controllers\Backend;

use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Nationality::get();
        return view('backend.nationality.index',compact('list'));
    }

    public function create()
    {
        $record = new Nationality();
        return view('backend.nationality.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Nationality::create($data);
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Nationality::find($id);
        return view('backend.nationality.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Nationality::find($id);
        $record->update($data);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Nationality::destroy($id);
    }

}
