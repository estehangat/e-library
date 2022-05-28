<?php

namespace App\Http\Controllers\Kbm;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

Use App\Models\Skbm\Skbm;
use App\Models\Kbm\KelompokMataPelajaran;
use App\Models\Kbm\MataPelajaran;
use App\Models\Kbm\KkmPelajaran;
use App\Models\Kbm\MapelKelas;
use App\Models\Kbm\Semester;
use App\Models\Jurusan;
use App\Models\Level;
use App\Models\Rekrutmen\Pegawai;

class PelajaranController extends Controller
{
    public function index()
    {
        $unit = Auth::user()->pegawai->unit_id;
        if(Auth::user()->role_id == 5){
            $employee = Auth::user()->user_id;
            $skbm = Skbm::aktif()->where('unit_id',$unit)->first();
            // dd(Auth::user()->pegawai());
            $mapellist = $skbm->detail->where('employee_id', $employee);
            // dd($mapellist);
            // if()
            
        }else{
            // memanggil semua mapel
            if($unit == 5){
                $mapellist = MataPelajaran::all();
            }else{
                $mapellist = MataPelajaran::where('unit_id',$unit)->get();
            }
        }

        // inisialisasi
        $smsaktif = Semester::where('is_active',1)->first();
        $kkm = [];
        foreach($mapellist as $index => $mapel){
            if(Auth::user()->role_id == 5){
                $checkkkm = KkmPelajaran::where('subject_id',$mapel->subject_id)->where('semester_id',$smsaktif->id)->first();
            }
            else{
                $checkkkm = KkmPelajaran::where('subject_id',$mapel->id)->where('semester_id',$smsaktif->id)->first();   
            }
            if($checkkkm){
                $kkm[$index] = $checkkkm->kkm;
            }else{
                $kkm[$index] = 'Belum diatur';
            }
        }
        // dd($mapellist[0]);

        return view('kbm.matapelajaran.index',compact('mapellist','unit','kkm','smsaktif'));
    }

    public function create()
    {
        $unit = Auth::user()->pegawai->unit_id;
        // menampilkan form tambah
        $kmplists = kelompokMataPelajaran::where('unit_id',$unit)->get();
        $levels = Level::where('unit_id',$unit)->get();
        return view('kbm.matapelajaran.tambah',compact('kmplists','unit','levels'));
    }

    public function store(Request $request)
    {
        // dd($request);

        $unit = Auth::user()->pegawai->unit_id;

        // validate dari form tambah
        if($unit == 1){
            $request->validate([
                'nama_mapel' => 'required',
                'kmp_id' => 'required',
            ]);
            // create to table
            MataPelajaran::create([
                'subject_name' => $request->nama_mapel,
                'subject_acronym' => $request->kode_mapel,
                'group_subject_id' => $request->kmp_id,
                'unit_id' => $unit,
            ]);
        }else{
            $request->validate([
                'nama_mapel' => 'required',
                'nomor_mapel' => 'required',
                'kmp_id' => 'required',
                'kkm' => 'required',
            ]);

            if($request->kkm <= 50){
                return redirect()->back()->with('error', 'KKM Harus Lebih Dari 50');
            }

            // create to table
            $mapel = MataPelajaran::create([
                'subject_number' => $request->nomor_mapel,
                'subject_name' => $request->nama_mapel,
                'subject_code' => $request->kode_mapel,
                'group_subject_id' => $request->kmp_id,
                'kkm' => $request->kkm,
                'unit_id' => $unit,
                'is_mulok' => $request->mulok
            ]);

            // check semester yg sedang aktif
            $smsaktif = Semester::where('is_active',1)->first();

            // create to kkm table
            $kkm = KkmPelajaran::create([
                'subject_id' => $mapel->id,
                'kkm' => $mapel->kkm,
                'semester_id' => $smsaktif->id,
            ]);
            if($unit == 2){
                $kelases = $request->input('kelas');
                foreach($kelases as $kelas){
                    MapelKelas::create([
                        'level_id' => $kelas,
                        'subject_id' => $mapel->id
                    ]);
                }
            }
        }


        return redirect('/kependidikan/kbm/pelajaran/mata-pelajaran')->with('sukses','Tambah Mata Pelajaran Berhasil');
    }

    public function edit($id)
    {
        $unit = Auth::user()->pegawai->unit_id;
        // menampilkan form terisi data yang akan diubah
        $kmplists = kelompokMataPelajaran::where('unit_id',$unit)->get();
        $unit = Auth::user()->pegawai->unit_id;
        $mapel = MataPelajaran::find($id);
        $levels = Level::where('unit_id',$unit)->get();
        $mapellevels = MapelKelas::where('subject_id',$id)->pluck('level_id');

        // check semester yg sedang aktif
        $smsaktif = Semester::where('is_active',1)->first();

        // KKM
        $checkkkm = KkmPelajaran::where('subject_id',$id)->where('semester_id',$smsaktif->id)->first();
        if($checkkkm){
            $kkm = $checkkkm->kkm;
        }else{
            $kkm = null;
        }

        // dd($mapellevels);
        return view('kbm.matapelajaran.ubah',compact('kmplists','mapel','unit','levels','mapellevels','kkm'));
    }

    public function update($id, Request $request)
    {
        $unit = Auth::user()->pegawai->unit_id;

        // validate dari form tambah
        if(Auth::user()->role_id == 5){
            $request->validate([
                'kkm' => 'required',
            ]);            

            if($request->kkm <= 50){
                return redirect()->back()->with('error', 'KKM Harus Lebih Dari 50');
            }

            $mapel = MataPelajaran::find($id);
            $mapel->kkm = $request->kkm;
            $mapel->save();

            // check semester yg sedang aktif
            $smsaktif = Semester::where('is_active',1)->first();

            // KKM
            $kkm = KkmPelajaran::where('subject_id',$mapel->id)->where('semester_id',$smsaktif->id)->first();
            
            // cek ada engga
            if($kkm){
                $kkm->kkm = $mapel->kkm;
                $kkm->save();
            }else{
                // create to kkm table
                $kkm = KkmPelajaran::create([
                    'subject_id' => $mapel->id,
                    'kkm' => $mapel->kkm,
                    'semester_id' => $smsaktif->id,
                ]);
            }

        }else if($unit == 1){
            $request->validate([
                'kmp_id' => 'required',
            ]);            
            $mapel = MataPelajaran::find($id);
            $mapel->group_subject_id = $request->kmp_id;
            $mapel->save();
        }else{
            // dd($request);
            $request->validate([
                'nomor_mapel' => 'required',
                'kmp_id' => 'required',
                'kkm' => 'required',
            ]);

            if($request->kkm <= 50){
                return redirect()->back()->with('error', 'KKM Harus Lebih Dari 50');
            }
            
            $mapel = MataPelajaran::find($id);
            $mapel->subject_number = $request->nomor_mapel;
            $mapel->group_subject_id = $request->kmp_id;
            $mapel->kkm = $request->kkm;
            $mapel->save();

            // check semester yg sedang aktif
            $smsaktif = Semester::where('is_active',1)->first();

            // KKM
            $kkm = KkmPelajaran::where('subject_id',$mapel->id)->where('semester_id',$smsaktif->id)->first();
            // cek ada engga
            if($kkm){
                $kkm->kkm = $mapel->kkm;
                $kkm->save();
            }else{
                // create to kkm table
                $kkm = KkmPelajaran::create([
                    'subject_id' => $mapel->id,
                    'kkm' => $mapel->kkm,
                    'semester_id' => $smsaktif->id,
                ]);
            }

            if($unit == 2){
                MapelKelas::where('subject_id',$id)->delete();

                $kelases = $request->input('kelas');
                foreach($kelases as $kelas){
                    MapelKelas::create([
                        'level_id' => $kelas,
                        'subject_id' => $id
                    ]);
                }
            }

        }

        return redirect('/kependidikan/kbm/pelajaran/mata-pelajaran')->with('sukses','Ubah Mata Pelajaran Berhasil');
    }

    public function destroy($id)
    {
        // menghapus data yang dipilih
    	$mapel = MataPelajaran::find($id);
        $mapel->delete();
        
        return redirect('/kependidikan/kbm/pelajaran/mata-pelajaran')->with('sukses','Hapus Mata Pelajaran Berhasil');
    }

    // BAGIAN KELOMPOK MATA PELAJARAN
    // MOVE CONTROLLER SOON
    
    // Daftar Kelompok Mata Pelajaran
    public function kelompokMataPelajaran()
    {
        //
        $unit = Auth::user()->pegawai->unit_id;
        if($unit == 5){
            $lists = kelompokMataPelajaran::all();
        }else{
            $lists = kelompokMataPelajaran::where('unit_id',$unit)->get();
        }
        $jurusans = Jurusan::all();
        return view('kbm.kelompokmatapelajaran.index',compact('lists','jurusans'));
    }

    public function kelompokMataPelajaranTambah()
    {
        //
        $jurusans = Jurusan::all();
        return view('kbm.kelompokmatapelajaran.tambah',compact('jurusans'));
    }
    
    public function kelompokMataPelajaranStore(Request $request)
    {
        // Validate
        $request->validate([
            'kelompok' => 'required',
        ]);

        $unit = Auth::user()->pegawai->unit_id;
        // create to table
        $kmp = kelompokMataPelajaran::create([
            'group_subject_name' => $request->kelompok,
            'unit_id' => $unit,
            'major_id' => $request->jurusan,
        ]);
        // dd($kmp);

        // return with create success notification
        return redirect('/kependidikan/kbm/pelajaran/kelompok-mata-pelajaran')->with('sukses','Tambah Kelompok Mata Pelajaran Berhasil');
    }
    
    public function kelompokMataPelajaranHapus($id)
    {
        // destroy
    	$kmp = kelompokMataPelajaran::find($id);
    	$kmp->delete();

        // return with destroy success notification
        return redirect('/kependidikan/kbm/pelajaran/kelompok-mata-pelajaran')->with('sukses','Hapus Kelompok Mata Pelajaran Berhasil');
    }
    
    public function kelompokMataPelajaranUbah($id, Request $request)
    {
        // Validate
        // dd($request);
        $request->validate([
            'kelompok' => 'required',
        ]);

        // update kelompok mata pelajaran
    	$kmp = kelompokMataPelajaran::find($id);
        $kmp->group_subject_name = $request->kelompok;
        $kmp->major_id = $request->jurusan;
        $kmp->save();

        // update success notification
        return redirect('/kependidikan/kbm/pelajaran/kelompok-mata-pelajaran')->with('sukses','Ubah Kelompok Mata Pelajaran Berhasil');
    }
}
