<?php

namespace App\Http\Controllers\Backend;

use App\Models\Family;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

class FamilyController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Family::get();
        return view('backend.family.index',compact('list'));
    }

    public function create()
    {
        $record = new Family();
        return view('backend.family.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Family::create($data);
        if ($request->file('profile')) {
            $record->addMedia($request->file('profile'))->toMediaCollection('profile');
        }
        if ($request->file('images')) {
            foreach($request->file('images') as $i=>$img){
                $type = $data['type'][$i];
                $note = $data['note'][$i];
                $date = $data['date'][$i];
                $record->addMedia($img)->withCustomProperties(['type' => $type,'note'=>$note,'date'=>$date])->toMediaCollection('images');
            }
        }
        if ($request->file('files')) {
            foreach($request->file('files') as $i=>$file){
                $type = $data['type2'][$i];
                $note = $data['note2'][$i];
                $date = $data['date2'][$i];
                $record->addMedia($file)->withCustomProperties(['type' => $type,'note'=>$note,'date'=>$date])->toMediaCollection('files');
            }
        }
        return redirect(route('backend.family.index'))->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Family::find($id);
        return view('backend.family.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Family::find($id);
        $record->update($data);
        if(isset($data['mediaTodelete'])){
            Media::whereIn('id', $data['mediaTodelete'])->delete();
        }
        if ($request->file('profile')) {
            $record->addMedia($request->file('profile'))->toMediaCollection('profile');
        }
        if ($request->file('images')) {
            foreach($request->file('images') as $i=>$img){
                $type = $data['type'][$i];
                $note = $data['note'][$i];
                $date = $data['date'][$i];
                $record->addMedia($img)->withCustomProperties(['type' => $type,'note'=>$note,'date'=>$date])->toMediaCollection('images');
            }
        }
        if ($request->file('files')) {
            foreach($request->file('files') as $i=>$file){
                $type = $data['type2'][$i];
                $note = $data['note2'][$i];
                $date = $data['date2'][$i];
                $record->addMedia($file)->withCustomProperties(['type' => $type,'note'=>$note,'date'=>$date])->toMediaCollection('files');
            }
        }
        return redirect(route('backend.family.index'))->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Family::destroy($id);
    }

}
