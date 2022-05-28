<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Session;
use Jenssegers\Date\Date;

use App\Models\Kbm\TahunAjaran;
use App\Models\Ppa\PpaProposal;
use App\Models\Ppa\PpaProposalDetail;
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

        $status = 'menunggu';
        if(isset($request->status) && $request->status != 'menunggu'){
            if(in_array($request->status,['diajukan'])) $status = $request->status;
        }

        $years = null;
        $year = isset($request->year) ? $request->year : null;
        if(!$year){
            $year = Date::now('Asia/Jakarta')->format('Y');
        }

        $years = PpaProposal::select('year')->orderBy('year')->pluck('year')->unique();

        $data = PpaProposal::latest();
        if(!in_array($role,['ketuayys','direktur','fam','faspv'])){
            $data = $data->where([
                'employee_id' => $request->user()->pegawai->id,
                'unit_id' => $request->user()->pegawai->unit_id,
                'position_id' => $request->user()->pegawai->position_id,
            ]);
        }
        $data = $status == 'menunggu' ? $data->doesntHave('ppa') : $data->has('ppa');
        if($year) $data = $data->where('year',$year);
        $data = $data->get();
        $used = null;
        foreach($data as $d){
            if($d->ppa) $used[$d->id] = 1;
            else $used[$d->id] = 0;
        }
        $active = $this->active;
        $route = $this->route;

        return view($this->template.$route.'_index', compact('data','used','active','route','years','year','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $messages = [
            'title.required' => 'Mohon tuliskan deskripsi yang diajukan'
        ];

        $this->validate($request, [
            'title' => 'required'
        ], $messages);

        $thisYear = Date::now('Asia/Jakarta')->format('Y');
        $thisDate = Date::now('Asia/Jakarta')->format('Y-m-d');

        $count = PpaProposal::where([
            'date' => $thisDate,
            'title' => $request->title,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->count();

        if($count < 1){
            $tahun = TahunAjaran::select('id')->where('is_finance_year',1)->latest()->first();

            $item = new PpaProposal();
            $item->date = $thisDate;
            $item->year = $thisYear;
            $item->academic_year_id = $tahun->id;
            $item->title = $request->title;
            $item->employee_id = $request->user()->pegawai->id;
            $item->unit_id = $request->user()->pegawai->unit_id;
            $item->position_id = $request->user()->pegawai->position_id;
            $item->save();

            $item->fresh();

            Session::flash('success','Data '.$request->title.' berhasil ditambahkan');

            return redirect()->route($this->route.'.detail.show',['id' => $item->id]);
        }

        else{
            Session::flash('danger','Data proposal sudah pernah ditambahkan');

            return redirect()->route($this->route.'.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detailStore(Request $request,$id)
    {
        $messages = [
            'desc.required' => 'Mohon tuliskan deskripsi yang diajukan',
            'price.required' => 'Mohon masukkan harga yang diajukan',
            'qty.required' => 'Mohon masukkan kuantitas yang diajukan',
        ];

        $this->validate($request, [
            'desc' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ], $messages);

        $price = (int)str_replace('.','',$request->price);
        $qty = (int)str_replace('.','',$request->qty);

        $data = PpaProposal::where([
            'id' => $id,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id
        ])->doesntHave('ppa')->first();

        if($data){
            $proposalDetail = $data->details()->where([
                'desc' => $request->desc,
                'price' => $price,
                'quantity' => $qty
            ]);

            if($proposalDetail->count() < 1){
                $item = new PpaProposalDetail();
                $item->desc = $request->desc;
                $item->price = $price;
                $item->quantity = $qty;
                $item->value = $price*$qty;
                $item->price_ori = $price;
                $item->quantity_ori = $qty;
                $item->employee_id = $request->user()->pegawai->id;
                
                $data->details()->save($item);

                $data->update(['total_value' => $data->details()->sum('value')]);

                $item->fresh();

                Session::flash('success','Data '.$request->desc.' berhasil ditambahkan');

                return redirect()->route($this->route.'.detail.show',['id' => $data->id]);
            }
            else{
                $proposalDetail = $proposalDetail->first();

                Session::flash('danger','Data pengajuan sudah pernah ditambahkan');

                return redirect()->route($this->route.'.detail.show',['id' => $proposalDetail->id]);
            }
        }
        else{
            Session::flash('danger','Data proposal tidak ditemukan');

            return redirect()->route($this->route.'.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $role = $request->user()->role->name;

        $data = null;

        if($request->id){
            $data = PpaProposal::where('id', $request->id);
            if(!in_array($role,['ketuayys','direktur','fam','faspv'])){
                $data = $data->where([
                    'employee_id' => $request->user()->pegawai->id,
                    'unit_id' => $request->user()->pegawai->unit_id,
                    'position_id' => $request->user()->pegawai->position_id,
                ]);
            }
            $data = $data->first();
        }

        $active = $this->active;
        $route = $this->route;

        if($data){
            $editable = !$data->ppa && $request->user()->pegawai->id == $data->employee_id ? true : false;

            return view($this->template.$route.'_detail', compact('data','active','route','id','editable'));
        }

        return redirect()->route($route.'.index');
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
        ])->doesntHave('ppa')->first() : null;
        $active = $this->active;
        $route = $this->route;

        return view($this->template.$route.'_edit', compact('data','active','route'));
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
            'editTitle.required' => 'Mohon tuliskan nama proposal yang diajukan',
        ];

        $this->validate($request, [
            'editTitle' => 'required',
        ], $messages);

        $item = PpaProposal::where([
            'id' => $request->id,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('ppa')->first();

        $count = PpaProposal::where([
            'date' => Date::now('Asia/Jakarta')->format('Y-m-d'),
            'title' => $request->editTitle,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('ppa')->where('id','!=',$request->id)->count();

        if($item && $count < 1){
            $old = $item->title;
            $item->title = $request->editTitle;
            $item->save();
            
            Session::flash('success','Data '.$old.' berhasil diubah menjadi '.$item->title);
        }

        elseif($count > 0) Session::flash('danger','Perubahan gagal disimpan. Sepertinya data pengajuan sudah ada di daftar pengajuan.');

        else Session::flash('danger','Perubahan data pengajuan gagal disimpan');

        return redirect()->route($this->route.'.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailUpdate(Request $request, $id)
    {
        $data = PpaProposal::where([
            'id' => $id,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('ppa')->first();

        if($data){
            if(isset($request->editId)){
                $item = explode('-',$request->editId)[1];
                $proposalDetail = $data->details()->where('id',$item)->first();

                if($proposalDetail){
                    $edited = 0;
                    if(isset($request->editDesc) && $proposalDetail->desc != $request->editDesc){
                        $proposalDetail->desc = $request->editDesc;
                        $edited++;
                    }
                    if(isset($request->editPrice)){
                        $requestPrice = (int)str_replace('.','',$request->editPrice);
                        if($proposalDetail->price_ori != $requestPrice){
                            $proposalDetail->price = $requestPrice;
                            $proposalDetail->price_ori = $requestPrice;
                            $edited++;
                        }
                    }
                    if(isset($request->editQty)){
                        $requestQty = (int)str_replace('.','',$request->editQty);
                        if($proposalDetail->quantity_ori != $requestQty){
                            $proposalDetail->quantity = $requestQty;
                            $proposalDetail->quantity_ori = $requestQty;
                            $edited++;
                        }
                    }

                    if($edited > 0){
                        $proposalDetail->value = ($proposalDetail->price_ori)*($proposalDetail->quantity_ori);
                        $proposalDetail->save();

                        $data->update(['total_value' => $data->details()->sum('value')]);

                        Session::flash('success','Data pengajuan berhasil diubah');
                    }
                }
                else Session::flash('danger','Data pengajuan gagal diubah');
            }
            else Session::flash('danger','Data pengajuan tidak ditemukan');
        }
        else Session::flash('danger','Data proposal tidak ditemukan');

        return redirect()->route($this->route.'.detail.show', ['id' => $id]);
    }

    /**
     * Update all specified resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailUpdateAll(Request $request, $id)
    {
        $data = PpaProposal::where([
            'id' => $id,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('ppa')->first();

        if($data){
            if($data->details()->count() > 0){
                foreach($data->details as $detail){
                    $inputName = 'price-'.$detail->id;
                    $requestPrice = (int)str_replace('.','',$request->{$inputName});
                    $detail->price = $requestPrice;
                    $detail->price_ori = $requestPrice;

                    $inputName = 'qty-'.$detail->id;
                    $requestQuantity = (int)str_replace('.','',$request->{$inputName});
                    $detail->quantity = $requestQuantity;
                    $detail->quantity_ori = $requestQuantity;

                    $detail->value = $requestPrice*$requestQuantity;

                    $detail->save();
                }

                $data->update(['total_value' => $data->details()->sum('value')]);

                Session::flash('success','Rincian pengajuan berhasil diperbarui');
            }
            else Session::flash('danger','Data pengajuan tidak ditemukan');
        }
        else Session::flash('danger','Data proposal tidak ditemukan');

        return redirect()->route($this->route.'.detail.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = PpaProposal::where([
            'id' => $id,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('ppa')->first();

        if($data){
            $title = $data->title;
            $data->details()->forceDelete();
            $data->delete();

            Session::flash('success','Data '.$title.' berhasil dihapus');
        }
        else Session::flash('danger','Data pengajuan gagal dihapus');

        $count = PpaProposal::where([
            'year' => $request->year,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('ppa')->count();

        $params = $count > 0 ? ['year' => $request->year, 'status' => $request->status] : null;

        return redirect()->route($this->route.'.index',$params);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $item
     * @return \Illuminate\Http\Response
     */
    public function detailDestroy(Request $request, $id, $item)
    {
        $data = PpaProposal::where([
            'id' => $id,
            'employee_id' => $request->user()->pegawai->id,
            'unit_id' => $request->user()->pegawai->unit_id,
            'position_id' => $request->user()->pegawai->position_id,
        ])->doesntHave('ppa')->first();

        if($data){
            $proposalDetail = $data->details()->where('id',$item)->first();

            if($proposalDetail){
                $desc = $proposalDetail->desc;
                $proposalDetail->forceDelete();

                $data->update(['total_value' => $data->details()->sum('value')]);

                Session::flash('success','Data '.$desc.' berhasil dihapus');
            }
            else Session::flash('danger','Data pengajuan gagal dihapus');
        }
        else Session::flash('danger','Data proposal tidak ditemukan');

        return redirect()->route($this->route.'.detail.show', ['id' => $id]);
    }
}
