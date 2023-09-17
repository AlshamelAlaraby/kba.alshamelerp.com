<?php

namespace App\Models;

use App\Modules\Admin\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Transaction extends Model implements HasMedia
{

    use HasMediaTrait;
    protected $fillable = [
        'note','paid_at','member_id','payment_id','value','user_id'
    ];

    public function member(){
        return $this->belongsTo(Member::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function user(){
        return $this->belongsTo(Admin::class);
    }
}
