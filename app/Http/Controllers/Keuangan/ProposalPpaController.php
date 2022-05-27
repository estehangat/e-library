<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Session;

use App\Models\Ppa\PpaProposal;
use App\Models\Product\ProductSalesType;
use App\Models\Sale\SalesType;
use App\Models\Unit;

class ProposalPpaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->template = 'keuangan.read-only.';
        $this->active = 'Proposal PPA';
        $this->route = 'proposal-ppa';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = $request->user()->role->name;

        $data = PpaProposal::latest();
        if(!in_array($role,['ketuayys','direktur','fam','faspv'])){
            $data = $data->where([
                'employee_id' => $request->user()->pegawai->id,
                'unit_id' => $request->user()->pegawai->unit_id,
                'position_id' => $request->user()->pegawai->position_id,
            ]);    
        }
        $data = $data->get();
        $used = null;
        foreach($data as $d){
            if($d->detail) $used[$d->id] = 1;
            else $used[$d->id] = 0;
        }
        $active = $this->active;
        $route = $this->route;

        return view($this->template.$route.'_index', compact('data','used','active','route'));
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
            'desc.required' => 'Mohon tuliskan deskripsi yang diajukan',
            'amount.required' => 'Mohon masukkan nominal yang diajukan',
        ];

        $this->validate($request, [
            'desc' => 'required',
            'amount' => 'required',
        ], $messages);

        $amount = (int)str_replace('.','',$request->amount);

        $count = PpaProposal::where([
            'desc' => $request->desc,
            'amount' => $amount,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('detail')->count();

        if($count < 1){
            $item = new PpaProposal();
            $item->desc = $request->desc;
            $item->amount = $amount;
            $item->employee_id = $request->user()->pegawai->id;
            $item->unit_id = $request->user()->pegawai->unit_id;
            $item->position_id = $request->user()->pegawai->position_id;
            $item->save();

            Session::flash('success','Data '.$request->desc.' berhasil ditambahkan');
        }

        else Session::flash('danger','Data pengajuan sudah pernah ditambahkan');

        return redirect()->route($this->route.'.index');
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
        $data = $request->id ? PpaProposal::where([
            'id' => $request->id,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('detail')->first() : null;
        $active = $this->active;
        $route = $this->route;

        return view($this->template.$route.'_ubah', compact('data','active','route'));
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
            'editDesc.required' => 'Mohon tuliskan deskripsi yang diajukan',
            'editAmount.required' => 'Mohon masukkan nominal yang diajukan',
        ];

        $this->validate($request, [
            'editDesc' => 'required',
            'editAmount' => 'required',
        ], $messages);

        $amount = (int)str_replace('.','',$request->editAmount);

        $item = PpaProposal::where([
            'id' => $request->id,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('detail')->first();

        $count = PpaProposal::where([
            'desc' => $request->editDesc,
            'amount' => $amount,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('detail')->where('id','!=',$request->id)->count();

        if($item && $count < 1){
            $old = $item->desc;
            $item->desc = $request->editDesc;
            $item->amount = $amount;
            $item->save();
            
            Session::flash('success','Data '.$old.' berhasil diubah menjadi '.$item->desc);
        }

        elseif($count > 0) Session::flash('danger','Perubahan gagal disimpan. Sepertinya data pengajuan sudah ada di daftar pengajuan.');

        else Session::flash('danger','Perubahan data pengajuan gagal disimpan');

        return redirect()->route($this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $item = PpaProposal::where([
            'id' => $id,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('detail')->first();

        if($item && !$item->detail){
            $desc = $item->desc;
            $item->delete();

            Session::flash('success','Data '.$desc.' berhasil dihapus');
        }
        else Session::flash('danger','Data pengajuan gagal dihapus');

        return redirect()->route($this->route.'.index');
    }
}
