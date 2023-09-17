<?php

namespace App\Http\Controllers\Backend;

use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

class LoanController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $list = Loan::get();
        return view('backend.loans.index',compact('list'));
    }

    public function create()
    {
        $record = new Loan();
        return view('backend.loans.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $player = Member::find($data['player_id']);
        $data['from_id'] = $player->family_id;
        $record = Loan::create($data);
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
        $record = Loan::find($id);
        $player = $record->player;
        $clubto = $record->to;
        return view('backend.loans.edit',compact('record','player','clubto'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        // $data['start'] = date('Y-m-d',strtotime($data['start']));
        // $data['end'] = date('Y-m-d',strtotime($data['end']));
        //dd($data);
        $record = Loan::find($id);
        $player = Member::find($data['player_id']);
        $data['from_id'] = $player->family_id;
        $record->fill($data);
        $record->save();
        if(isset($data['mediaTodelete'])){
            Media::whereIn('id', $data['mediaTodelete'])->delete();
        }
        if ($request->file('image')) {
            $record->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return back()->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Loan::destroy($id);
    }

}
