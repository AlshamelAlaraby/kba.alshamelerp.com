<?php

namespace App\Http\Controllers\Backend;

use App\Models\Family;
use App\Models\Member;
use App\Models\Refree;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Exception;

class HomeController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){

        $summery = DB::table('status')
            ->select('status.id','status.name as title', DB::raw("count(members.status_id) as count"))
            ->leftJoin('members', 'status.id', '=', 'members.status_id')
            ->groupBy('status.id')
            ->get()->toArray();
        return view('backend.home',compact('summery'));
    }


    public function getPlayerList()
    {
        $term = request('term');
        $club_id = request('club_id');
        $group_id = request('group_id');
        $results = array();
        $queries = Member::query()->with('family','group');
        if($club_id){
            $queries->where('family_id',$club_id);
        }
        if($group_id){
            $queries->where('group_id',$group_id);
        }
        if($term){
            $queries->whereRaw('LOWER(name) like "%'.strtolower($term).'%"');
            $queries->orwhereRaw('LOWER(code) like "%'.strtolower($term).'%"');
        }
        $queries = $queries->take(10)->get();
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'text' => $query->code. " - ".$query->name. " - ".optional($query->family)->name. " - ".optional($query->group)->name];
        }
        return response()->json($results);
    }

    public function getClubList()
    {
        $term = request('term');
        $results = array();
        $queries = Family::query();
        if($term){
            $queries->whereRaw('LOWER(name) like "%'.strtolower($term).'%"');
        }
        $queries = $queries->take(10)->get();
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'text' => $query->name];
        }
        return response()->json($results);
    }
    public function getRefereeList()
    {
        $term = request('term');
        $results = array();
        $queries = Refree::query();
        if($term){
            $queries->whereRaw('LOWER(name) like "%'.strtolower($term).'%"');
            $queries->orwhereRaw('LOWER(code) like "%'.strtolower($term).'%"');
        }
        $queries = $queries->take(10)->get();
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'text' => $query->code. " - ".$query->name];
        }
        return response()->json($results);
    }

    public function migrate() {
        Artisan::call('migrate');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        $storageLink = public_path().'/storage';
        if (File::exists($storageLink)) {
            try{
                unlink($storageLink);
            }catch(Exception $e){

            }
        }
        Artisan::call('storage:link');
        request()->session()->flash('alert-success', 'تم دمج الدتابيز بنجاح');
        return back();
    }

}
