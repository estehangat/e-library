<?php

namespace App\Http\Controllers\Penilaian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

use Session;
use Jenssegers\Date\Date;

use App\Models\Kbm\Semester;
use App\Models\Kbm\MataPelajaran;
use App\Models\Kbm\Kelas;
use App\Models\Kbm\TahunAjaran;
use App\Models\Penilaian\AspekPerkembangan;
use App\Models\Penilaian\HafalanType;
use App\Models\Penilaian\NilaiRapor;
use App\Models\Penilaian\PredikatDeskripsi;
use App\Models\Penilaian\RaporPas;
use App\Models\Penilaian\RefIklas;
use App\Models\Penilaian\TanggalRapor;
use App\Models\Penilaian\TilawahType;
use App\Models\Siswa\Siswa;
use App\Models\Unit;

use function PHPUnit\Framework\isEmpty;

class PasController extends Controller
{
    public function cetakpas(Request $request)
    {
        $role = $request->user()->role->name;

        $employee_id = $request->user()->pegawai->id;
        $tahunsekarang = TahunAjaran::aktif()->first();
        $kelas = $tahunsekarang->kelas()->where('teacher_id', $employee_id)->first();
        $class_id = $kelas->id;
        $smt_aktif = session('semester_aktif');
        $semester = Semester::find($smt_aktif);
        $siswa = $kelas->riwayat()->select('student_id')->where('semester_id',$semester->id)->has('siswa')->with('siswa:id,student_id,unit_id')->get()->pluck('siswa')->sortBy(function($query){return $query->identitas->student_name;});
        if ($siswa->isEmpty()) {
            $nilairapor = FALSE;
        } else {
            foreach ($siswa as $key => $siswas) {
                $datarapor = $siswas->nilaiRapor()->where('semester_id', $semester->id)->first();
                if ($datarapor) {
                    $nilairapor[$key] = $datarapor;
                } else {
                    $nilairapor[$key] = FALSE;
                }
            }
        }

        return view('penilaian.walas.pas_index', compact('siswa', 'semester', 'kelas', 'nilairapor'));
    }

    /**
     * Print cover the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cover(Request $request, $id = null)
    {
        $role = $request->user()->role->name;

        $employee_id = $request->user()->pegawai->id;
        $semester = Semester::aktif()->first();
        $kelas = $semester->tahunAjaran->kelas()->where('teacher_id', $employee_id)->first();
        $siswa = $id ? $kelas->riwayat()->select('student_id')->where(['student_id'=>$id,'semester_id'=>$semester->id])->has('siswa')->first()->siswa : null;
        if($siswa) {
            $riwayatKelas = $kelas->riwayat()->select('class_id')->where(['student_id'=>$id,'semester_id'=>$semester->id])->first()->kelas;
            $unit = $riwayatKelas ? $riwayatKelas->unit : null;
            if($unit) {
                $rapor = $siswa->nilaiRapor()->where(['semester_id' => $semester->id, 'report_status_id' => 1])->first();

                if($rapor){
                    return view('penilaian.pas_cover', compact('siswa', 'unit', 'semester','riwayatKelas'));
                }
                else{
                    Session::flash('danger', 'Nilai rapor Ananda '.$siswa->identitas->student_name.' belum divalidasi');
                }
            }
        }

        return redirect()->route('pas.cetak');
    }

    /**
     * Print the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function laporan(Request $request, $id = null)
    {
        $role = $request->user()->role->name;

        $employee_id = $request->user()->pegawai->id;
        $semester = Semester::aktif()->first();
        $kelas = $semester->tahunAjaran->kelas()->where('teacher_id', $employee_id)->first();
        $siswa = $id ? $kelas->riwayat()->select('student_id')->where(['student_id'=>$id,'semester_id'=>$semester->id])->has('siswa')->first()->siswa : null;
        if($siswa) {
            $riwayatKelas = $kelas->riwayat()->select('class_id')->where(['student_id'=>$id,'semester_id'=>$semester->id])->first()->kelas;
            $unit = $riwayatKelas ? $riwayatKelas->unit : null;
            
            if($unit) {
                // Components
                $riwayatKelas = $kelas->riwayat()->select('class_id')->where(['student_id'=>$id,'semester_id'=>$semester->id])->first()->kelas;

                $iklas = RefIklas::select(['id','iklas_cat','iklas_no','competence','category'])->orderBy('iklas_cat','asc')->orderBy('iklas_no','asc')->get();
                $tilawah = TilawahType::whereNotNull('tilawah_ep')->get();
                $targetTahfidz = $unit->targetTahfidz()->where(['level_id' => $riwayatKelas->level_id, 'semester_id' => $semester->id])->pluck('target');
                $hafalan = HafalanType::all();

                $rapor = $siswa->nilaiRapor()->where('semester_id', $semester->id)->first();
                $pas_date = $semester->tanggalRapor()->where('unit_id', $unit->id)->pas()->first();
                $pas_date = $pas_date ? $pas_date->report_date : null;

                $kelompok_umum = $unit->kelompokMataPelajaran()->where('group_subject_name', 'like', 'kelompok%')->whereDoesntHave('jurusan')->get();
                if($riwayatKelas->major_id){
                    $kelompok_peminatan = $unit->kelompokMataPelajaran()->where('group_subject_name', 'like', 'kelompok%')->where('major_id', $siswa->kelas->major_id)->get();
                    $kelompok_master = $kelompok_umum->take(2);
                    $kelompok_lain = $kelompok_umum->skip(2);
                    $kelompok = $kelompok_master->concat($kelompok_peminatan)->concat($kelompok_lain);
                }
                else $kelompok = $kelompok_umum;

                // Digital Signature
                $digital = isset($request->digital) && $request->digital == 1 ? true : false;

                if($rapor){
                    return view('penilaian.pas_laporan', compact('pas_date', 'siswa', 'unit', 'semester', 'iklas', 'tilawah', 'targetTahfidz', 'hafalan', 'rapor', 'kelompok', 'digital'));
                }
                else{
                    Session::flash('danger', 'Nilai rapor Ananda '.$siswa->identitas->student_name.' belum ada');
                }
            }
        }

        return redirect()->route('pas.cetak');
    }

    public function laporantk(Request $request, $id = null)
    {
        $role = $request->user()->role->name;

        $employee_id = $request->user()->pegawai->id;
        $semester = Semester::aktif()->first();
        $kelas = $semester->tahunAjaran->kelas()->where('teacher_id', $employee_id)->first();
        $siswa = $id ? $kelas->riwayat()->select('student_id')->where(['student_id'=>$id,'semester_id'=>$semester->id])->has('siswa')->first()->siswa : null;
        if($siswa) {
            $riwayatKelas = $kelas->riwayat()->select('class_id')->where(['student_id'=>$id,'semester_id'=>$semester->id])->first()->kelas;
            $unit = $riwayatKelas ? $riwayatKelas->unit : null;
            
            if($unit) {
                // Components
                $aspek = AspekPerkembangan::aktif()->get();

                $rapor = $siswa->nilaiRapor()->where('semester_id', $semester->id)->first();

                $pas_date = $semester->tanggalRapor()->where('unit_id', $unit->id)->pas()->first();
                $pas_date = $pas_date ? $pas_date->report_date : null;

                // Digital Signature
                $digital = isset($request->digital) && $request->digital == 1 ? true : false;

                if($rapor){
                    return view('penilaian.pas_laporan_tk', compact('pas_date', 'siswa', 'unit', 'semester', 'rapor', 'aspek', 'digital'));
                }
                else{
                    Session::flash('danger', 'Nilai rapor Ananda '.$siswa->identitas->student_name.' belum ada');
                }
            }
        }

        return redirect()->route('pas.cetak');
    }

    /**
     * Print the last page of specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function akhir(Request $request, $id = null)
    {
        $role = $request->user()->role->name;

        $employee_id = $request->user()->pegawai->id;
        $semester = Semester::aktif()->first();
        $kelas = $semester->tahunAjaran->kelas()->where('teacher_id', $employee_id)->first();
        $siswa = $id ? $kelas->riwayat()->select('student_id')->where(['student_id'=>$id,'semester_id'=>$semester->id])->has('siswa')->first()->siswa : null;
        if($siswa) {
            $riwayatKelas = $kelas->riwayat()->select('class_id')->where(['student_id'=>$id,'semester_id'=>$semester->id])->first()->kelas;
            $unit = $riwayatKelas ? $riwayatKelas->unit : null;
            $rapor = $siswa->nilaiRapor()->where(['semester_id' => $semester->id, 'report_status_id' => 1])->first();
            if($rapor){
                return view('penilaian.pas_akhir', compact('siswa', 'unit'));
            }
            else{
                Session::flash('danger', 'Nilai rapor Ananda '.$siswa->identitas->student_name.' belum divalidasi');
            }
        }

        return redirect()->route('pas.cetak');
    }
}
