<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = "tref_unit";

    public function jabatan()
    {
        return $this->belongsToMany('App\Models\Penempatan\Jabatan','tm_position_unit','unit_id', 'position_id')->withTimestamps();
    }

    public function calonPegawais()
    {
        return $this->belongsToMany('App\Models\Rekrutmen\CalonPegawai','candidate_employee_unit','unit_id', 'candidate_employee_id')->withTimestamps();
    }

    public function pegawais()
    {
        return $this->hasMany('App\Models\Rekrutmen\PegawaiUnit','unit_id');
    }

    public function wilayah()
    {
        return $this->belongsTo('App\Models\Wilayah','region_id');
    }

    public function penempatanPegawai()
    {
        return $this->hasMany('App\Models\Penempatan\PenempatanPegawai','unit_id');
    }

    public function calonPegawai()
    {
        return $this->hasMany('App\Models\Rekrutmen\CalonPegawai','unit_id');
    }

    public function pegawai()
    {
        return $this->hasMany('App\Models\Rekrutmen\Pegawai','unit_id');
    }

    public function skbm()
    {
        return $this->hasMany('App\Models\Skbm\Skbm','unit_id');
    }

    public function pelatihan()
    {
        return $this->hasMany('App\Models\Pelatihan\Pelatihan','organizer_id');
    }

    public function siswa()
    {
        return $this->hasMany('App\Models\Siswa\Siswa','unit_id');
    }
    
    public function mataPelajaran()
    {
        return $this->hasMany('App\Models\Kbm\MataPelajaran','unit_id');
    }

    public function kelompokMataPelajaran()
    {
        return $this->hasMany('App\Models\Kbm\KelompokMataPelajaran','unit_id');
    }

    public function targetTahfidz()
    {
        return $this->hasMany('App\Models\Penilaian\TargetTahfidz','unit_id');
    }

    public function anggaran()
    {
        return $this->hasMany('App\Models\Anggaran\Anggaran','unit_id');
    }

    public function nilaiPsc()
    {
        return $this->hasMany('App\Models\Psc\PscScore','unit_id');
    }

    public function ikuAspek()
    {
        return $this->hasMany('App\Models\Iku\IkuAspectUnit','unit_id');
    }

    public function ikuNilai()
    {
        return $this->hasMany('App\Models\Iku\IkuAchievement','unit_id');
    }

    public function psbRegisterCounter()
    {
        return $this->hasMany('App\Models\Psb\RegisterCounter','academic_year_id');
    }
    
    public function scopeSekolah($query)
    {
        return $query->where('is_school',1);
    }
}
