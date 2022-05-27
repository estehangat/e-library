@extends('template.main.master')

@section('title')
Tambah Mata Pelajaran
@endsection

@section('sidebar')
@include('template.sidebar.kependidikan')
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Mata Pelajaran</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Belajar Mengajar</a></li>
        <li class="breadcrumb-item"><a href="/kependidikan/kbm/nama-kelas">Mata Pelajaran</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
    </ol>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-body">
                @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form action="tambah"  method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label for="kelompok" class="col-sm-4 control-label">Nama Mata Pelajaran</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_mapel" placeholder="Nama Mata Pelajaran">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelompok" class="col-sm-4 control-label">Kode Mata Pelajaran</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="kode_mapel" placeholder="Kode Mata Pelajaran">
                            </div>
                        </div>
                        @if($unit !==1)
                        <div class="form-group row">
                            <label for="kelompok" class="col-sm-4 control-label">Nomor Mata Pelajaran</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="nomor_mapel" placeholder="Nomor">
                            </div>
                        </div>
                        @endif
                        @if($unit == 2)
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 control-label">Kelas</label>
                            <div class="col-sm-6">
                                @foreach($levels as $index => $level)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck{{ $index+1 }}" name="kelas[]" value="{{ $level->id }}">
                                    <label class="custom-control-label" for="customCheck{{ $index+1 }}">{{ $level->level }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @if($unit == 2 || $unit == 4)
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 control-label">Muatan Lokal ?</label>
                            <div class="col-sm-6">
                                <select name="mulok" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                    <option value="0">Bukan</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 control-label">Kelompok</label>
                            <div class="col-sm-6">
                                <select name="kmp_id" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                @foreach( $kmplists as $kmp )
                                    <option value="{{ $kmp->id }}">{{ $kmp->group_subject_name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        @if($unit !==1)
                        <div class="form-group row">
                            <label for="kelompok" class="col-sm-4 control-label">KKM</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="kkm" placeholder="KKM">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-brand-purple-dark">Simpan</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Row-->
@endsection

@section('footjs')
<!-- Plugins and scripts required by this view-->
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
@endsection