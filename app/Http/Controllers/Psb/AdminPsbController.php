<?php

namespace App\Http\Controllers\Psb;

use App\Http\Controllers\Controller;
use App\Http\Services\Psb\ListingCandidateStudent;
use App\Models\Kbm\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Level;
use App\Models\Psb\RegisterCounter;
use App\Models\Siswa\CalonSiswa;

use Jenssegers\Date\Date;

class AdminPsbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $unit = Auth::user()->pegawai->unit_id;
        if($unit == 5){
            $levels = Level::all();
        }else{
            $levels = Level::where('unit_id',$unit)->get();
        }
        $level = 'semua';

        return view('psb.admin.index',compact('levels','level'));
    }

    public function data($link)
    {
        //
        if($link == 'formulir-terisi'){
            $title = 'Formulir Terisi';
            $status_id = 1;
        }
        else if($link == 'saving-seat'){
            $title = 'Biaya Observasi';
            $status_id = 2;
        }
        else if($link == 'wawancara'){
            $title = 'Wawancara';
            $status_id = 3;
        }
        else if($link == 'diterima'){
            $title = 'Diterima';
            $status_id = 4;
        }
        else if($link == 'bayar-daftar-ulang'){
            $title = 'Bayar Daftar Ulang';
            $status_id = 5;
        }
        else if($link == 'dicadangkan'){
            $title = 'Dicadangkan';
            $status_id = 6;
        }
        else if($link == 'batal-daftar-ulang'){
            $title = 'Batal Daftar Ulang';
            $status_id = 7;
        }
        else if($link == 'peresmian-siswa'){
            $title = 'Peresmian Siswa';
            $status_id = 5;
        }
        else{
            return redirect('/kependidikan/psb/formulir-terisi');
        }
 

        $unit = Auth::user()->pegawai->unit_id;
        if($unit == 5){
            $levels = Level::all();
        }else{
            $levels = Level::where('unit_id',$unit)->get();
        }
        $level = 'semua';

        $unit_id = auth()->user()->pegawai->unit_id;
        if(auth()->user()->pegawai->unit_id  == 5){
            $calons = CalonSiswa::where('status_id',$status_id)->get();
        }else{
            $calons = CalonSiswa::where('status_id',$status_id)->where('unit_id',$unit_id)->get();
        }


        return view('psb.admin.index',compact('levels','level','title','calons','status_id','link'));
    }

    public function find($link, Request $request)
    {
        //
        if($link == 'formulir-terisi'){
            $title = 'Formulir Terisi';
            $status_id = 1;
        }
        else if($link == 'saving-seat'){
            $title = 'Biaya Observasi';
            $status_id = 2;
        }
        else if($link == 'wawancara'){
            $title = 'Wawancara';
            $status_id = 3;
        }
        else if($link == 'diterima'){
            $title = 'Diterima';
            $status_id = 4;
        }
        else if($link == 'bayar-daftar-ulang'){
            $title = 'Bayar Daftar Ulang';
            $status_id = 5;
        }
        else if($link == 'dicadangkan'){
            $title = 'Dicadangkan';
            $status_id = 6;
        }
        else if($link == 'batal-daftar-ulang'){
            $title = 'Batal Daftar Ulang';
            $status_id = 7;
        }
        else{
            return redirect('/kependidikan/psb/formulir-terisi');
        }


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
    public function bayarFormulir(Request $request)
    {
        //
        
    }

    public function wawancaraLink(Request $request)
    {
        //
        $calons = CalonSiswa::find($request->id);
        if(!$calons)return redirect()->back()->with('error', 'Kirim link wawancara gagal');

        $calons->interview_type = $request->tipe_wawancara;
        if($request->tipe_wawancara == 1){
            $calons->link = $request->link;
        }else{
            $calons->link = null;
        }
        $calons->interview_date = $request->interview_date;
        $calons->interview_time = $request->interview_time;
        // $calons->observation_link = $request->observation_link;
        // $calons->observation_date = $request->observation_date;
        // $calons->observation_time = $request->observation_time;
        $calons->save();

        return redirect()->back()->with('success', 'Kirim link wawancara berhasil');

    }

    public function wawancaraDone(Request $request)
    {
        //
        // dd($request);
        $calons = CalonSiswa::find($request->id);
        if(!$calons) return redirect()->back()->with('error', 'Penerimaan gagal');

        $calons->status_id = 4;
        $calons->acc_employee_id = $request->user()->pegawai->id;
        $calons->acc_time = Date::now('Asia/Jakarta');
        $calons->save();
        
        $calons->fresh();

        $counter = RegisterCounter::where('unit_id',$calons->unit_id)->where('academic_year_id',$calons->academic_year_id)->first();

        if($calons->origin_school == 'SIT Auliya'){
            $counter->accepted_intern = $counter->accepted_intern + 1;
            $counter->save();
        }else{
            $counter->accepted_extern = $counter->accepted_extern + 1;
            $counter->save();
        }

        return redirect()->back()->with('success', 'Penerimaan berhasil');
    }
    
    public function diterima(Request $request)
    {
        //
        $calons = CalonSiswa::find($request->id);
        if(!$calons)return redirect()->back()->with('error', 'Penerimaan siswa gagal');

        $calons->status_id = 4;
        $calons->save();
        
        $calons->fresh();
        
        $counter = RegisterCounter::where('unit_id',$calons->unit_id)->where('academic_year_id',$calons->academic_year_id)->first();

        if($calons->origin_school == 'SIT Auliya'){
            $counter->accepted_intern = $counter->accepted_intern + 1;
            $counter->save();
        }else{
            $counter->accepted_extern = $counter->accepted_extern + 1;
            $counter->save();
        }
        
        return redirect()->back()->with('success', 'Calon siswa berhasil diterima');

    }

    public function dicadangkan(Request $request)
    {
        //
        $calons = CalonSiswa::find($request->id);
        if(!$calons)return redirect()->back()->with('error', 'Pencadangan calon siswa gagal');

        $calons->status_id = 6;
        $calons->save();
        
        $calons->fresh();
        
        $counter = RegisterCounter::where('unit_id',$calons->unit_id)->where('academic_year_id',$calons->academic_year_id)->first();
        if($counter){
            if($calons->origin_school == 'SIT Auliya'){
                $counter->reserved_intern = $counter->reserved_intern + 1;
                $counter->save();
            }else{
                $counter->reserved_extern = $counter->reserved_extern + 1;
                $counter->save();
            }
        }else{
            if($calons->origin_school == 'SIT Auliya'){
                // dd($counter);
                $counter = RegisterCounter::create([
                    'academic_year_id' => $calons->academic_year_id,
                    'unit_id' => $calons->unit_id,
                    'reserved_intern' => 1,
                ]);
            }else{
                $counter = RegisterCounter::create([
                    'academic_year_id' => $calons->academic_year_id,
                    'unit_id' => $calons->unit_id,
                    'reserved_extern' => 1,
                ]);
            }

        }

        return redirect()->back()->with('success', 'Calon siswa berhasil dicadangkan');

    }

    public function bayarDaftarUlang(Request $request)
    {
        //

    }

    public function batalDaftarUlang(Request $request)
    {
        //
        $calons = CalonSiswa::find($request->id);
        // dd($request->id);
        if(!$calons)return redirect()->back()->with('error', 'Pembatalan bayar daftar ulang gagal');

        $calons->status_id = 7;
        $calons->save();
        
        $calons->fresh();

        $counter = RegisterCounter::where('unit_id',$calons->unit_id)->where('academic_year_id',$calons->academic_year_id)->first();

        if($calons->origin_school == 'SIT Auliya'){
            $counter->canceled_intern = $counter->canceled_intern + 1;
            $counter->save();
        }else{
            $counter->canceled_extern = $counter->canceled_extern + 1;
            $counter->save();
        }
        
        return redirect()->back()->with('success', 'Bayar daftar ulang berhasil dibatalkan');

    }

    public function formulirTerisi(Request $request)
    {
        $link = 'formulir-terisi';
        $title = 'Formulir Terisi';
        $status_id = 1;

        $calons = ListingCandidateStudent::list($request->level, $request->year, $status_id);

        return view('psb.admin.index',compact('title','calons','status_id','link','request'));
    }

    public function formulirTerisiFind(Request $request)
    {
        $link = 'formulir-terisi';
        $title = 'Formulir Terisi';
        $status_id = 1;
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

    public function linkDiterima(Request $request)
    {
        $link = 'diterima';
        $title = 'Diterima';
        $status_id = 4;
        $calons = ListingCandidateStudent::list($request->level, $request->year, $status_id);

        return view('psb.admin.index',compact('title','calons','status_id','link','request'));
    }

    public function linkDiterimaFind(Request $request)
    {
        $link = 'diterima';
        $title = 'Diterima';
        $status_id = 4;
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
    
    public function linkDicadangkan(Request $request)
    {
        $link = 'dicadangkan';
        $title = 'Dicadangkan';
        $status_id = 6;
        $calons = ListingCandidateStudent::list($request->level, $request->year, $status_id);


        return view('psb.admin.index',compact('title','calons','status_id','link','request'));
    }

    public function linkDicadangkanFind(Request $request)
    {
        $link = 'dicadangkan';
        $title = 'Dicadangkan';
        $status_id = 6;
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

    public function linkBatalDaftarUlang(Request $request)
    {
        $link = 'batal-daftar-ulang';
        $title = 'Batal Daftar Ulang';
        $status_id = 7;
        $calons = ListingCandidateStudent::list($request->level, $request->year, $status_id);

        return view('psb.admin.index',compact('title','calons','status_id','link','request'));
    }

    public function linkBatalDaftarUlangFind(Request $request)
    {
        $link = 'batal-daftar-ulang';
        $title = 'Batal Daftar Ulang';
        $status_id = 7;
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

    public function linkPeresmianSiswa(Request $request)
    {
        $link = 'peresmian-siswa';
        $title = 'Peresmian Siswa';
        $status_id = 5;
        $calons = ListingCandidateStudent::list($request->level, $request->year, $status_id);

        return view('psb.admin.index',compact('title','calons','status_id','link','request'));
    }

    public function linkPeresmianSiswaFind(Request $request)
    {
        $link = 'peresmian-siswa';
        $title = 'Peresmian Siswa';
        $status_id = 5;
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

    public function chart(Request $request)
    {

        $data = array();
        $year_list = TahunAjaran::orderBy('academic_year_start','DESC')->get();
        // dd($year_list);

        if($request->year){
            $year = $request->year;
            $unit_id = $request->unit_id?$request->unit_id:auth()->user()->pegawai->unit_id;
            $type = $request->type;
            $data = $this->getCounter($unit_id,$year,$type);
        }else{
            $year_selected = TahunAjaran::aktif()->first();
            $year = $year_selected->id;
            $type = 1;
            if(auth()->user()->pegawai->unit_id == 5){
                $unit_id = 1;
            }else{
                $unit_id = auth()->user()->pegawai->unit_id;
            }
            $data = $this->getCounter($unit_id,$year,1);
        }
        
        return view('psb.admin.chart',compact('data','year_list','year','unit_id','type'));
    }

    public function getCounter($unit, $year, $asal)
    {
        $data = array();

        $list = RegisterCounter::where('unit_id',$unit)->where('academic_year_id',$year)->first();
        // $list = RegisterCounter::where('unit_id',4)->where('academic_year_id',7)->first();

        if($list){
            // dd($list);
            if($asal == 1){
                $data = [
                    $list->register_intern,
                    $list->saving_seat_intern,
                    $list->interview_intern,
                    $list->accepted_intern,
                    $list->reapply_intern,
                ];
            }else{
                $data = [
                    $list->register_extern,
                    $list->saving_seat_extern,
                    $list->interview_extern,
                    $list->accepted_extern,
                    $list->reapply_extern,
                ];
            }
        }else{
            $data = [
                0,
                0,
                0,
                0,
                0,
            ];
        }
        return $data;
    }

}
