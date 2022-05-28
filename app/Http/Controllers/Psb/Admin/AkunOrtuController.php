<?php

namespace App\Http\Controllers\Psb\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;

use App\Models\Siswa\OrangTua;
use App\Models\Unit;

class AkunOrtuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->template = 'psb.admin.ortu';
        $this->active = 'Orang Tua';
        $this->route = 'kependidikan.psb.ortu';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = $request->user()->role->name;

        $data = OrangTua::select('id','father_name','mother_name','guardian_name')->where(function($q){
            $q->where(function($q){
                $q->whereHas('user',function($q){
                    $q->where('role_id',36);
                });
            })->orWhere(function($q){
                $q->has('pegawai')->whereHas('user',function($q){
                    $q->where('role_id','!=',36);
                });
            });
        })->latest()->take(50)->get();
        // if($request->user()->pegawai->unit->name != 'Manajemen'){
        //     $data = $data->where('unit_id',$request->user()->pegawai->unit_id);
        // }
        //$data = $data->get();

        $used = null;
        foreach($data as $d){
            if($data->where('unit_id',$d->unit_id)->count() < 2) $used[$d->id] = 1;
            else $used[$d->id] = 0;
        }

        $active = $this->active;
        $route = $this->route;

        $editable = false;
        if(in_array($role,['sek','am','aspv'])) $editable = true;

        return view($this->template.'-index', compact('data','used','active','route','editable'));
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
    public function edit(Request $request)
    {
        //$data = $request->id ? ($request->user()->pegawai->unit->name != 'Manajemen' ? OrangTua::where(['id' => $request->id,'unit_id' => $request->user()->pegawai->unit_id])->first() : OrangTua::find($request->id)) : null;

        $data = $request->id ? OrangTua::where('id',$request->id)->whereHas('user',function($q){
            $q->where('role_id',36);
        })->doesntHave('pegawai')->first() : null;
        $active = $this->active;
        $route = $this->route;

        if($data)
            return view($this->template.'-edit', compact('data','active','route'));
        else
            return "Ups, tidak dapat memuat data";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $messages = [
            'editUsername.required' => 'Mohon masukkan nominal SPP',
        ];

        $this->validate($request, [
            'editUsername' => 'required'
        ], $messages);

        //$item = $request->id ? ($request->user()->pegawai->unit->name != 'Manajemen' ? SppNominal::where(['id' => $request->id,'unit_id' => $request->user()->pegawai->unit_id])->first() : SppNominal::find($request->id)) : null;

        $item = $request->id ? OrangTua::where('id',$request->id)->whereHas('user',function($q){
            $q->where('role_id',36);
        })->doesntHave('pegawai')->first() : null;

        if($item){
            $user = $item->user()->where('role_id',36)->first();
            $old = $user->username;
            $user->username = $request->editUsername;
            $user->save();

            $user->fresh();
            
            Session::flash('success','Data '.$old.' berhasil diubah'.($old != $user->username ? ' menjadi '.$user->username : ''));
        }

        else Session::flash('danger','Perubahan data gagal disimpan');

        return redirect()->route($this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $item = OrangTua::where('id', $request->id);
        // if($request->user()->pegawai->unit->name != 'Manajemen')
        //     $item = $item->where('unit_id',$request->user()->pegawai->unit_id);
        $item = $item->first();
        $used_count = 0;
        if($item && $used_count < 1){
            $name = $item->name;
            if($item->calonSiswa()->count() > 0 || $item->siswas()->count() > 0){
                $item->user()->where('role_id',36)->delete();

                Session::flash('success','Data login '.$name.' berhasil dihapus');
            }
            elseif(!$item->pegawai){
                $item->delete();

                Session::flash('success','Data '.$name.' berhasil dihapus');
            }
            else Session::flash('danger','Data tidak dapat dihapus');
        }
        else Session::flash('danger','Data gagal dihapus');

        return redirect()->route($this->route.'.index');
    }

    /**
     * Reset password the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request,$id){
        $ortu = OrangTua::where('id',$request->id)->whereHas('user',function($q){
            $q->where('role_id',36);
        })->doesntHave('pegawai')->first();

        if($ortu){
            $user = $ortu->user()->where('role_id',36)->first();
            $name = $ortu->name;
            $success = true;
            $phone = $password = null;
            if($ortu->father_phone){
                $password = $ortu->father_phone;
                $phone = 'ayah';
            }
            else{
                if($ortu->mother_phone){
                    $password = $ortu->mother_phone;
                    $phone = 'ibu';
                }
                elseif($ortu->guardian_phone_number){
                    $password = $ortu->guardian_phone_number;
                    $phone = 'wali';
                }
                else{
                    $success = false;
                }
            }
            if($success){
                $user->password = bcrypt($password);
                $user->save();

                Session::flash('success','Sandi '.$name.' berhasil di-reset ke pengaturan awal (nomor telepon '.$phone.')');
            }
            else Session::flash('danger','Sandi tidak dapat di-reset.');
        }
        else Session::flash('danger','Akun tidak ditemukan. Sandi gagal di-reset.');

        return redirect()->route($this->route.'.index');
    }
}
