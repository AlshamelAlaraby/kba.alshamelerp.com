<?php

namespace App\Http\Controllers\Backend;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Bank::get();
        return view('backend.banks.index',compact('list'));
    }

    public function create()
    {
        $record = new Bank();
        return view('backend.banks.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Bank::create($data);
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Bank::find($id);
        return view('backend.banks.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Bank::find($id);
        $record->update($data);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Bank::destroy($id);
    }

}
