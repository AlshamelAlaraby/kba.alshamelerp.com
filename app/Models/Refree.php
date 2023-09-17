<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Refree extends Model implements HasMedia
{
    use HasMediaTrait;


    protected $fillable = [
        'name','degree','idnum','account_number','iban','bank_id','degree_id','code'
    ];

    public function bank(){
        return $this->belongsTo(Bank::class);
    }
    public function degre(){
        return $this->belongsTo(Degree::class,'degree_id','id');
    }
}
