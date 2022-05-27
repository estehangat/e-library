@extends('template.main.master')

@section('title')
Sumbangan Pembinaan Pendidikan
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
    <h1 class="h3 mb-0 text-gray-800">Laporan Masukan SPP</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Pembayaran Uang Sekolah</a></li>
        <li class="breadcrumb-item active" aria-current="page">Laporan Masukan SPP</li>
    </ol>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <form action="/keuangan/spp/laporan-masukan-spp" method="get">
                            @if (auth()->user()->pegawai->unit_id == 5)
                                
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-3 control-label">Unit</label>
                                <div class="col-sm-5">
                                    <select name="unit_id" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        <option value="1">TK</option>
                                        <option value="2">SD</option>
                                        <option value="3">SMP</option>
                                        <option value="4">SMA</option>
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-3 control-label">Tahun</label>
                                <div class="col-sm-5">
                                    <select name="tahun" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        <option value="2021" {{$year=="2021"?'selected':''}}>2021</option>
                                        <option value="2020" {{$year=="2020"?'selected':''}}>2020</option>
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
                            <h6 class="m-0 font-weight-bold text-brand-purple">Laporan Masukan SPP</h6>
                            <div class="float-right">
                            </div>
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
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->siswa->student_nis}}</td>
                                    <td>{{$data->siswa->identitas->student_name}}</td>
                                    <td>Rp {{number_format($data->nominal)}}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success"   data-toggle="modal" data-target="#ubahKategori" data-name="{{$data->siswa->student_name}}" data-id="{{$data->id}}"><i class="fa fa-random"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th colspan="3">Total Diterima</th>
                                    <th>Rp 8.500.000</th>
                                </tr>
                            </tfoot> -->
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
                <form action="/keuangan/spp/laporan-masukan-spp/ubah-kategori" method="POST">
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