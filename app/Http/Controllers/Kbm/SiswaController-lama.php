<?php

namespace App\Http\Controllers\Kbm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Kbm\Semester;

use App\Models\Siswa\OrangTua;
use App\Models\Siswa\Siswa;

use App\Models\Level;
use App\Models\Unit;
use App\Models\Wilayah;
use App\Models\Agama;
use App\Models\JenisKelamin;

use App\Http\Resources\Siswa\SiswaCollection;
use App\Http\Resources\Siswa\SiswaResource;

use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    
    public function index()
    {

        ini_set('max_execution_time', 0);
        $unit = Auth::user()->pegawai->unit_id;
        if($unit == 5){
            $siswas = Siswa::where('is_lulus',0)->with('identitas')->get()->sortBy('identitas.student_name');
            $levels = Level::all();
        }else{
            $siswas = Siswa::where('is_lulus',0)->where('unit_id',$unit)->with('identitas')->get()->sortBy('identitas.student_name');
            $levels = Level::where('unit_id',$unit)->get();
        }
        $level = 'semua';
        // dd(Auth::user()->pegawai->unit_id);
        return view('kbm.siswa.index',compact('siswas','levels','level'));
    }
    
    public function indexAlumni()
    {

        ini_set('max_execution_time', 0);
        $unit = Auth::user()->pegawai->unit_id;
        if($unit == 5){
            $siswas = Siswa::where('is_lulus',1)->with('identitas')->get()->sortBy('identitas.student_name');
            $levels = Level::all();
        }else{
            $siswas = Siswa::where('is_lulus',1)->where('unit_id',$unit)->with('identitas')->get()->sortBy('identitas.student_name');
            $levels = Level::where('unit_id',$unit)->get();
        }
        $level = 'semua';
        // dd(Auth::user()->pegawai->unit_id);
        return view('kbm.siswa.index',compact('siswas','levels','level'));
    }

    public function filter(Request $request)
    {
        if($request->level=='semua'){
            return redirect('/kependidikan/kbm/siswa');
        }
        $unit = Auth::user()->pegawai->unit_id;
        if($unit == 5){
            $levels = Level::all();
        }else{
            $levels = Level::where('unit_id',$unit)->get();
        }
        $level = $request->level;
        $siswas = Siswa::where('level_id',$level)->where('is_lulus',0)->with('identitas')->get()->sortBy('identitas.student_name');
        return view('kbm.siswa.index',compact('siswas','levels','level'));
    }

    public function filterAlumni(Request $request)
    {
        ini_set('max_execution_time', 0);
        if($request->level=='semua'){
            return redirect('/kependidikan/kbm/siswa/alumni');
        }
        $unit = Auth::user()->pegawai->unit_id;
        if($unit == 5){
            $levels = Level::all();
        }else{
            $levels = Level::where('unit_id',$unit)->get();
        }
        $level = $request->level;
        $siswas = Siswa::where('level_id',$level)->where('is_lulus',1)->with('identitas')->get()->sortBy('identitas.student_name');
        return view('kbm.siswa.index',compact('siswas','levels','level'));
    }
    
    public function create()
    {
        //
        $agamas = Agama::all();
        $levels = Level::all();
        $units = Unit::all();
        $jeniskelamin = JenisKelamin::all();
        $semesters = Semester::orderBy('semester_id', 'ASC')->get();
        $provinsis = Wilayah::whereRaw('LENGTH(code) = 2')->orderBy('name', 'ASC')->get();
        // dd($provinsis);
        return view('kbm.siswa.tambah',compact('provinsis','semesters','levels','agamas','jeniskelamin','units'));
    }
    
    public function store(Request $request)
    {
        //
        // dd($request);

        $request->validate([
            "nis" => "required",
            "nama" => "required",
            "nisn" => "required",
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required",
            "jenis_kelamin" => "required",
            "agama" => "required",
            "anak_ke" => "required",
            "status_anak" => "required",
            "alamat" => "required",
            "rt" => "required",
            "rw" => "required",
            "provinsi" => "required",
            "kabupaten" => "required",
            "kecamatan" => "required",
            "desa" => "required",
            "tanggal_masuk" => "required",
            "semester_masuk" => "required",
            "kelas" => "required",
            "asal_sekolah" => "required",
            "alamat_asal_sekolah" => "required",
        ]);
            
        // dd($request);
        $region = $request->desa;

        $orangTua = OrangTua::create([
            'employee_id' => $request->kode_pegawai,
            'father_name' => $request->nama_ayah,
            'father_nik' => $request->nik_ayah,
            'father_phone' => $request->hp_ayah,
            'father_email' => $request->email_ayah,
            'father_job' => $request->pekerjaan_ayah,
            'father_position'=> $request->jabatan_ayah, //jabatan ayah
            'father_phone_office' => $request->telp_kantor_ayah,
            'father_job_address'=> $request->alamat_kantor_ayah, //alamat kantor ayah
            'father_salary'=> $request->gaji_ayah, //gaji ayah

            'mother_nik' => $request->nik_ibu,
            'mother_name' => $request->nama_ibu,
            'mother_phone' => $request->hp_ibu,
            'mother_email' => $request->email_ibu,
            'mother_job' => $request->pekerjaan_ibu,
            'mother_position'=> $request->jabatan_ibu, //jabatan ibu
            'mother_phone_office' => $request->telp_kantor_ibu,
            'mother_job_address'=> $request->alamat_kantor_ibu, //alamat kantor ibu
            'mother_salary'=> $request->gaji_ibu, //gaji ibu

            'parent_address' => $request->alamat_ortu,
            'parent_phone_number' => $request->no_hp_ortu,

            'guardian_name' => $request->nama_wali,
            'guardian_nik' => $request->nik_wali,
            'guardian_phone_number' => $request->no_hp_wali,
            'guardian_email' => $request->email_wali,
            'guardian_job' => $request->pekerjaan_wali,
            'guardian_position'=> $request->jabatan_wali, //jabatan wali
            'guardian_phone_office' => $request->telp_kantor_wali,
            'guardian_job_address'=> $request->alamat_kantor_wali, //alamat kantor wali
            'guardian_salary'=> $request->gaji_wali, //gaji wali
            'guardian_address' => $request->alamat_wali,
        ]);

        $desa = Wilayah::where('code',$request->desa)->first();

        Siswa::create([
            'unit_id' => $request->unit,
            'student_nis' => $request->nis,
            'student_nisn' => $request->nisn,
            'student_name' => $request->nama,
            'student_nickname' => $request->nama_pendek,
            'reg_number' => $request->nomor_registrasi,

            'birth_place' => $request->tempat_lahir,
            'birth_date' => $request->tanggal_lahir,
            'gender_id' => $request->jenis_kelamin,
            'religion_id' => $request->agama,
            'child_of' => $request->anak_ke,
            'family_status' => $request->status_anak,
            
            'join_date' => $request->tanggal_masuk,
            'semester_id' => $request->semester_masuk,
            'level_id' => $request->kelas,
            'address' => $request->alamat,
            'address_number' => $request->no_rumah,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'region_id' => $desa->id,

            'origin_school' => $request->asal_sekolah,
            'origin_school_address' => $request->alamat_asal_sekolah,
            
            'sibling_name' => $request->saudara_nama,
            'sibling_level_id' => $request->saudara_kelas,

            'info_from' => $request->info_dari,
            'info_name' => $request->info_nama,
            'position' => $request->posisi,

            'parent_id' => $orangTua->id,
        ]);
        

        return redirect('/kependidikan/kbm/siswa')->with('sukses','Tambah Siswa Berhasil');
    }
    
    public function show($id)
    {
        //get data siswa
        $siswa = Siswa::with('identitas')->get()->find($id);
        
        if($siswa->identitas->region_id == null){
            $provinsi = null;
            $kabupaten = null;
            $kecamatan = null;
            $desa = null;
        }else{
            // dd($siswa);
            $desadata = Wilayah::find($siswa->identitas->region_id);
    
            //pisah kode wilayah
            $prov_id = substr($desadata->code,0,2);
            $kab_id = substr($desadata->code,0,5);
            $kec_id = substr($desadata->code,0,8);
    
            //init data wilayah siswa
            $provinsidata = Wilayah::where('code',$prov_id)->first();
            $kabupatensdata = Wilayah::where('code',$kab_id)->first();
            $kecamatandata = Wilayah::where('code',$kec_id)->first();

            // masuk ke variable baru
            $provinsi = $provinsidata->name;
            $kabupaten = $kabupatensdata->name;
            $kecamatan = $kecamatandata->name;
            $desa = $desadata->name;
        }


        $agamas = Agama::all();
        $levels = Level::all();
        $units = Unit::all();
        $jeniskelamin = JenisKelamin::all();
        $semesters = Semester::orderBy('semester_id', 'ASC')->get();
        $provinsis = Wilayah::whereRaw('LENGTH(code) = 2')->orderBy('name', 'ASC')->get();

        // dd($siswa->region_id);
        return view('kbm.siswa.lihat',compact('siswa','provinsi','kabupaten','kecamatan','desa','agamas','levels','units','semesters','provinsis'));
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
        //get data siswa
        $siswa = Siswa::with('identitas')->get()->find($id);
        
        if($siswa->identitas->region_id == null){
            $provinsi = null;
            $kabupaten = null;
            $kecamatan = null;
            $desa = null;
        
            // dropdown list wilayah
            $listprovinsi = Wilayah::whereRaw('LENGTH(code) = 2')->orderBy('name', 'ASC')->get();
            $listkabupaten = null;
            $listkecamatan = null;
            $listdesa = null;
        }else{
            // dd($siswa);
            $desadata = Wilayah::find($siswa->identitas->region_id);
    
            //pisah kode wilayah
            $prov_id = substr($desadata->code,0,2);
            $kab_id = substr($desadata->code,0,5);
            $kec_id = substr($desadata->code,0,8);
    
            //init data wilayah siswa
            $provinsidata = Wilayah::where('code',$prov_id)->first();
            $kabupatendata = Wilayah::where('code',$kab_id)->first();
            $kecamatandata = Wilayah::where('code',$kec_id)->first();

            // masuk ke variable baru
            $provinsi = $provinsidata->name;
            $kabupaten = $kabupatendata->name;
            $kecamatan = $kecamatandata->name;
            $desa = $desadata->name;
        
            // dropdown list wilayah
            $listprovinsi = Wilayah::whereRaw('LENGTH(code) = 2')->orderBy('name', 'ASC')->get();
            $listkabupaten = Wilayah::where('code','LIKE',$prov_id.'%')->whereRaw('LENGTH(code) = 5')->orderBy('name', 'ASC')->get();
            $listkecamatan = Wilayah::where('code','LIKE',$kab_id.'%')->whereRaw('LENGTH(code) = 8')->orderBy('name', 'ASC')->get();
            $listdesa = Wilayah::where('code','LIKE',$kec_id.'%')->whereRaw('LENGTH(code) = 13')->orderBy('name', 'ASC')->get();
        }

        //untuk dropdown
        $agamas = Agama::all();
        $levels = Level::all();
        $semesters = Semester::orderBy('semester_id', 'ASC')->get();
        $jeniskelamin = JenisKelamin::all();
        $units = Unit::all();

        // dd($listkabupaten);
        return view(
            'kbm.siswa.ubah',
            compact(
                'siswa',
                'provinsi',
                'kabupaten',
                'kecamatan',
                'desa',
                'listprovinsi',
                'listkabupaten',
                'listkecamatan',
                'listdesa',
                'agamas',
                'levels',
                'units',
                'semesters',
                'jeniskelamin'
            )
        );
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
        $request->validate([
            "nis" => "required",
            "nama" => "required",
            "nisn" => "required",
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required",
            "jenis_kelamin" => "required",
            "agama" => "required",
            "alamat" => "required",
            "rt" => "required",
            "rw" => "required",
            "provinsi" => "required",
            "kabupaten" => "required",
            "kecamatan" => "required",
            "desa" => "required",
            "semester_masuk" => "required",
            "kelas" => "required",
            "asal_sekolah" => "required",
        ]);

        $desa = Wilayah::where('code',$request->desa)->first();

        $siswa = Siswa::find($id);
        $idensis = $siswa->identitas;
        $parentid = $idensis->parent_id;
        $siswa->unit_id = $request->unit;
        $siswa->student_nis = $request->nis;
        $siswa->student_nisn = $request->nisn;
        $idensis->student_name = $request->nama;
        $idensis->student_nickname = $request->nama_pendek;
        $siswa->reg_number = $request->nomor_registrasi;

        $idensis->birth_place = $request->tempat_lahir;
        $idensis->birth_date = $request->tanggal_lahir;
        $idensis->gender_id = $request->jenis_kelamin;
        $idensis->religion_id = $request->agama;
        $idensis->child_of = $request->anak_ke;
        $idensis->family_status = $request->status_anak;
        
        $siswa->join_date = $request->tanggal_masuk;
        $siswa->semester_id = $request->semester_masuk;
        $siswa->level_id = $request->kelas;
        $idensis->address = $request->alamat;
        $idensis->address_number = $request->no_rumah;
        $idensis->rt = $request->rt;
        $idensis->rw = $request->rw;
        $idensis->region_id = $desa->id;

        $siswa->origin_school = $request->asal_sekolah;
        $siswa->origin_school_address = $request->alamat_asal_sekolah;
        
        $idensis->sibling_name = $request->saudara_nama;
        $idensis->sibling_level_id = $request->saudara_kelas;

        $siswa->info_from = $request->info_dari;
        $siswa->info_name = $request->info_nama;
        $siswa->position = $request->posisi;
        $siswa->save();
        $idensis->save();
        
        $ortu = OrangTua::find($parentid);
        $ortu->employee_id = $request->kode_pegawai;
        $ortu->father_name = $request->nama_ayah;
        $ortu->father_nik = $request->nik_ayah;
        $ortu->father_phone = $request->hp_ayah;
        $ortu->father_email = $request->email_ayah;
        $ortu->father_job = $request->pekerjaan_ayah;
        $ortu->father_position= $request->jabatan_ayah; //jabatan ayah
        $ortu->father_phone_office = $request->telp_kantor_ayah;
        $ortu->father_job_address= $request->alamat_kantor_ayah; //alamat kantor ayah
        $ortu->father_salary= $request->gaji_ayah; //gaji ayah

        $ortu->mother_nik = $request->nik_ibu;
        $ortu->mother_name = $request->nama_ibu;
        $ortu->mother_phone = $request->hp_ibu;
        $ortu->mother_email = $request->email_ibu;
        $ortu->mother_job = $request->pekerjaan_ibu;
        $ortu->mother_position= $request->jabatan_ibu; //jabatan ibu
        $ortu->mother_phone_office = $request->telp_kantor_ibu;
        $ortu->mother_job_address= $request->alamat_kantor_ibu; //alamat kantor ibu
        $ortu->mother_salary= $request->gaji_ibu; //gaji ibu

        $ortu->parent_address = $request->alamat_ortu;
        $ortu->parent_phone_number = $request->no_hp_ortu;

        $ortu->guardian_name = $request->nama_wali;
        $ortu->guardian_nik = $request->nik_wali;
        $ortu->guardian_phone_number = $request->no_hp_wali;
        $ortu->guardian_email = $request->email_wali;
        $ortu->guardian_job = $request->pekerjaan_wali;
        $ortu->guardian_position= $request->jabatan_wali; //jabatan wali
        $ortu->guardian_phone_office = $request->telp_kantor_wali;
        $ortu->guardian_job_address = $request->alamat_kantor_wali; //alamat kantor wali
        $ortu->guardian_salary = $request->gaji_wali; //gaji wali
        $ortu->guardian_address = $request->alamat_wali;
        $ortu->save();

        return redirect('/kependidikan/kbm/siswa')->with('sukses','Ubah Siswa Berhasil');
    }

    public function updateNisn(Request $request)
    {
        # code...
        $request->validate([
            "nisn" => "required",
        ]);

        $siswa = Siswa::find($request->id);

        $siswa->student_nisn = $request->nisn;

        $siswa->save();
        return redirect('/kependidikan/kbm/siswa')->with('sukses','Ubah Siswa Berhasil');

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
        $siswa = Siswa::find($id);
        // $kelas->delete();
        $siswa->is_lulus = 2;
        $siswa->save();
        return redirect('/kependidikan/kbm/siswa')->with('sukses','Hapus Siswa Berhasil!');
    }

    public function importView()
    {        
        // $ortu = OrangTua::where('father_nik','=','12')->first();
        // dd($ortu);
        return view('kbm.siswa.import');
    }

    public function import(Request $request) 
    {        

        ini_set('max_execution_time', 0);
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        // dd("masuk");
        // menangkap file excel
        $file = $request->file('file');
 
        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();
 
        // upload ke folder file_siswa di dalam folder public
        $file->move('file_siswa',$nama_file);
 
        // dd("masuk");
        // import data
        Excel::import(new SiswaImport, public_path('/file_siswa/'.$nama_file));
 
 
        // alihkan halaman kembali
        return redirect('/siswa/import')->with('sukses','Import Siswa Berhasil!');
    }


    public function newIndex()
    {

        ini_set('max_execution_time', 0);
        $unit = Auth::user()->pegawai->unit_id;
        if($unit == 5){
            $levels = Level::all();
        }else{
            $levels = Level::where('unit_id',$unit)->get();
        }
        $level = 'semua';
        // dd(Auth::user()->pegawai->unit_id);
        return view('kbm.siswa.new',compact('levels','level'));
    }

    public function onLoadIndex()
    {
        ini_set('max_execution_time', 0);
        $unit = Auth::user()->pegawai->unit_id;
        if($unit == 5){
            $siswas = Siswa::orderBy('id', 'ASC')->get();
        }else{
            $siswas = Siswa::orderBy('id', 'ASC')->where('unit_id',$unit)->get();
        }

        return response()->json($siswas);
    }

    public function test()
    {
        ini_set('max_execution_time', 0);
        $unit = Auth::user()->pegawai->unit_id;
        if($unit == 5){
            $siswas = Siswa::orderBy('id', 'ASC')->get();
        }else{
            $siswas = Siswa::orderBy('id', 'ASC')->where('unit_id',$unit)->get();
        }

        return new SiswaCollection($siswas);
    }
}
