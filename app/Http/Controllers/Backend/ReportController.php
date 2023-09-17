<?php

namespace App\Http\Controllers\Backend;

use App\Models\Member;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends BaseController
{

    public function __construct()
    {

        parent::__construct();
    }

    public function getMembers()
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

        return view('backend.reports.members');
    }


}
