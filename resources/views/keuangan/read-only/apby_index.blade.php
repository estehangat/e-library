@extends('template.main.master')

@section('title')
APB
@endsection

@section('headmeta')
<meta name="csrf-token" content="{{ Session::token() }}" />
@endsection

@section('sidebar')
@include('template.sidebar.keuangan.'.Auth::user()->role->name)
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">APB</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('keuangan.index')}}">Beranda</a></li>
    <li class="breadcrumb-item"><a href="{{ route('apby.index')}}">APB</a></li>
    @if($jenisAktif)
    <li class="breadcrumb-item"><a href="{{ route('apby.index', ['jenis' => $jenisAktif->link])}}">{{ $jenisAktif->name }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ !$isYear ? $tahun->academic_year : $tahun }}</li>
    @endif
  </ol>
</div>

<div class="row">
    @foreach($jenisAnggaran as $j)
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
                        <a href="{{ route('apby.index', ['jenis' => $j->link])}}" class="btn btn-sm btn-outline-brand-purple">Pilih</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <label for="yearOpt" class="form-control-label">Tahun Pelajaran</label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="input-group">
                    <select aria-label="Tahun" name="tahun" class="form-control" id="yearOpt">
                      @if($years && count($years) > 0)
                      @foreach($years as $y)
                        <option value="{{ $y }}" {{ $isYear && $tahun == $y ? 'selected' : ''}}>{{ $y }}</option>
                      @endforeach
                      @elseif($isYear)
                      @if($tahun != date('Y'))
                      <option value="" disabled="disabled" selected>Pilih</option>
                      @endif
                      <option value="{{ date('Y') }}" {{ $tahun == date('Y') ? 'selected' : '' }}>{{ date('Y') }}</option>
                      @endif
                      @if((!$academicYears && !$isYear) || ($academicYears && count($academicYears) > 0))
                      @foreach($tahunPelajaran as $t)
                      <option value="{{ $t->academicYearLink }}" {{ !$isYear && $tahun->id == $t->id ? 'selected' : '' }}>{{ $t->academic_year }}</option>
                      @endforeach
                      @endif
                    </select>
                    <a href="{{ route('apby.index', ['jenis' => $jenisAktif->link]) }}" id="btn-select-year" class="btn btn-brand-purple ml-2 pt-2" data-href="{{ route('apby.index', ['jenis' => $jenisAktif->link]) }}">Pilih</a>
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
                <h6 class="m-0 font-weight-bold text-brand-purple">Anggaran Tersedia</h6>
                @if(in_array(Auth::user()->role->name,['ketuayys','direktur','fam','faspv']) && count($apby) > 0)
                <div class="m-0 float-right">
                    @if(in_array(Auth::user()->role->name,['fam','faspv']))
                    @if($perubahan)
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#perubahanModal">APB Perubahan <i class="fas fa-pen-alt ml-1"></i></button>
                    @else
                    <button type="button" class="btn btn-secondary btn-sm" disabled>APB Perubahan <i class="fas fa-pen-alt ml-1"></i></button>
                    @endif
                    @endif
                    @if(!$isYear)
                    @if(in_array(Auth::user()->role->name,['ketuayys']))
                    @if($changeYear && $nextYear)
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#tutupModal">Tutup Tahun <i class="fas fa-book ml-1"></i></button>
                    @else
                    <button type="button" class="btn btn-secondary btn-sm" disabled>Tutup Tahun <i class="fas fa-book ml-1"></i></button>
                    @endif
                    @endif
                    @endif
                    @if($checkApby && $checkApby->count() > 0)
                    <a class="btn btn-brand-green-dark btn-sm" href="{{ route('apby.ekspor', ['jenis' => $jenisAktif->link, 'tahun' => !$isYear ? $tahun->academicYearLink : $tahun])}}">Ekspor <i class="fas fa-file-export ml-1"></i></a>
                    @else
                    <button type="button" class="btn btn-secondary btn-sm" disabled>Ekspor <i class="fas fa-file-export ml-1"></i></a>
                    @endif
                </div>
                @endif
            </div>
            <div class="card-body p-3">
                @if(count($apby) > 0 && in_array(Auth::user()->role->name,['fam','faspv']) && !$perubahan)
                <div class="alert alert-light alert-dismissible fade show" role="alert">
                  <i class="fa fa-info-circle text-info mr-2"></i>Untuk dapat melakukan APB Perubahan, pastikan tidak ada PPA, PPB, maupun RPPA yang belum selesai prosesnya
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                @if(count($apby) > 0 && in_array(Auth::user()->role->name,['ketuayys']) && $changeYear && !$nextYear)
                <div class="alert alert-light alert-dismissible fade show" role="alert">
                  <i class="fa fa-info-circle text-info mr-2"></i>Untuk dapat melakukan tutup tahun {{ $jenisAktif->name }}, mohon pastikan ketersediaan tahun pelajaran
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(Session::has('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ Session::get('danger') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @php
                $anggaranAktif = 0;
                @endphp
                @if(count($jenisAktif->anggaran) > 0)
                <div class="row ml-1">
                    @foreach($jenisAktif->anggaran as $a)
                    @php
                    $apbyCount = !$isYear ? $a->apby()->where('academic_year_id',$tahun->id)->count() : $a->apby()->where('year',$tahun)->aktif()->count();
                    $anggaranAktif += $apbyCount;
                    @endphp
                    @if(($isYear && (($tahun != date('Y') && $apbyCount > 0) || $tahun == date('Y'))) || (!$isYear && (($tahun->is_finance_year != 1 && $apbyCount > 0) || $tahun->is_finance_year == 1)))
                    <div class="col-md-6 col-12 mb-3">
                        <div class="row py-2 rounded border border-light mr-2">
                            <div class="col-8 d-flex align-items-center">
                                <div class="mr-3">
                                    <div class="icon-circle bg-gray-500">
                                        <i class="fas fa-money-check text-white"></i>
                                    </div>
                                </div>
                                <div>
                                  @if($apbyCount > 0)
                                    <a class="font-weight-bold text-dark" href="{{ route('apby.index', ['jenis' => $jenisAktif->link, 'tahun' => !$isYear ? $tahun->academicYearLink : $tahun, 'anggaran' => $a->anggaran->link])}}">{{ $a->anggaran->name }}</a>
                                  @else
                                    <span class="font-weight-bold text-dark" >{{ $a->anggaran->name }}</span>
                                  @endif
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end align-items-center">
                              @if($apbyCount > 0)
                                <a href="{{ route('apby.index', ['jenis' => $jenisAktif->link, 'tahun' => !$isYear ? $tahun->academicYearLink : $tahun, 'anggaran' => $a->anggaran->link])}}" class="btn btn-sm btn-outline-brand-purple-dark">Pilih</a>
                              @else
                                <button type="button" class="btn btn-sm btn-light" disabled="">Pilih</button>
                              @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @if((($isYear && $tahun != date('Y')) || (!$isYear && $tahun->is_finance_year != 1)) && $anggaranAktif == 0)
                    <div class="col-12 pl-0 pr-3">
                        <div class="text-center mx-3 mt-4 mb-5">
                            <h3>Mohon Maaf,</h3>
                            <h6 class="font-weight-light mb-3">Tidak ada data anggaran yang ditemukan</h6>
                        </div>
                    </div>
                    @endif
                </div>
                @else
                <div class="text-center mx-3 my-5">
                    <h3 class="text-center">Mohon Maaf,</h3>
                    <h6 class="font-weight-light mb-3">Tidak ada data anggaran yang ditemukan</h6>
                </div>
                @endif
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>

@if(count($apby) > 0 && in_array(Auth::user()->role->name,['fam','faspv']) && $perubahan)
<div class="modal fade" id="perubahanModal" tabindex="-1" role="dialog" aria-labelledby="perubahanModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-confirm" role="document">
    <div class="modal-content">
      <div class="modal-header flex-column">
        <div class="icon-box border-warning">
          <i class="material-icons text-warning">&#xE3C9;</i>
        </div>
        <h4 class="modal-title w-100">Apakah Anda yakin?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body p-1">
        Apakah Anda yakin ingin mengubah seluruh {{ $jenisAktif->name }} yang ada?
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-light mr-1" data-dismiss="modal">Tidak</button>
        <form action="{{ route('apby.perubahan', ['jenis' => $jenisAktif->link, 'tahun' => !$isYear ? $tahun->academicYearLink : $tahun])}}" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <button type="submit" class="btn btn-warning">Ya, Ubah</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endif

@if(count($apby) > 0 && in_array(Auth::user()->role->name,['ketuayys']) && $changeYear && $nextYear)
<div class="modal fade" id="tutupModal" tabindex="-1" role="dialog" aria-labelledby="tutupModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-confirm" role="document">
    <div class="modal-content">
      <div class="modal-header flex-column">
        <div class="icon-box border-warning">
          <i class="material-icons text-warning">&#xE865;</i>
        </div>
        <h4 class="modal-title w-100">Apakah Anda yakin?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body p-1">
        Apakah Anda yakin ingin menutup tahun {{ $jenisAktif->name }}?
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-light mr-1" data-dismiss="modal">Tidak</button>
        <form action="{{ route('apby.tutup', ['jenis' => $jenisAktif->link, 'tahun' => !$isYear ? $tahun->academicYearLink : $tahun])}}" method="post">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-warning">Ya, Tutup</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endif

@endif
<!--Row-->

@endsection

@section('footjs')
<!-- Plugins and scripts required by this view-->
@include('template.footjs.kepegawaian.tooltip')
@include('template.footjs.keuangan.change-year')
@endsection