<?php

namespace App\Models\Pembayaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmsTermin extends Model
{
    use HasFactory;
    protected $table = "tm_bms_termin";
    protected $fillable = [
        'bms_id',
        'academic_year_id',
        'is_student',
        'nominal',
        'remain',
    ];
}
