<?php

namespace App\Http\Controllers\Backend;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Payment::get();
        return view('backend.payments.index',compact('list'));
    }

    public function create()
    {
        $record = new Payment();
        return view('backend.payments.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Payment::create($data);
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Payment::find($id);
        return view('backend.payments.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Payment::find($id);
        $record->update($data);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Payment::destroy($id);
    }

}
