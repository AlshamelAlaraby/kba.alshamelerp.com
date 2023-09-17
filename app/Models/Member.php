<?php

namespace App\Models;

use App\Modules\Category\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Member extends Model implements HasMedia
{

    use HasMediaTrait;

    protected $fillable = [
        'name','mobile1','mobile2','idnum','idnum_expirerd_date',
        'passport','passport_expirerd_date','email','birth_date',
        'register_date','playernum','note',
        'category_id','family_id','status_id',
        'region_id','session_id','group_id','nationality_id',
        'gender','code'
    ];



    public function getCfamilyAttribute(){
        $today = date('Y-m-d');
        $l = $this->loans()->whereRaw("DATE(end) >= '{$today}'")->orderBy('id','DESC')->first();
        $fam = "";
        if($l){
            $fam = optional($l->to)->name;
        }else{
            $fam = optional($this->family)->name;
        }
        return $fam;
    }
    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function session(){
        return $this->belongsTo(Session::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function family(){
        return $this->belongsTo(Family::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function nationality(){
        return $this->belongsTo(Nationality::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class)->latest();
    }

    public function loans(){
        return $this->hasMany(Loan::class,'player_id','id')->latest();
    }

    public function scopeFilter(Builder $builder){
        $builder->with(['nationality','loans','group','status','family','category','region']);
        $category_id = request('category_id');
        $family_id = request('family_id');
        $status_id = request('status_id');
        $region_id = request('region_id');
        $group_id = request('group_id');
        $session_id = request('session_id');
        $nationality_id = request('nationality_id');

        if($session_id){
            $builder->where('session_id',$session_id);
        }
        if($category_id){
            $builder->where('category_id',$category_id);
        }
        if($family_id){
            $builder->where('family_id',$family_id);
        }
        if($status_id){
            $builder->where('status_id',$status_id);
        }
        if($region_id){
            $builder->where('region_id',$region_id);
        }
        if($group_id){
            $builder->where('group_id',$group_id);
        }
        if($nationality_id){
            $builder->where('nationality_id',$nationality_id);
        }
        // if($renew_type){
        //     if($renew_type == 'expired'){
        //         $builder->whereDate('end_date','<=',date('Y-m-d'));
        //     }elseif($renew_type == 'renew'){
        //         $builder->whereDate('end_date','<=',Carbon::now()->startOfMonth()->subMonth()->toDateString());
        //     }elseif($renew_type == 'newmember'){
        //         $builder->whereDate('register_date','<=',Carbon::now()->startOfMonth()->subMonth()->toDateString());
        //     }
        // }
        return $builder->get();
    }

}
