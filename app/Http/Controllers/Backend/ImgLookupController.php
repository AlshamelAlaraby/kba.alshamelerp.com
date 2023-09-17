<?php

namespace App\Http\Controllers\Backend;

use App\Models\ImgLookup;
use Illuminate\Http\Request;

class ImgLookupController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = ImgLookup::get();
        return view('backend.imglookups.index',compact('list'));
    }

    public function create()
    {
        $record = new ImgLookup();
        return view('backend.imglookups.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = ImgLookup::create($data);
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = ImgLookup::find($id);
        return view('backend.imglookups.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = ImgLookup::find($id);
        $record->update($data);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return ImgLookup::destroy($id);
    }

}
