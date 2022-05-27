<?php

namespace App\Http\Controllers\Rekrutmen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;

use App\Models\Rekrutmen\Universitas;

class UniversitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universitas = Universitas::orderBy('name')->get();

        return view('kepegawaian.etm.universitas_index', compact('universitas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Mohon tuliskan nama universitas',
        ];

        $this->validate($request, [
            'name' => 'required',
        ], $messages);

        $count = Universitas::where('name', $request->name)->count();
        
        if($count < 1){
            $universitas = new Universitas();
            $universitas->name = $request->name;
            $universitas->save();

            Session::flash('success','Data '.$request->name.' berhasil ditambahkan');
        }

        else Session::flash('danger','Data '.$request->name.' sudah pernah ditambahkan');

        return redirect()->route('universitas.index');
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
        $universitas = $request->id ? Universitas::find($request->id) : null;

        return view('kepegawaian.etm.universitas_ubah', compact('universitas'));
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
            'name.required' => 'Mohon tuliskan nama program bidang studi',
        ];

        $this->validate($request, [
            'name' => 'required',
        ], $messages);

        $universitas = Universitas::find($request->id);
        $count = Universitas::where('name',$request->name)->where('id','!=',$request->id)->count();

        if($universitas && $count < 1){
            $universitas->name = $request->name;
            $universitas->save();

           Session::flash('success','Data '.$universitas->name.' berhasil diubah');
        }

        else Session::flash('danger','Perubahan data gagal disimpan');

        return redirect()->route('universitas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $universitas = Universitas::find($id);
        $employee_count = $universitas->pegawai()->where('active_status_id',1)->count();
        if($universitas && $employee_count < 1){
            $name = $universitas->name;
            $universitas->delete();

            Session::flash('success','Data '.$name.' berhasil dihapus');
        }
        else Session::flash('danger','Data gagal dihapus');

        return redirect()->route('universitas.index');
    }
}
