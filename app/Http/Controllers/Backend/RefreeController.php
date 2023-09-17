<?php

namespace App\Http\Controllers\Backend;

use App\Models\Refree;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

class RefreeController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Refree::get();
        return view('backend.refrees.index',compact('list'));
    }

    public function create()
    {
        $record = new Refree();
        return view('backend.refrees.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $record = Refree::create($data);
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
        return back()->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Refree::find($id);
        return view('backend.refrees.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Refree::find($id);
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
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Refree::destroy($id);
    }

}
