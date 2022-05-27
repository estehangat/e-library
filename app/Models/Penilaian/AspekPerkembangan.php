<?php

namespace App\Models\Penilaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspekPerkembangan extends Model
{
    use HasFactory;

    protected $table = "tm_development_aspect";
    protected $guarded = [];

    public function indikator()
    {
        return $this->hasMany('App\Models\Penilaian\IndikatorAspek', 'development_aspect_id');
    }

    public function scopeAktif($query){
    	$query->where('is_deleted',0);
    }
}
