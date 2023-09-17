<?php

namespace App\Http\Controllers\Backend;

use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Salary::get();
        return view('backend.salaries.index',compact('list'));
    }

    public function create()
    {
        $record = new Salary();
        return view('backend.salaries.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Salary::create($data);
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Salary::find($id);
        return view('backend.salaries.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Salary::find($id);
        $record->update($data);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Salary::destroy($id);
    }

}
