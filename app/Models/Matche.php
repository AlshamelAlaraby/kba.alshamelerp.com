<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Matche extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table='matches';
    protected $fillable = [
        'date','championship_id','level','type','score_sheet_num','registrar_name',
        'registrar_assistant','timer','timer24','referee1_id','referee2_id',
        'referee3_id','referee4_id','note','club1_id','club2_id','group_id',
        'players1','players2'
    ];

    protected $casts = [
        'players1' => 'array',
        'players2' => 'array',
    ];

    public function championship(){
        return $this->belongsTo(Championship::class,'championship_id','id');
    }

    public function players(){
        return $this->belongsToMany(Member::class,'matches_players','matche_id','player_id');
    }

    public function ref1(){
        return $this->belongsTo(Refree::class,'referee1_id','id');
    }
    public function club1(){
        return $this->belongsTo(Family::class,'club1_id','id');
    }
    public function club2(){
        return $this->belongsTo(Family::class,'club2_id','id');
    }

    public function ref2(){
        return $this->belongsTo(Refree::class,'referee2_id','id');
    }

    public function ref3(){
        return $this->belongsTo(Refree::class,'referee3_id','id');
    }

    public function ref4(){
        return $this->belongsTo(Refree::class,'referee4_id','id');
    }
}
