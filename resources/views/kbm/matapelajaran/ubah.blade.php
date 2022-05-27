@extends('template.main.master')

@section('title')
Ubah Mata Pelajaran
@endsection

@section('sidebar')
@include('template.sidebar.kependidikan')
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Mata Pelajaran</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Belajar Mengajar</a></li>
        <li class="breadcrumb-item"><a href="/kependidikan/kbm/nama-kelas">Mata Pelajaran</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
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
                <form action="{{ $mapel->id }}"  method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label for="kelompok" class="col-sm-4 control-label">Nama Mata Pelajaran</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_mapel" placeholder="Nama Mata Pelajaran" value="{{ $mapel->subject_name }} {{ $mapel->is_mulok==1?'(Mulok)':'' }}" disabled>
                            </div>
                        </div>
                        @if($unit !==1)
                        <div class="form-group row">
                            <label for="kelompok" class="col-sm-4 control-label">Nomor Mata Pelajaran</label>
                            <div class="col-sm-6">
                            @if( in_array((auth()->user()->role_id), array(1,2)))
                                <input type="text" class="form-control" name="nomor_mapel" placeholder="Nomor" value="{{ $mapel->subject_number }}">
                            @else
                                <input type="text" class="form-control" name="nomor_mapel" placeholder="Nomor" value="{{ $mapel->subject_number }}" disabled>
                            @endif
                            </div>
                        </div>
                        @endif
                        @if( in_array((auth()->user()->role_id), array(1,2)))
                        @if($unit == 2)
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 control-label">Kelas</label>
                            <div class="col-sm-6">
                                @foreach($levels as $index => $level)
                                <div class="custom-control custom-checkbox">
                                @if( $mapellevels->contains($level->id) )
                                    <input type="checkbox" class="custom-control-input" id="customCheck{{ $index+1 }}" name="kelas[]" value="{{ $level->id }}" checked>
                                @else
                                    <input type="checkbox" class="custom-control-input" id="customCheck{{ $index+1 }}" name="kelas[]" value="{{ $level->id }}">
                                @endif
                                    <label class="custom-control-label" for="customCheck{{ $index+1 }}">{{ $level->level }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @endif
                        @if($unit == 2 || $unit == 4)
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 control-label">Muatan Lokal ?</label>
                            <div class="col-sm-6">
                                <select name="mulok" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                    <option value="0" {{$mapel->is_mulok==0?'selected':''}}>Bukan</option>
                                    <option value="1" {{$mapel->is_mulok==1?'selected':''}}>Ya</option>
                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-4 control-label">Kelompok</label>
                            <div class="col-sm-6">
                            @if( in_array((auth()->user()->role_id), array(1,2)))
                                <select name="kmp_id" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                @foreach( $kmplists as $kmp )
                                @if( $mapel->group_subject_id == $kmp->id )
                                    <option value="{{ $kmp->id }}" selected>{{ $kmp->group_subject_name }}</option>
                                @else
                                    <option value="{{ $kmp->id }}">{{ $kmp->group_subject_name }}</option>
                                @endif
                                @endforeach
                                </select>
                            @else
                                <select name="kmp_id" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true" disabled>
                                @foreach( $kmplists as $kmp )
                                @if( $mapel->group_subject_id == $kmp->id )
                                    <option value="{{ $kmp->id }}" selected>{{ $kmp->group_subject_name }}</option>
                                @else
                                    <option value="{{ $kmp->id }}">{{ $kmp->group_subject_name }}</option>
                                @endif
                                @endforeach
                                </select>
                            @endif
                            </div>
                        </div>
                        
                        @if($unit !==1)
                        <div class="form-group row">
                            <label for="kelompok" class="col-sm-4 control-label">KKM</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="kkm" placeholder="85" value="{{ $kkm }}">
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