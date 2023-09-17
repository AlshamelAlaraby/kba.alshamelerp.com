<?php

namespace App\Http\Controllers\Backend;

use App\Models\Championship;
use Illuminate\Http\Request;

class ChampionshipController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Championship::get();
        return view('backend.championships.index',compact('list'));
    }

    public function create()
    {
        $record = new Championship();
        return view('backend.championships.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Championship::create($data);
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Championship::find($id);
        return view('backend.championships.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Championship::find($id);
        $record->update($data);
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Championship::destroy($id);
    }

}
