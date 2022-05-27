<?php

namespace App\Models\Pembayaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = "tm_spp";
    protected $fillable = [
        'unit_id',
        'student_id',
        'saldo',
        'total',
        'deduction',
        'remain',
        'paid',
    ];

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa\Siswa', 'student_id');
    }
}
