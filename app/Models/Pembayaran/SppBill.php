<?php

namespace App\Models\Pembayaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppBill extends Model
{
    use HasFactory;
    protected $table = "tm_spp_bill";
    protected $fillable = [
        'spp_id',
        'unit_id',
        'level_id',
        'student_id',
        'month',
        'year',
        'spp_nominal',
        'deduction_nominal',
        'spp_paid',
        'status',
    ];

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa\Siswa', 'student_id');
    }
}
