<?php

namespace App\Models\Ppa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpaProposal extends Model
{
    use HasFactory;

    protected $table = "ppa_proposal";
    protected $fillable = [
    	'desc',
    	'amount',
        'ppa_detail_id',
    	'employee_id',
        'unit_id',
    	'position_id'
    ];

    public function detail()
    {
        return $this->belongsTo('App\Models\Ppa\PpaDetail','ppa_detail_id');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Rekrutmen\Pegawai','employee_id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit','unit_id');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Models\Penempatan\Jabatan','position_id');
    }

    public function details()
    {
        return $this->hasMany('App\Models\Ppa\PpaProposalDetail','ppa_proposal_id');
    }

    public function getAmountWithSeparatorAttribute()
    {
        return number_format($this->amount, 0, ',', '.');
    }
}
