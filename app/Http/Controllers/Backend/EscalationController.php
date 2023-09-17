<?php

namespace App\Http\Controllers\Backend;

use App\Models\Escalation;
use App\Models\Member;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

class EscalationController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Escalation::get();
        return view('backend.escalations.index',compact('list'));
    }

    public function create()
    {
        $record = new Escalation();
        return view('backend.escalations.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $player = Member::find($data['player_id']);
        $data['from_id'] = $player->group_id;
        $record = Escalation::create($data);
        $player->group_id = $data['to_id'];
        $player->save();
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
        $record = Escalation::find($id);
        $player = $record->player;
        $clubto = $record->to;
        return view('backend.escalations.edit',compact('record','player','clubto'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Escalation::find($id);
        $player = Member::find($data['player_id']);
        $data['from_id'] = $player->group_id;
        $record->update($data);
        $player->group_id = $data['to_id'];
        $player->save();

        if(isset($data['mediaTodelete'])){
            Media::whereIn('id', $data['mediaTodelete'])->delete();
        }
        if ($request->file('image')) {
            $record->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Escalation::destroy($id);
    }

}
