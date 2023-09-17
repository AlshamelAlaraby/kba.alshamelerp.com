<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Loan extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table='loans';
    protected $fillable = [
        'player_id','from_id','to_id','start','end','filenumber','note'
    ];

    public function player(){
        return $this->belongsTo(Member::class,'player_id','id');
    }

    public function from(){
        return $this->belongsTo(Family::class,'from_id','id');
    }

    public function to(){
        return $this->belongsTo(Family::class,'to_id','id');
    }

    public function getStartDateAttribute(){
        $date = $this->start;
        return Carbon::parse($date)->format('d-m-Y');
    }

    public function setStartAttribute($value){
        $this->attributes['start'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getEndDateAttribute(){
        $date = $this->end;
        return Carbon::parse($date)->format('d-m-Y');
    }

    public function setEndAttribute($value){
        $this->attributes['end'] = Carbon::parse($value)->format('Y-m-d');
    }
}
