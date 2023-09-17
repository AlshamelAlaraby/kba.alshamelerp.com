<?php

namespace App\Http\Controllers\Backend;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Region::get();
        return view('backend.regions.index',compact('list'));
    }

    public function create()
    {
        $record = new Region();
        return view('backend.regions.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Region::create($data);
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Region::find($id);
        return view('backend.regions.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Region::find($id);
        $record->update($data);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Region::destroy($id);
    }

}
