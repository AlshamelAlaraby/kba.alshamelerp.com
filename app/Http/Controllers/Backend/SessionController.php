<?php

namespace App\Http\Controllers\Backend;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $list = Session::get();
        return view('backend.sessions.index',compact('list'));
    }

    public function create()
    {
        $record = new Session();
        return view('backend.sessions.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Session::create($data);
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Session::find($id);
        return view('backend.sessions.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Session::find($id);
        $record->update($data);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Session::destroy($id);
    }

}
