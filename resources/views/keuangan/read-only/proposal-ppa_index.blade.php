@extends('template.main.master')

@section('title')
{{ $active }}
@endsection

@section('headmeta')
<!-- DataTables -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<meta name="csrf-token" content="{{ Session::token() }}" />
@endsection

@section('sidebar')
@php
$role = Auth::user()->role->name;
@endphp
@if(in_array($role,['admin','pembinayys','ketuayys','kepsek','wakasek','keu','direktur','etl','etm','fam','faspv','fas','ctl','ctm','am','aspv','ftm','ftspv','fts','keulsi']))
@include('template.sidebar.keuangan.'.$role)
@else
@include('template.sidebar.keuangan.employee')
@endif
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-2">
  <h1 class="h3 mb-0 text-gray-800">{{ $active }}</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="./">Beranda</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $active }}</li>
  </ol>
</div>

@if($years && count($years) > 0)
<div class="row mb-4">
  <div class="col-12">
    <div class="card shadow">
      <div class="card-body px-4 py-3">
        <form action="{{ route($route.'.index') }}" id="viewItemForm" method="get">
          <div class="row">
            <div class="col-lg-10 col-md-12">
              <div class="form-group">
                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label for="selectYear" class="form-control-label">Tahun</label>
                  </div>
                  <div class="col-lg-4 col-md-6 col-12">
                    <select class="form-control @error('year') is-invalid @enderror" name="year" id="selectYear" onchange="if(this.value){ this.form.submit(); }" required="required">
                      @if(!$years || ($years && count($years) < 1))
                      <option value="" selected="selected" disabled="disabled">Belum Ada</option>
                      @endif
                      @foreach($years as $y)
                      <option value="{{ $y }}" {{ old('year',$year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                      @endforeach
                      @if(!in_array(date('Y'),$years->toArray()))
                      <option value="{{ date('Y') }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ date('Y') }}</option>
                      @endif
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="status" value="{{ $status }}">
        </form>
      </div>
    </div>
  </div>
</div>
@endif

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <ul class="nav nav-pills p-3">
              @if(!isset($status) || $status != 'diajukan')
              <li class="nav-item">
                <a class="nav-link active" href="{{ route($route.'.index', ['year' => $year, 'status' => 'menunggu']) }}">Menunggu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-brand-purple" href="{{ route($route.'.index', ['year' => $year, 'status' => 'diajukan']) }}">Diajukan</a>
              </li>
              @else
              <li class="nav-item">
                <a class="nav-link text-brand-purple" href="{{ route($route.'.index', ['year' => $year, 'status' => 'menunggu']) }}">Menunggu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{ route($route.'.index', ['year' => $year, 'status' => 'diajukan']) }}">Diajukan</a>
              </li>
              @endif
            </ul>
        </div>
    </div>
</div>

@if((!isset($status) || $status != 'diajukan') && (!isset($year) || $year == date('Y')))
<div class="row mb-4">
  <div class="col-12">
    <div class="card shadow">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-brand-purple">Buat Proposal</h6>
      </div>
      <div class="card-body px-4 py-3">
        <form action="{{ route($route.'.create') }}" id="addItemForm" method="post" enctype="multipart/form-data" accept-charset="utf-8">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-lg-10 col-md-12">
              <div class="form-group">
                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label for="normal-input" class="form-control-label">Nama Proposal</label>
                  </div>
                  <div class="col-lg-9 col-md-8 col-12">
                    <input type="text" id="desc" class="form-control form-control-sm @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" maxlength="100"  required="required">
                    <small class="form-text text-muted">Maksimal 100 karakter</small>
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-1">
            <div class="col-lg-10 col-md-12">
                <div class="row">
                    <div class="col-lg-9 offset-lg-3 col-md-8 offset-md-4 col-12 text-left">
                      <input type="submit" class="btn btn-sm btn-brand-purple-dark" value="Tambah">
                    </div>
                </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endif

<div class="row mb-4">
  <div class="col-12">
    <div class="card shadow">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-brand-purple">{{ $active }}</h6>
      </div>
      @if(count($data) > 0)
      <div class="card-body">
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
        <div class="table-responsive">
          <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
            <thead>
              <tr>
                <th style="width: 50px">#</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Pengajuan</th>
                <th>Unit</th>
                <th>Jabatan</th>
                <th style="width: 120px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($data as $d)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ date('Y-m-d',strtotime($d->created_at)) }}</td>
                <td>{{ $d->title }}</td>
                <td>{{ $d->totalValueOriWithSeparator }}</td>
                <td>{{ $d->unit->name }}</td>
                <td>{{ $d->jabatan->name }}</td>
                <td>
                  <a href="{{ route($route.'.detail.show', ['id' => $d->id]) }}" class="btn btn-sm btn-brand-purple-dark"><i class="fas fa-eye"></i></a>
                  @if($d->pegawai->id == Auth::user()->pegawai->id)
                  @if($used && $used[$d->id] < 1)
                  @if((!isset($status) || $status != 'diajukan') && (!isset($year) || $year == date('Y')))
                  <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-form" onclick="editModal('{{ route($route.'.edit') }}','{{ $d->id }}')" data-toggle="modal" data-target="#edit-form"><i class="fas fa-pen"></i></a>
                  @endif
                  <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-confirm" onclick="deleteModal('{{ $active }}', '{!! addslashes(htmlspecialchars($d->title)) !!}', '{{ route($route.'.destroy', ['id' => $d->id, 'year' => $year, 'status' => $status]) }}')"><i class="fas fa-trash"></i></a>
                  @else
                  <button type="button" class="btn btn-sm btn-secondary" disabled="disabled"><i class="fas fa-trash"></i></button>
                  @endif
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @else
      @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        <strong>Sukses!</strong> {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if(Session::has('danger'))
      <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
        <strong>Gagal!</strong> {{ Session::get('danger') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <div class="text-center mx-3 my-5">
        <h3 class="text-center">Mohon Maaf,</h3>
        <h6 class="font-weight-light mb-3">Tidak ada data {{ strtolower($active) }} yang ditemukan</h6>
      </div>
      @endif
    </div>
  </div>
</div>
<!--Row-->

<div class="modal fade" id="edit-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-brand-purple border-0">
        <h5 class="modal-title text-white">Ubah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>

      <div class="modal-load p-4">
        <div class="row">
          <div class="col-12">
            <div class="text-center my-5">
              <i class="fa fa-spin fa-circle-notch fa-lg text-brand-green"></i>
              <h5 class="font-weight-light mb-3">Memuat...</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body p-4" style="display: none;">
      </div>
    </div>
  </div>
</div>

@include('template.modal.konfirmasi_hapus')

@endsection

@section('footjs')
<!-- Plugins and scripts required by this view-->

<!-- Page level plugins -->

<!-- DataTables -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Easy Number Separator JS -->
<script src="{{ asset('vendor/easy-number-separator/easy-number-separator.js') }}"></script>

<!-- Page level custom scripts -->
@include('template.footjs.kepegawaian.datatables')
@include('template.footjs.kepegawaian.tooltip')
@include('template.footjs.modal.post_edit')
@include('template.footjs.modal.get_delete')
@endsection