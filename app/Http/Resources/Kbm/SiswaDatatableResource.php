<?php

namespace App\Http\Resources\Kbm;

use Illuminate\Http\Resources\Json\JsonResource;

class SiswaDatatableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $lihat = '<a href="../siswa/lihat/'.$this->id.'" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>&nbsp;';

        $ubah = '';
        if( in_array((auth()->user()->role_id), array(1,7,18,30,31))){
            $ubah = '<a href="../siswa/ubah/'.$this->id.'" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>&nbsp;';
        }

        $hapus = '';
        if( in_array((auth()->user()->role_id), array(1,2))){
            $hapus = '<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#HapusModal" data-siswa="'.$this->id.'" data-nama="'.$this->identitas->student_name.'"><i class="fas fa-trash"></i></a>';
        }

        return [
            $this->student_nis,
            $this->student_nisn,
            $this->identitas->student_name,
            $this->identitas->birth_date,
            $this->identitas->gender_id?ucwords($this->identitas->jeniskelamin->name):'',
            $lihat.''.$ubah.''.$hapus,
        ];
    }
}
