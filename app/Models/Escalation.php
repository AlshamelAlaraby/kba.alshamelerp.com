<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Escalation extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table='escalation';
    protected $fillable = [
        'date','player_id','from_id','to_id','note','status'
    ];

    public function player(){
        return $this->belongsTo(Member::class,'player_id','id');
    }

    public function from(){
        return $this->belongsTo(Group::class,'from_id','id');
    }

    public function to(){
        return $this->belongsTo(Group::class,'to_id','id');
    }
}
