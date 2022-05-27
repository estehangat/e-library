<?php

namespace App\Http\Services\Kbm;

use App\Models\Unit;

class UnitSelector {

    public static function listUnit()
    {
        $unit = auth()->user()->pegawai->unit_id;
        if($unit == 5){
            $lists = Unit::where('is_school',1)->get();
        } else{
            $lists = Unit::where('id',$unit)->get();
        }

        return $lists;

    }

}