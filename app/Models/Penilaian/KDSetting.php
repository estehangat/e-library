<?php

namespace App\Models\Penilaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KDSetting extends Model
{
    use HasFactory;

    protected $table = "report_kd";
    protected $guarded = [];

    public function tipe()
    {
        return $this->belongsTo('App\Models\Penilaian\KDType', 'kd_type_id');
    }

    public function scopePengetahuan($query){
        return $query->where('kd_type_id',1);
    }

    public function scopeKeterampilan($query){
        return $query->where('kd_type_id',2);
    }
}
