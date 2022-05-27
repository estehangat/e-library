<?php

namespace App\Models\Pembayaran;

use App\Models\Kbm\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmsCalonSiswa extends Model
{
    use HasFactory;
    protected $table = "tm_bms_candidate";
    protected $fillable = [
        'unit_id',
        'candidate_student_id',
        'register_nominal',
        'register_paid',
        'register_remain',
        'bms_nominal',
        'bms_paid',
        'bms_deduction',
        'bms_remain',
        'bms_type_id'
    ];

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_id');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa\CalonSiswa', 'candidate_student_id');
    }
    
    public function tipe()
    {
        return $this->belongsTo('App\Models\Pembayaran\TipeBms','bms_type_id');
    }
    
    public function termin()
    {
        return $this->hasMany('App\Models\Pembayaran\BmsTermin','bms_id')->where('is_student',0);
    }

    public function terminTahun()
    {
        $tahun_now = TahunAjaran::where('is_active',1)->first();
        return $this->hasMany(BmsTermin::class,'bms_id')->where('is_student',0);
    }
}
