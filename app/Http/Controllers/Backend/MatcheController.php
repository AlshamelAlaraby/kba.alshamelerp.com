<?php

namespace App\Http\Controllers\Backend;

use App\Models\Matche;
use App\Models\Member;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

class MatcheController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Matche::get();
        return view('backend.matches.index',compact('list'));
    }

    public function create()
    {
        $record = new Matche();
        return view('backend.matches.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Matche::create($data);
        if(isset($data['mediaTodelete'])){
            Media::whereIn('id', $data['mediaTodelete'])->delete();
        }
        if ($request->file('image')) {
            $record->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Matche::find($id);
        $player = $record->player;
        $clubto = $record->to;
        $p1= $record->players1;
        $p2= $record->players2;
        $selectedPlayers1 = Member::wherein('id',$p1)->get();
        $selectedPlayers2 = Member::wherein('id',$p2)->get();
        return view('backend.matches.edit',compact('record','player','clubto','selectedPlayers1','selectedPlayers2'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Matche::find($id);
        $record->update($data);
        if(isset($data['mediaTodelete'])){
            Media::whereIn('id', $data['mediaTodelete'])->delete();
        }
        if ($request->file('image')) {
            $record->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Matche::destroy($id);
    }

}
