<?php

namespace App\Http\Controllers\Keuangan\Pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Kbm\TahunAjaran;
use Illuminate\Http\Request;

use App\Models\Level;
use App\Models\Pembayaran\BMS;
use App\Models\Pembayaran\BmsPlan;
use App\Models\Pembayaran\BmsTermin;
use App\Models\Pembayaran\BmsTransaction;
use App\Models\Pembayaran\Spp;
use App\Models\Pembayaran\SppBill;
use App\Models\Pembayaran\SppPlan;
use App\Models\Pembayaran\SppTransaction;
use App\Models\Unit;
use stdClass;

class BmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $unit_id = auth()->user()->pegawai->unit_id;
        $unit = 'Semua';
        if($unit_id == 5){
            $levels = Level::all();
            $lists = BMS::orderBy('unit_id','asc')->get();
        }else{
            $lists = BMS::where('unit_id',$unit_id)->orderBy('student_id','asc')->get();
            $levels = Level::where('unit_id',$unit_id);
        }
        $level = 'semua';
        $tahun_aktif = TahunAjaran::where('is_active',1)->first();

        return view('keuangan.pembayaran.bms.index', compact('lists','levels','level','unit_id','unit','tahun_aktif'));
    }

    public function rencana()
    {
        $unit_id = auth()->user()->pegawai->unit_id;
        $unit = 'Semua';
        if($unit_id == 5){
            $levels = Level::all();
        }else{
            $levels = Level::where('unit_id',$unit_id);
        }
        $level = 'semua';
        return view('keuangan.pembayaran.bms.rencana', compact('levels','level','unit','unit_id'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function log()
    {
        //
        $levels = Level::all();
        $level = 'semua';
        return view('keuangan.pembayaran.bms.log', compact('levels','level'));
    }

    public function LaporanSiswa()
    {
        //
        $levels = Level::all();
        $level = 'semua';
        return view('keuangan.pembayaran.bms.laporan.siswa', compact('levels','level'));
    }

    public function LaporanMasukan(Request $request)
    {
        //
        $unit_id = auth()->user()->pegawai->unit_id;
        $unit = 'Semua';

        if($request->tahun){
            $year = $request->tahun;
        }else{
            $year = date("Y");
        }

        if($request->bulan){
            $month = $request->bulan;
            if($unit_id == 5){
                $lists = BmsTransaction::orderBy('created_at','desc')->where('month',$month)->where('year',$year)->get();
                $units = Unit::all();
            }else{
                $lists = BmsTransaction::where('unit_id',$unit_id)->orderBy('created_at','desc')->where('year',$year)->where('month',$month)->get();
                $units = Unit::find(auth()->user()->pegawai->unit_id);
            }
        }else{
            $month = null;
            if($unit_id == 5){
                $lists = BmsTransaction::orderBy('created_at','desc')->where('year',$year)->get();
                $units = Unit::all();
            }else{
                $lists = BmsTransaction::where('unit_id',$unit_id)->orderBy('created_at','desc')->where('year',$year)->get();
                $units = Unit::find(auth()->user()->pegawai->unit_id);
            }
        }
        $tahun_akademik_aktif = TahunAjaran::where('is_active',1)->first();
        if($unit_id == 5){
            $plan_list = BmsPlan::where('academic_year_id',$tahun_akademik_aktif->id)->get();
            $plan = new stdClass;
            $plan->total_plan = 0;
            $plan->total_get = 0;
            $plan->total_student = 0;
            $plan->student_remain = 0;
            $plan->remain = 0;
            $plan->percent = 0;
            foreach($plan_list as $pl){
                $plan->total_plan += $pl->total_plan;
                $plan->total_get += $pl->total_get;
                $plan->total_student += $pl->total_student;
                $plan->student_remain += $pl->student_remain;
                $plan->remain += $pl->remain;
                $plan->percent = ($plan->student_remain / $plan->total_student)*100;
            }
        }else{
            $plan = BmsPlan::where('academic_year_id',$tahun_akademik_aktif->id)->where('unit_id',$unit_id)->first();
        }
        $year_now = date("Y");
        $years = array();
        $year_increment = 2019;
        while($year_increment <= $year_now){
            $year_obj = new stdClass();
            $year_obj->year=$year_increment;
            array_push($years,$year_obj);
            $year_increment+=1;
        }

        $academic_year = TahunAjaran::orderBy('academic_year_start','desc')->get();

        return view('keuangan.pembayaran.bms.laporan.masukan', compact('lists','unit','units','unit_id','academic_year','years','year','month','plan'));
    }

    public function bmsToSpp(Request $request)
    {
        // dd($request);
        $bms_trx = BmsTransaction::find($request->id);
        if(!$bms_trx){
            return redirect()->back()->with('error','Pemindahan Gagal');
        }
        $nominal = $bms_trx->nominal;
        $student_id = $bms_trx->student_id;
        
        $bms = BMS::where('student_id',$student_id)->first();
        if($bms->bms_remain == 0){
            if($bms->bms_paid + $bms->bms_deduction > $bms->bms_nominal){
                $saldo = $bms->bms_paid + $bms->bms_deduction - $bms->bms_nominal;
                $bms_nominal_return = $nominal - $saldo;
            }else{
                $bms_nominal_return = $nominal;
            }
        }else{
            $bms_nominal_return = $nominal;
        }

        $bms->bms_remain += $bms_nominal_return;
        $bms->bms_paid -= $nominal;
        $bms->save();

        $bms_termins = BmsTermin::where('bms_id',$bms->id)->orderBy('academic_year_id','desc')->get();
        foreach($bms_termins as $termin){
            if($bms_nominal_return > 0){

                $bms_plan = BmsPlan::where('unit_id',$bms->unit_id)->where('academic_year_id',$termin->academic_year_id)->first();
                if($termin->remain == 0) $bms_plan->student_remain += 1;

                $paid = $termin->nominal - $termin->remain;

                if($bms_nominal_return > $paid){
                    
                    $bms_plan->total_get -= $paid;
                    $bms_plan->remain += $paid;

                    $bms_nominal_return -= $paid;
                    $termin->remain += $paid;


                }else{

                    $bms_plan->total_get -= $bms_nominal_return;
                    $bms_plan->remain += $bms_nominal_return;

                    $termin->remain += $bms_nominal_return;
                    $bms_nominal_return = 0;

                }
                $termin->save();
                $bms_plan->save();

            }
        }



        $nominal = $nominal;

        $spp_trx = SppTransaction::create([
            'unit_id' => $bms_trx->unit_id,
            'student_id' => $bms_trx->student_id,
            'month' => $bms_trx->month,
            'year' => $bms_trx->year,
            'nominal' => $bms_trx->nominal,
            'academic_year_id' => $bms_trx->academic_year_id,
            'trx_id' => $bms_trx->trx_id,
            'date' => $bms_trx->date,
        ]);

        $spp_trx->created_at = $bms_trx->created_at;
        $spp_trx->save();

        $spp = Spp::where('student_id',$spp_trx->student_id)->first();

        if($spp->remain == 0){

            $spp->saldo = $spp->saldo + $nominal;
            $spp->save();

        }else{

            $spp_bills = SppBill::where('student_id',$spp_trx->student_id)->where('status',0)->orderBy('month','asc')->orderBy('year','asc')->get();

            $transfered = $nominal;

            foreach($spp_bills as $bill){

                if($nominal > 0){

                    $plan = SppPlan::where('unit_id',$bill->unit_id)->where('month',$bill->month)->where('year',$bill->year)->first();
                    
                    
                    $remaining = $bill->spp_nominal - ($bill->deduction_nominal + $bill->spp_paid);
                    if($nominal >= $remaining){
                        $bill->spp_paid = $bill->spp_nominal - $bill->deduction_nominal;
                        $bill->status = 1;
                        $bill->save();
                        
                        $nominal = $nominal - $remaining;
                        
                        $plan->total_get = $plan->total_get + $remaining;
                        $plan->remain = $plan->remain - $remaining;
                        $plan->student_remain -= 1;
                        $plan->percent = ($plan->student_remain / $plan->total_student) * 100; 
                        $plan->save();
                    }else{
                        $bill->spp_paid = $bill->spp_paid + $nominal;
                        $bill->status = 0;
                        $bill->save();
                        
                        $plan->total_get = $plan->total_get + $nominal;
                        $plan->remain = $plan->remain - $nominal;
                        $plan->save();
                        
                        $nominal = 0;

                    }
                }
            }
            if($nominal == 0){
                $spp->remain = $spp->remain - $transfered;
                $spp->paid = $spp->paid + $transfered;
                $spp->save();
            }else{
                $spp->remain = 0;
                $spp->paid = $spp->paid + ($transfered - $nominal);
                $spp->saldo = $spp->saldo + $nominal;
                $spp->save();
            }
        }

        $bms_trx->delete();

        return redirect()->back()->with('success','Pemindahan Berhasil');
    }
}
