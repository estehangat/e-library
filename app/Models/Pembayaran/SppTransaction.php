<?php

namespace App\Models\Pembayaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppTransaction extends Model
{
    use HasFactory;
    protected $table = "tm_spp_trx";
    protected $fillable = [
        'unit_id',
        'student_id',
        'month',
        'year',
        'nominal',
        'academic_year_id',
        'trx_id',
        'date',
        'created_at',
    ];

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa\Siswa', 'student_id');
    }
}
