<?php

namespace App\Http\Controllers\Psb\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Psb\ListingCandidateStudent;
use App\Models\Kbm\TahunAjaran;
use App\Models\Level;
use App\Models\Pembayaran\BmsNominal;
use App\Models\Psb\RegisterCounter;
use App\Models\Siswa\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SavingSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $link = 'saving-seat';
        $title = 'Biaya Observasi';
        $status_id = 2;
        $calons = ListingCandidateStudent::list($request->level, $request->year, $status_id);

        return view('psb.admin.index',compact('title','calons','status_id','link','request'));
    }
    
    public function savingSeatFind(Request $request)
    {
        $link = 'saving-seat';
        $title = 'Biaya Observasi';
        $status_id = 2;
        $unit = Auth::user()->pegawai->unit_id;
        if($unit == 5){
            $levels = Level::all();
        }else{
            $levels = Level::where('unit_id',$unit)->get();
        }
        $level = 'semua';

        $unit_id = auth()->user()->pegawai->unit_id;
        if($request->level == 'semua'){
            if(auth()->user()->pegawai->unit_id  == 5){
                $calons = CalonSiswa::where('status_id',$status_id)->get();
            }else{
                $calons = CalonSiswa::where('status_id',$status_id)->where('unit_id',$unit_id)->get();
            }
        }else{
            $level = $request->level;
            if(auth()->user()->pegawai->unit_id  == 5){
                $calons = CalonSiswa::where('status_id',$status_id)->where('level_id',$request->level)->get();
            }else{
                $calons = CalonSiswa::where('status_id',$status_id)->where('unit_id',$unit_id)->where('level_id',$request->level)->get();
            }
        }


        return view('psb.admin.index',compact('levels','level','title','calons','status_id','link'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $calons = CalonSiswa::find($request->id);
        // dd($request);
        if(!$calons)return redirect()->back()->with('error', 'Calon siswa gagal dimasukan ke biaya observasi');

        $calons->status_id = 2;
        $calons->save();
        
        $counter = RegisterCounter::where('unit_id',$calons->unit_id)->where('academic_year_id',$calons->academic_year_id)->first();
        if($counter){
            if($calons->origin_school == 'SIT Auliya'){
                $counter->saving_seat_intern = $counter->saving_seat_intern + 1;
                $counter->save();
            }else{
                $counter->saving_seat_extern = $counter->saving_seat_extern + 1;
                $counter->save();
            }
        }else{
            if($calons->origin_school == 'SIT Auliya'){
                // dd($counter);
                $counter = RegisterCounter::create([
                    'academic_year_id' => $calons->academic_year_id,
                    'unit_id' => $calons->unit_id,
                    'saving_seat_intern' => 1,
                ]);
            }else{
                $counter = RegisterCounter::create([
                    'academic_year_id' => $calons->academic_year_id,
                    'unit_id' => $calons->unit_id,
                    'saving_seat_extern' => 1,
                ]);
            }

        }

        return redirect()->back()->with('success', 'Calon siswa berhasil dimasukan ke biaya observasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $data = BmsNominal::where('bms_type_id',$request->type_pembayaran)->where('unit_id',$request->unit_bms)->first();
        // dd($data->bms_nominal);

        return $data->bms_nominal;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
