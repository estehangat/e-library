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

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Rekrutmen\Pegawai','employee_id');
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

    public function users()
    {
        return $this->hasMany('App\Models\LoginUser','user_id');
    }

    public function getNameAttribute()
    {
        return ($this->father_name ? $this->father_name.($this->mother_name ? '/' : null) : null).($this->mother_name ? $this->mother_name.($this->guardian_name ? '/' : null) : null).($this->guardian_name ? $this->guardian_name : null);
    }

    public function getLoginUserAttribute()
    {
        return $this->pegawai && $this->users()->where('role_id','!=',36)->count() > 0 ? $this->user()->where('role_id','!=',36)->first() : $this->user()->where('role_id',36)->first();
    }

    public function getChildrensAttribute()
    {
        $datas = null;
        $calons = $this->calonSiswa()->count() > 0 ? $this->calonSiswa()->select('student_name')->get(): null;
        $siswas = $this->siswas()->count() > 0 ? $this->siswas()->select('student_name')->get() : null;
        if($calons && $siswas){
            $datas = $siswas->concat($calons);
        }
        elseif($siswas){
            $datas = $siswas;
        }
        else{
            $datas = $calons;
        }

        return $datas ? implode('; ',$datas->sortBy('student_name')->pluck('student_name')->unique()->toArray()) : null;
    }
}
