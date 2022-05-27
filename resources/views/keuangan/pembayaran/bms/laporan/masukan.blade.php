@extends('template.main.master')

@section('title')
Biaya Masuk Sekolah
@endsection

@section('sidebar')
@php
$role = Auth::user()->role->name;
@endphp
@if(in_array($role,['admin','am','aspv','direktur','etl','etm','fam','faspv','kepsek','pembinayys','ketuayys','wakasek']))
@include('template.sidebar.keuangan.'.$role)
@else
@include('template.sidebar.keuangan.employee')
@endif
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Masukan BMS</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Pembayaran Uang Sekolah</a></li>
        <li class="breadcrumb-item active" aria-current="page">Laporan Masukan BMS</li>
    </ol>
</div>

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body p-0">
                <div class="row align-items-center mx-0">
                    <div class="col-auto px-3 py-2 bg-brand-green">
                        <i class="mdi mdi-file-document-outline mdi-24px text-white"></i>
                    </div>
                    <div class="col">
                        <div class="h6 mb-0 font-weight-bold text-gray-800">Rencana</div>
                        Rp {{number_format($plan->total_plan)}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body p-0">
                <div class="row align-items-center mx-0">
                    <div class="col-auto px-3 py-2 bg-brand-green">
                        <i class="mdi mdi-file-document-outline mdi-24px text-white"></i>
                    </div>
                    <div class="col">
                        <div class="h6 mb-0 font-weight-bold text-gray-800">Realisasi</div>
                        Rp {{number_format($plan->total_get)}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body p-0">
                <div class="row align-items-center mx-0">
                    <div class="col-auto px-3 py-2 bg-brand-green">
                        <i class="mdi mdi-file-document-outline mdi-24px text-white"></i>
                    </div>
                    <div class="col">
                        <div class="h6 mb-0 font-weight-bold text-gray-800">Selisih</div>
                        Rp {{number_format($plan->total_plan-$plan->total_get)}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <form action="/keuangan/bms/laporan-masukan-bms" method="get">
                            @if($unit_id==5)
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-3 control-label">Unit</label>
                                <div class="col-sm-5">
                                    <select name="level" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        <option value="semua">Semua</option>
                                        <option value="1" selected>TK</option>
                                        <option value="2" selected>SD</option>
                                        <option value="3" selected>SMP</option>
                                        <option value="4" selected>SMA</option>
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label for="tahun" class="col-sm-3 control-label">Tahun</label>
                                <div class="col-sm-5">
                                    <select name="tahun" class="select2 form-control select2-hidden-accessible auto_width" id="tahun" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        @foreach ($years as $y)
                                        <option value="{{$y->year}}" {{$year==$y->year?'selected':''}}>{{$y->year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-3 control-label">Bulan</label>
                                <div class="col-sm-5">
                                    <select name="bulan" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        <option value="">Semua</option>
                                        <option value="1" {{$month=='1'?'selected':''}}>Januari</option>
                                        <option value="2" {{$month=='2'?'selected':''}}>Februari</option>
                                        <option value="3" {{$month=='3'?'selected':''}}>Maret</option>
                                        <option value="4" {{$month=='4'?'selected':''}}>April</option>
                                        <option value="5" {{$month=='5'?'selected':''}}>Mei</option>
                                        <option value="6" {{$month=='6'?'selected':''}}>Juni</option>
                                        <option value="7" {{$month=='7'?'selected':''}}>Juli</option>
                                        <option value="8" {{$month=='8'?'selected':''}}>Agustus</option>
                                        <option value="9" {{$month=='9'?'selected':''}}>September</option>
                                        <option value="10" {{$month=='10'?'selected':''}}>Oktober</option>
                                        <option value="11" {{$month=='11'?'selected':''}}>November</option>
                                        <option value="12" {{$month=='12'?'selected':''}}>Desember</option>
                                    </select>
                                </div>
                                <button class="btn btn-brand-purple-dark btn-sm" type="submit">Saring</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-brand-purple">Laporan Masukan BMS</h6>
                        </div>
                        @if(Session::has('sukses'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Sukses!</strong> {{ Session::get('sukses') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <table id="dataTable" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>NIPD</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $lists as $list )
                                <tr>
                                    <td>{{$list->created_at}}</td>
                                    <td>{{$list->siswa->student_nis}}</td>
                                    <td>{{$list->siswa->identitas->student_name}}</td>
                                    <td>Rp {{number_format($list->nominal)}}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success"   data-toggle="modal" data-target="#ubahKategori" data-name="{{$list->siswa->student_name}}" data-id="{{$list->id}}"><i class="fa fa-random"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal ubahKategori -->
<div id="ubahKategori" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="material-icons">&#xe5ca;</i>
                </div>
                <h4 class="modal-title w-100">Apakah Anda yakin?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p id="name">Apakah Anda yakin akan mengubah Kategori?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="/keuangan/bms/laporan-masukan-bms/ubah-kategori" method="POST">
                    @csrf
                    <input type="text" name="id" id="id" class="id" hidden/>
                    <button type="submit" class="btn btn-success">Ya</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Row-->
@endsection

@section('footjs')
<!-- DataTables -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatablestambahan/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/datatablestambahan/jszip.min.js') }}"></script>
<script src="{{ asset('vendor/datatablestambahan/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendor/datatablestambahan/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendor/datatablestambahan/buttons.html5.min.js') }}"></script>
<!-- Page level custom scripts -->
@include('template.footjs.kbm.datatables')

<script>
    $(document).ready(function()
    {
        $('#ubahKategori').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('name') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('input[name="id"]').val(id)
            modal.find('p[id="name"]').text('Apakah Anda yakin akan mengubah kategori transaksi '+name+'?');
        })
    })
</script>
@endsection