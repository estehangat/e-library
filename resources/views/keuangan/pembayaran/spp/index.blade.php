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
    <h1 class="h3 mb-0 text-gray-800">Sumbangan Pembinaan Pendidikan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Pembayaran Uang Sekolah</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sumbangan Pembinaan Pendidikan</li>
    </ol>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('spp-siswa-filter')}}" method="POST">
                        @csrf
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
                                <label for="kelas" class="col-sm-3 control-label">Tingkat Kelas</label>
                                <div class="col-sm-5">
                                    <select name="level" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        <option value="semua">Semua</option>
                                        @foreach( $levels as $tingkat)
                                            <option value="{{$tingkat->id}}" {{$tingkat->id==$level?'selected':''}}>{{$tingkat->level}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-brand-purple-dark btn-sm" type="submit">Saring</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-brand-purple">Sumbangan Pembinaan Pendidikan</h6>
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
                                    <th>NIPD</th>
                                    <th>Nama</th>
                                    <th>SPP Keseluruhan</th>
                                    <th>Potongan Keseluruhan</th>
                                    <th>SPP Terbayar</th>
                                    <th>Tanggungan Keseluruhan Setelah Potongan</th>
                                    <th>Deposit SPP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lists as $list)
                                <tr>
                                    <td>{{$list->student_nis}}</td>
                                    <td>{{$list->student_name}}</td>
                                    @if($list->spp)
                                    <td>Rp {{number_format($list->spp->total)}}</td>
                                    <td>Rp {{number_format($list->spp->deduction)}}</td>
                                    <td>Rp {{number_format($list->spp->paid)}}</td>
                                    <td>Rp {{number_format($list->spp->total-($list->spp->paid+$list->spp->deduction))}}</td>
                                    {{-- <td>Rp {{number_format($list->spp->remain)}}</td> --}}
                                    <td>Rp {{number_format($list->spp->saldo)}}</td>
                                    @else
                                    <td>gada</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    @endif
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
@endsection