@extends('keuangan.parent.ppa_show')

@section('validate')
<input type="hidden" name="validate" value="">
@endsection

@section('row')
@php
$i = 1;
@endphp
@foreach($ppaAktif->detail as $p)
<tr id="p-{{ $p->id }}">
    <td>{{ $i++ }}</td>
    <td class="detail-account">{{ $p->akun->codeName }}</td>
    <td class="detail-note">{{ $p->note }}</td>
    @if(($apbyAktif && $apbyAktif->is_active == 1) && $ppaAktif->director_acc_status_id != 1)
    @php
    $apbyDetail = $p->akun->apby()->whereHas('apby',function($q)use($yearAttr,$tahun,$anggaranAktif,$accAttr){$q->where([$yearAttr => ($yearAttr == 'year' ? $tahun : $tahun->id),$accAttr => 1])->whereHas('jenisAnggaranAnggaran',function($q)use($anggaranAktif){$q->where('id',$anggaranAktif->id);})->aktif()->latest();})->where('account_id',$p->account_id)->first();
    @endphp
    <td>{{ $apbyDetail ? $apbyDetail->balanceWithSeparator : '-' }}</td>
    @endif
    <td>
        @if(!$p->pa_acc_status_id)
        <i class="fa fa-lg fa-question-circle text-light" data-toggle="tooltip" data-original-title="Menunggu Persetujuan {{ Auth::user()->pegawai->position_id == $anggaranAktif->anggaran->acc_position_id ? 'Anda' : $anggaranAktif->anggaran->accJabatan->name }}"></i>
        @elseif(!$ppaAktif->pa_acc_status_id && $p->pa_acc_status_id == 1)
        <i class="fa fa-lg fa-check-circle text-secondary mr-1" data-toggle="tooltip" data-html="true" data-original-title="Disetujui oleh {{ Auth::user()->pegawai->is($p->accPa) ? 'Anda' : $p->accPa->name }}<br>{{ date('d M Y H.i.s', strtotime($p->pa_acc_time)) }}"></i>
        @elseif($ppaAktif->pa_acc_status_id == 1 && !$p->finance_acc_status_id)
        <i class="fa fa-lg fa-question-circle text-light" data-toggle="tooltip" data-original-title="Menunggu Persetujuan {{ Auth::user()->pegawai->position_id == 30 ? 'Anda' : 'Finance & Accounting Supervisor' }}"></i>
        @elseif($p->finance_acc_status_id == 1 && !$p->director_acc_status_id)
        <i class="fa fa-lg fa-check-circle text-warning mr-1" data-toggle="tooltip" data-html="true" data-original-title="Disetujui oleh {{ Auth::user()->pegawai->is($p->accKeuangan) ? 'Anda' : $p->accKeuangan->name }}<br>{{ date('d M Y H.i.s', strtotime($p->finance_acc_time)) }}"></i>
        @elseif($p->director_acc_status_id == 1)
        @if($p->value_fam && $p->value_fam > 0 && $p->value_fam != $p->value_director)
        <i class="fa fa-lg fa-check-circle text-success mr-1" data-toggle="tooltip" data-html="true" data-original-title="Disetujui dengan perubahan oleh {{ Auth::user()->pegawai->is($p->accDirektur) ? 'Anda' : $p->accDirektur->name }}<br>{{ date('d M Y H.i.s', strtotime($p->director_acc_time)) }}<br>Awal: {{ $p->valuePaWithSeparator }}"></i>
        @else
        <i class="fa fa-lg fa-check-circle text-success mr-1" data-toggle="tooltip" data-html="true" data-original-title="Disetujui oleh {{ Auth::user()->pegawai->is($p->accDirektur) ? 'Anda' : $p->accDirektur->name }}<br>{{ date('d M Y H.i.s', strtotime($p->director_acc_time)) }}"></i>
        @endif
        @else
        -
        @endif
    </td>
    <td class="detail-value" style="min-width: 200px">
        @if((!$isAnggotaPa && $ppaAktif->pa_acc_status_id != 1) || $ppaAktif->finance_acc_status_id == 1 || !$apbyAktif || ($apbyAktif && $apbyAktif->is_active == 0))
        <input type="text" class="form-control form-control-sm" value="{{ $p->valueWithSeparator }}" disabled>
        @else
        <input name="value-{{ $p->id }}" type="text" class="form-control form-control-sm number-separator" value="{{ $p->valueWithSeparator }}">
        @endif
    </td>
    @if(($apbyAktif && $apbyAktif->is_active == 1) && $isAnggotaPa && ((in_array(Auth::user()->role->name, ['fam','faspv']) && $ppaAktif->finance_acc_status_id != 1) || $ppaAktif->pa_acc_status_id != 1))
    <td>
        @if(($apbyAktif && $apbyAktif->is_active == 1) && $p->finance_acc_status_id != 1)
        @if($ppaAktif->type_id == 2)
        <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-form" onclick="editModal('{{ route('ppa.ubah.detail', ['jenis' => $jenisAktif->link, 'tahun' => !$isYear ? $tahun->academicYearLink : $tahun, 'anggaran' => $anggaranAktif->anggaran->link, 'nomor' => $ppaAktif->firstNumber]) }}','{{ $p->id }}')"><i class="fas fa-pen"></i></a>
        @else
        <button type="button" class="btn btn-sm btn-warning btn-edit" data-toggle="modal" data-target="#edit-form">
            <i class="fa fa-pen"></i>
        </button>
        @endif
        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-confirm" onclick="deleteModal('Pengajuan', '{{ addslashes(htmlspecialchars($p->note)) }}', '{{ route('ppa.hapus', ['jenis' => $jenisAktif->link, 'tahun' => !$isYear ? $tahun->academicYearLink : $tahun, 'anggaran' => $anggaranAktif->anggaran->link, 'nomor' => $ppaAktif->firstNumber, 'id' => $p->id]) }}')">
            <i class="fas fa-trash"></i>
        </a>
        @endif
    </td>
    @endif
</tr>
@endforeach

@endsection

@section('footer')
@if(($apbyAktif && $apbyAktif->is_active == 1) && ($isPa || (!$isPa && $ppaAktif->pa_acc_status_id == 1)) && $ppaAktif->finance_acc_status_id != 1)
<div class="row">
    <div class="col-12">
        <div class="text-center">
            <button class="btn btn-brand-purple-dark" type="submit">Simpan</button>
            @if($ppaAktif->finance_acc_status_id != 1 || $ppaAktif->detail()->where(function($q){$q->where('finance_acc_status_id','!=',1)->orWhereNull('finance_acc_status_id');})->count() > 0)
            <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#saveAccept">Simpan & Setujui</button>
            @endif
        </div>
    </div>
</div>
@endif
@endsection

@section('accept-modal')
@if(($apbyAktif && $apbyAktif->is_active == 1) && $ppaAktif && ($isPa || (!$isPa && $ppaAktif->pa_acc_status_id == 1)) && ($ppaAktif->finance_acc_status_id != 1 || $ppaAktif->detail()->where(function($q){$q->where('finance_acc_status_id','!=',1)->orWhereNull('finance_acc_status_id');})->count() > 0))
<div class="modal fade" id="saveAccept" tabindex="-1" role="dialog" aria-labelledby="simpanSetujuiModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-confirm" role="document">
    <div class="modal-content">
      <div class="modal-header flex-column">
        <div class="icon-box border-warning">
          <i class="material-icons text-warning">&#xE5CA;</i>
        </div>
        <h4 class="modal-title w-100">Apakah Anda yakin?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body p-1">
        Apakah Anda yakin ingin menyimpan dan menyetujui semua alokasi dana yang ada?
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn mr-1" data-dismiss="modal">Tidak</button>
        <button type="submit" id="saveAcceptBtn" class="btn btn-warning" data-form="ppa-form">Ya, Simpan & Setujui</button>
      </div>
    </div>
  </div>
</div>
@endif
@endsection

@section('accept-script')
@if(($apbyAktif && $apbyAktif->is_active == 1) && $ppaAktif && ($isPa || (!$isPa && $ppaAktif->pa_acc_status_id == 1)) && ($ppaAktif->finance_acc_status_id != 1 || $ppaAktif->detail()->where(function($q){$q->where('finance_acc_status_id','!=',1)->orWhereNull('finance_acc_status_id');})->count() > 0))
@include('template.footjs.modal.post_save_accept')
@endif
@endsection