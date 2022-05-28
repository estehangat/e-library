<?php

namespace App\Http\Resources\Keuangan\Spp;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class LaporanSppSiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $bill_last = $this->siswa->sppBill()->latest()->first();
        
        if($bill_last->id == $this->id && $this->status=='0'){
            $id = Crypt::encrypt($this->id);
            $surat_url = route('spp.print',$id);
            $download_button = '<a href="'.$surat_url.'" target="_blank"><button class="m-0 btn btn-info btn-sm"><i class="fa fa-download"></i></button></a>';
        }else{
            $download_button = '';
        }

        return [
            $this->siswa->student_nis,
            $this->monthId,
            $this->siswa->identitas->student_name,
            number_format($this->spp_nominal),
            number_format($this->deduction_nominal),
            number_format($this->spp_paid),
            $this->status=='0'?'Belum':'Lunas',
            '<button class="m-0 btn btn-warning btn-sm" data-toggle="modal" data-target="#PotonganModal" data-id="'.$this->id.'" data-name="'.$this->siswa->identitas->student_name.'" data-nominal="'.$this->sppNominalWithSeparator.'" data-potongan="'.$this->deduction_id.'"><i class="fas fa-cogs"></i></button>'.$download_button,
            
        ];
    }
}
