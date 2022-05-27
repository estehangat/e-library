@extends('template.main.master')

@section('title')
BBK
@endsection

@section('headmeta')
<meta name="csrf-token" content="{{ Session::token() }}" />
@endsection

@section('sidebar')
@include('template.sidebar.keuangan.'.Auth::user()->role->name)
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">BBK</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('keuangan.index')}}">Beranda</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bbk.index')}}">BBK</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bbk.index', ['jenis' => $jenisAktif->link])}}">{{ $jenisAktif->name }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('bbk.index', ['jenis' => $jenisAktif->link,'tahun' => $tahun->academicYearLink])}}">{{ $tahun->academic_year }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $unitAktif->name }}</li>
  </ol>
</div>

<div class="row">
    @foreach($jenisAnggaran as $j)
    @php
    $unitCount = $j->anggaran()->whereHas('ppa',function($q){$q->where('director_acc_status_id',1);})->with('anggaran.unit')->get()->pluck('anggaran.unit')->unique()->count();
    @endphp
    @if($jenisAktif == $j)
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body p-0">
                <div class="row align-items-center mx-0">
                    <div class="col-auto px-3 py-2 bg-brand-green">
                        <i class="mdi mdi-file-document-outline mdi-24px text-white"></i>
                    </div>
                    <div class="col">
                        <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $j->name }}</div>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-sm btn-outline-secondary" disabled="disabled">Pilih</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    @if($unitCount > 0)
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body p-0">
                <div class="row align-items-center mx-0">
                    <div class="col-auto px-3 py-2 bg-brand-purple">
                        <i class="mdi mdi-file-document-outline mdi-24px text-white"></i>
                    </div>
                    <div class="col">
                        <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $j->name }}</div>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('bbk.index', ['jenis' => $j->link])}}" class="btn btn-sm btn-outline-brand-purple">Pilih</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body p-0">
                <div class="row align-items-center mx-0">
                    <div class="col-auto px-3 py-2 bg-secondary">
                        <i class="mdi mdi-file-document-outline mdi-24px text-white"></i>
                    </div>
                    <div class="col">
                        <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $j->name }}</div>
                    </div>
                    <div class="col-auto">
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary disabled"role="button" aria-disabled="true">Pilih</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif
    @endforeach
</div>

@if($jenisAktif)
<div class="row mb-4">
  <div class="col-12">
    <div class="card">
      <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-8 col-md-10 col-12">
              <div class="form-group mb-0">
                <div class="row mb-2">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label for="yearOpt" class="form-control-label">Tahun</label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="input-group">
                    <select aria-label="Tahun" name="tahun" class="form-control" id="yearOpt">
                      @foreach($tahunPelajaran as $t)
                      @if($t->is_active == 1 || ($t->is_active != 1 && $t->whereHas('ppa',function($q)use($jenisAktif,$t){$q->where('academic_year_id',$t->id)->whereHas('jenisAnggaranAnggaran',function($q)use($jenisAktif){$q->where('budgeting_type_id',$jenisAktif->id);})->where('director_acc_status_id',1);})->count()))
                      <option value="{{ $t->academicYearLink }}" {{ $tahun->id == $t->id ? 'selected' : '' }}>{{ $t->academic_year }}</option>
                      @endif
                      @endforeach
                    </select>
                    <a href="{{ route('bbk.index', ['jenis' => $jenisAktif->link]) }}" id="btn-select-year" class="btn btn-brand-purple ml-2 pt-2" data-href="{{ route('bbk.index', ['jenis' => $jenisAktif->link]) }}">Pilih</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-brand-purple">{{ $unitAktif->name }}</h6>
                @if($tahun->is_active == 1)
                @if(count($ppaAcc) > 0)
                <a class="m-0 float-right btn btn-brand-purple-dark btn-sm" href="{{ route('bbk.buat', ['jenis' => $jenisAktif->link, 'tahun' => $tahun->academicYearLink, 'unit' => strtolower($unitAktif->name)])}}">Tambah <i class="fas fa-plus-circle ml-1"></i></a>
                @else
                <button type="button" class="m-0 float-right btn btn-brand-purple-dark btn-sm" disabled="disabled">Tambah <i class="fas fa-plus-circle ml-1"></i></button>
                @endif
                @endif
            </div>
                @if(count($bbk) > 0)
                @php
                $i = 1;
                @endphp
                <div class="table-responsive">
                    <table id="bbkList" class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th style="white-space: nowrap">Nomor BBK</th>
                                <th>Status</th>
                                <th>Jumlah</th>
                                <th>Pencairan</th>
                                <th style="width: 160px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bbk->sortByDesc('id')->all() as $b)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $b->date ? $b->date : '-' }}</td>
                                <td class="bbk-number">{{ $b->number ? $b->number : '-' }}</td>
                                <td>
                                    @if($b->detail()->count() < 1)
                                    <i class="fa fa-lg fa-question-circle text-light" data-toggle="tooltip" data-original-title="Belum ada daftar PPA yang dimasukkan untuk BBK ini"></i>
                                    @elseif(!$b->director_acc_status_id)
                                    <i class="fa fa-lg fa-question-circle text-light" data-toggle="tooltip" data-original-title="Menunggu Persetujuan {{ Auth::user()->pegawai->position_id == 17 ? 'Anda' : 'Director' }}"></i>
                                    @elseif($b->director_acc_status_id == 1)
                                    <i class="fa fa-lg fa-check-circle text-info mr-1" data-toggle="tooltip" data-html="true" data-original-title="Disetujui oleh {{ Auth::user()->pegawai->is($b->accDirektur) ? 'Anda' : $b->accDirektur->name }}<br>{{ date('d M Y H.i.s', strtotime($b->director_acc_time)) }}"></i>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    @if($b->director_acc_status_id != 1)
                                    {{ number_format($b->detail()->sum('ppa_value'), 0, ',', '.') }}
                                    @else
                                    {{ $b->totalValueWithSeparator }}
                                    @endif
                                </td>
                                <td>
                                    @if($b->director_acc_status_id == 1 && $b->disbursement_status_id != 1)
                                    <i class="fa fa-lg fa-clock text-light" data-toggle="tooltip" data-original-title="Menunggu dicairkan oleh {{ in_array(Auth::user()->pegawai->position_id, [29,30]) ? 'Anda' : 'Finance and Accounting' }}"></i>
                                    @elseif($b->director_acc_status_id == 1 && $b->disbursement_status_id == 1)
                                    <i class="fa fa-lg fa-check-circle text-success" data-toggle="tooltip" data-html="true" data-original-title="Dicairkan oleh Finance and Accounting pada<br>{{ date('d M Y H.i.s', strtotime($b->disbursement_time)) }}"></i>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('bbk.show', ['jenis' => $jenisAktif->link, 'tahun' => $tahun->academicYearLink, 'unit' => strtolower($unitAktif->name), 'nomor' => $b->firstNumber]) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                    <!-- if($b->president_acc_status_id == 1 && $b->disbursement_status_id != 1)
                                    <button type="button" class="btn btn-sm btn-success btn-disburse" data-toggle="modal" data-target="#disburseConfirm" data-action="{{ route('bbk.cair', ['jenis' => $jenisAktif->link, 'tahun' => $tahun, 'unit' => strtolower($unitAktif->name), 'nomor' => $b->firstNumber]) }}"><i class="fas fa-money-bill-wave"></i></button>
                                    endif -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center mx-3 my-5">
                    <h3 class="text-center">Mohon Maaf,</h3>
                    <h6 class="font-weight-light mb-3">Tidak ada data BBK yang ditemukan</h6>
                </div>
                @endif
                <div class="card-footer"></div>
        </div>
    </div>
</div>
@endif
<!--Row-->

@if(count($bbk) > 0 && $bbk->where('director_acc_status_id',1)->count() > 0)
<div class="modal fade" id="disburseConfirm" tabindex="-1" role="dialog" aria-labelledby="cairkanModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-confirm" role="document">
    <div class="modal-content">
      <div class="modal-header flex-column">
        <div class="icon-box border-success">
          <i class="material-icons text-success">&#xE5CA;</i>
        </div>
        <h4 class="modal-title w-100">Apakah Anda yakin?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body p-1">
        Apakah Anda yakin bahwa BBK dengan nomor <span class="font-weight-bold number"></span> sudah dicairkan?
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-danger mr-1" data-dismiss="modal">Tidak</button>
        <form id="disburseForm" action="#" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <button type="submit" class="btn btn-success">Ya, Sudah</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endif

@endsection

@section('footjs')
<!-- Plugins and scripts required by this view-->

<!-- Page level plugins -->

<!-- Plugins and scripts required by this view-->
@include('template.footjs.kepegawaian.tooltip')
@include('template.footjs.keuangan.change-year')
@include('template.footjs.modal.bbk_disburse')
@endsection