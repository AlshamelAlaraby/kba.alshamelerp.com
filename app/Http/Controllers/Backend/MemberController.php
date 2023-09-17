<?php

namespace App\Http\Controllers\Backend;

use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        if (\request()->ajax()) {
            $list = Member::query()->filter();
            $datatable = DataTables::of($list)
            ->addColumn('cfamily',function($item){
                return $item->cfamily;
            })
            ->addColumn('Nationality',function($item){
                return optional($item->nationality)->name;
            })
            ->addColumn('regionName',function($item){
                return optional($item->region)->name;
            })
            ->addColumn('sessionName',function($item){
                return optional($item->session)->name;
            })

           ->addColumn('profile',function($item){
                return  '<img width="100px" src="'.optional($item->getFirstMedia('profile'))->getUrl().'"/>';
            })->addColumn('actions',function($item){
               $btn = '
                <a style="color: #fff" title="التفاصيل" href="'.route('backend.members.show',$item->id).'" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                <a title="تعديل" href="'.route('backend.members.edit',$item->id).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                <a title="حذف" href="#" data-action="'.route('backend.members.destroy',$item->id).'" class="btn btn-danger deleteRecord btn-sm"><i class="fa fa-trash"></i></a>
                ';
                return $btn;
            });
            $datatable->rawColumns(['profile','actions']);
            return $datatable->make(true);

        }

        return view('backend.members.index');
    }

    public function create()
    {
        $record = new Member();
        return view('backend.members.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        //$data['can_vote'] = $request->has('can_vote');
        $inputs = $data;
        $inputs['note'] = $data['membernote']??'';
        $inputs['playernum'] = $inputs['code'];
        $isFound = Member::query()->where('code',$inputs['code']);
        if($inputs['idnum']){
            $isFound->orwhere('idnum',$inputs['idnum']);
        }
        $isFound = $isFound->first();
        if($isFound){
            return back()->withInput()->with('alert-danger','خطأ رقم البطاقه او الرقم المدني مسجل مع لاعب اخر وهو : '.$isFound->name);
        }
        $record = Member::create($inputs);

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
        return redirect(route('backend.members.show',$record->id))->with('alert-success','تمت اضافة سجل جديد بنجاح');
    }

    public function edit($id)
    {
        $record = Member::find($id);
        return view('backend.members.edit',compact('record'));
    }

    public function show($id)
    {
        $record = Member::find($id);

        return view('backend.members.show',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $record = Member::find($id);
        //dd($data);
        $inputs = $data;
        $inputs['note'] = $data['membernote']??'';
        $inputs['playernum'] = $inputs['code'];
        $record->update($inputs);
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
        return redirect(route('backend.members.index'))->with('alert-success','تم تعديل البيانات بنجاح');
    }

    public function destroy($id){
        return Member::destroy($id);
    }


    public function addPayment(Request $request){
        $member_id = $request->member_id;
        if($member_id)
            $member = Member::find($member_id);
        if($request->isMethod('post')){
            $data = $request->except('_token');
            $trans['member_id'] = $member_id;
            $trans['user_id'] = auth()->user()->id;
            $trans['note'] =  $data['note'];
            $trans['paid_at'] =  $data['paid_at'];
            $trans['value'] =  $data['value'];
            $trans['payment_id'] =  $data['payment_id'];
            $transaction = Transaction::create($trans);
            $member->update([
                'start_date'=>$data['start_date'],
                'end_date'=>$data['end_date']
            ]);
            if ($request->file('images')) {
                foreach($request->file('images') as $img){
                    $transaction->addMedia($img)->toMediaCollection('images');
                }
            }
            return back()->with('alert-success','تم اضافة البيانات بنجاح');
        }
        $to = '';
        $from = '';
        $totalValue = '';
        if($member_id){
            $to = now()->addMonth($member->category->monthes);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $member->end_date);
            $diffMonth = $to->diffInMonths($from);
            $from = $from->format('Y-m-d');
            $to = $to->format('Y-m-d');
            $totalValue = ($member->category->renew_price / $member->category->monthes) * $diffMonth ;
        }else{
            $member = new Member;
        }
        return view('backend.members.payment',compact('member','totalValue','from','to'));
    }

}
