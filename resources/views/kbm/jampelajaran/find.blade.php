@extends('template.main.master')


@section('title')
Jam Pelajaran
@endsection


@section('sidebar')
@include('template.sidebar.kependidikan')
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Jam Pelajaran</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Belajar Mengajar</a></li>
        <li class="breadcrumb-item active" aria-current="page">Jam Pelajaran</li>
    </ol>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-body">
                @if(Session::has('sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ Session::get('sukses') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <form action="/kependidikan/kbm/pelajaran/waktu-pelajaran" method="POST">
                        @csrf
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-3 control-label">Hari</label>
                                <div class="col-sm-4">
                                    <select name="hari" class="select2 form-control select2-hidden-accessible auto_width" id="hari" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        <option value="">== Pilih Hari ==</option>
                                        @if( $hari=='Senin')
                                        <option value="Senin" selected>Senin</option>
                                        @else
                                        <option value="Senin">Senin</option>
                                        @endif
                                        @if( $hari=='Selasa')
                                        <option value="Selasa" selected>Selasa</option>
                                        @else
                                        <option value="Selasa">Selasa</option>
                                        @endif
                                        @if( $hari=='Rabu')
                                        <option value="Rabu" selected>Rabu</option>
                                        @else
                                        <option value="Rabu">Rabu</option>
                                        @endif
                                        @if( $hari=='Kamis')
                                        <option value="Kamis" selected>Kamis</option>
                                        @else
                                        <option value="Kamis">Kamis</option>
                                        @endif
                                        @if( $hari=="Jum'at")
                                        <option value="Jum'at" selected>Jum'at</option>
                                        @else
                                        <option value="Jum'at">Jum'at</option>
                                        @endif
                                        @if( $hari=="Sabtu")
                                        <option value="Sabtu" selected>Sabtu</option>
                                        @else
                                        <option value="Sabtu">Sabtu</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-3 control-label">Kelas</label>
                                <div class="col-sm-4">
                                    <select name="level" class="select2 form-control select2-hidden-accessible auto_width" id="hari" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        <option value="">== Pilih Kelas ==</option>
                                        @foreach($levels as $level)
                                            @if($tingkat==$level->id)
                                                <option value="{{$level->id}}" selected>{{$level->level}}</option> 
                                            @else
                                                <option value="{{$level->id}}">{{$level->level}}</option> 
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-brand-purple-dark">Cari</button>
                            </div>
                            <div class="text-center mt-4">
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Jam Ke</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Keterangan</th>
                                    @if( in_array((auth()->user()->role_id), array(1,2)))
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach( $jams as $index => $jam )
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{Carbon\Carbon::parse($jam->hour_start)->format('H:i')}}</td>
                                    <td>{{Carbon\Carbon::parse($jam->hour_end)->format('H:i')}}</td>
                                    <td>{{$jam->description}}</td>
                                    @if( in_array((auth()->user()->role_id), array(1,2)))
                                    <td><button href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#UbahModal{{$jam->id}}"><i class="fas fa-pen"></i></button>&nbsp;
                                    
                                    @if($jam->jadwalpelajarans()->count()>0)
                                    <button href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash" data-toggle="modal" data-target="#HapusModal{{$jam->id}}" disabled></i></button>
                                    @else
                                    <button href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash" data-toggle="modal" data-target="#HapusModal{{$jam->id}}"></i></button>
                                    @endif
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-brand-purple-dark" data-toggle="modal" data-target="#TambahModal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>


@if( in_array((auth()->user()->role_id), array(1,2,3)))
@foreach( $jams as $index => $jam )
<!-- Modal Ubah -->
<div class="modal fade" id="UbahModal{{$jam->id}}" tabindex="-1" role="dialog" aria-labelledby="HapusModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

        <form action="/kependidikan/kbm/pelajaran/waktu-pelajaran/ubah/{{$jam->id}}"  method="POST">
        @method('PUT')
        @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ubah Jam Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="academic_year_start" class="col-sm-6 control-label">Hari {{$hari}} Kelas {{$kelas->level}} Jam ke-</label>
                </div>
                <div class="form-group row">
                    <label for="Mulai" class="col-sm-4 control-label">Mulai</label>
                    <div class="col-sm-5">
                        <input type="time" name="mulai" class="form-control" value="{{$jam->hour_start}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Selesai" class="col-sm-4 control-label">Selesai</label>
                    <div class="col-sm-5">
                        <input type="time" name="selesai" class="form-control" value="{{$jam->hour_end}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Keterangan" class="col-sm-4 control-label">Keterangan</label>
                    <div class="col-sm-5">
                        <input type="text" name="Keterangan" class="form-control" value="{{$jam->description}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">Ubah</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- Modal Hapus -->
<div id="HapusModal{{$jam->id}}" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title w-100">Apakah Anda yakin?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan menghapus data yang dipilih?.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="/kependidikan/kbm/pelajaran/waktu-pelajaran/hapus/{{$jam->id}}" " method="POST">
                    @csrf
                    <input type="hidden" id="hapusid" name="id">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Tambah -->
<div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="HapusModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

        <form action="/kependidikan/kbm/pelajaran/waktu-pelajaran/tambah"  method="POST">
        @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jam Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="academic_year_start" class="col-sm-6 control-label">Hari {{$hari}} Kelas {{$kelas->level}}</label>
                </div>
                <div class="form-group row">
                    <label for="Mulai" class="col-sm-4 control-label">Mulai</label>
                    <div class="col-sm-5">
                        <input type="time" name="mulai" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Selesai" class="col-sm-4 control-label">Selesai</label>
                    <div class="col-sm-5">
                        <input type="time" name="selesai" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Keterangan" class="col-sm-4 control-label">Keterangan</label>
                    <div class="col-sm-5">
                        <input type="text" name="Keterangan" class="form-control" value="-">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <input type="text" hidden value="{{$hari}}" name="hari">
            <input type="text" hidden value="{{$tingkat}}" name="level">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endif
<!--Row-->
@endsection

@section('footjs')
<!-- Plugins and scripts required by this view-->
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
@endsection