<?php

namespace App\Models\Siswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;
    protected $table = "tm_parents";
    protected $fillable = [
        'employee_id',
        'father_name',
        'father_nik',
        'father_phone',
        'father_email',
        'father_job',
        'father_position', //jabatan ayah
        'father_phone_office',
        'father_job_address', //alamat kantor ayah
        'father_salary', //gaji ayah

        'mother_name',
        'mother_nik',
        'mother_phone',
        'mother_email',
        'mother_job',
        'mother_position', //jabatan ibu
        'mother_phone_office',
        'mother_job_address', //alamat kantor ibu
        'mother_salary', //gaji ibu

        'parent_address',
        'parent_phone_number',

        'guardian_name',
        'guardian_nik',
        'guardian_phone_number',
        'guardian_email',
        'guardian_job',
        'guardian_position', //jabatan ibu
        'guardian_phone_office',
        'guardian_job_address', //alamat kantor ibu
        'guardian_salary', //gaji ibu
        'guardian_address',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class,'parent_id','id');
    }

    public function siswas()
    {
        return $this->hasMany(IdentitasSiswa::class,'parent_id','id');
    }

    public function calonSiswa()
    {
        return $this->hasMany(CalonSiswa::class,'parent_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\LoginUser','user_id');
    }
}
