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
    <h1 class="h3 mb-0 text-gray-800">Laporan SPP Siswa</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Pembayaran Uang Sekolah</a></li>
        <li class="breadcrumb-item active" aria-current="page">Laporan SPP Siswa</li>
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
                        Rp {{$plan?number_format($plan->total_plan):'0'}}
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
                        Rp {{$plan?number_format($plan->total_get):'0'}} 
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
                        Rp {{$plan?number_format($plan->total_plan - $plan->total_get):'0'}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <div class="icon-circle bg-brand-green">
                        <i class="mdi mdi-file-document-outline mdi-24px text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">Jumlah Siswa Lunas</div>
                        <h6 class="mb-0">{{$plan?number_format($plan->total_student - $plan->student_remain):'0'}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <div class="icon-circle bg-brand-green">
                        <i class="mdi mdi-file-document-outline mdi-24px text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">Jumlah Siswa Belum Lunas</div>
                        <h6 id="summary" class="mb-0">{{$plan?number_format($plan->student_remain):'0'}} ({{$plan?($plan->student_remain/$plan->total_student)*100:'0'}}%)</h6>
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
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('laporan-spp-siswa-filter')}}" method="POST">
                        @csrf
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-3 control-label">Tahun</label>
                                <div class="col-sm-5">
                                    <select name="year" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        <option value="2021" {{$year=="2021"?'selected':''}}>2021</option>
                                        <option value="2020" {{$year=="2020"?'selected':''}}>2020</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-3 control-label">Bulan</label>
                                <div class="col-sm-5">
                                    <select name="month" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        <option value="0">Semua</option>
                                        <option value="01" {{$month=='01'?'selected':''}}>Januari</option>
                                        <option value="02" {{$month=='02'?'selected':''}}>Februari</option>
                                        <option value="03" {{$month=='03'?'selected':''}}>Maret</option>
                                        <option value="04" {{$month=='04'?'selected':''}}>April</option>
                                        <option value="05" {{$month=='05'?'selected':''}}>Mei</option>
                                        <option value="06" {{$month=='06'?'selected':''}}>Juni</option>
                                        <option value="07" {{$month=='07'?'selected':''}}>Juli</option>
                                        <option value="08" {{$month=='08'?'selected':''}}>Agustus</option>
                                        <option value="09" {{$month=='09'?'selected':''}}>September</option>
                                        <option value="10" {{$month=='10'?'selected':''}}>Oktober</option>
                                        <option value="11" {{$month=='11'?'selected':''}}>November</option>
                                        <option value="12" {{$month=='12'?'selected':''}}>Desember</option>
                                    </select>
                                </div>
                            </div>
                            @if (auth()->user()->pegawai->unit_id == 5)
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-3 control-label">Unit</label>
                                <div class="col-sm-5">
                                    <select name="unit_id" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        <option value="1" {{$unit_id==1?'selected':''}}>TK</option>
                                        <option value="2" {{$unit_id==2?'selected':''}}>SD</option>
                                        <option value="3" {{$unit_id==3?'selected':''}}>SMP</option>
                                        <option value="4" {{$unit_id==4?'selected':''}}>SMA</option>
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-3 control-label">Tingkat Kelas</label>
                                <div class="col-sm-5">
                                    <select name="level" class="select2 form-control select2-hidden-accessible auto_width" id="kelas" style="width:100%;" tabindex="-1" aria-hidden="true">
                                        <option value="semua" {{$level=='semua'?'selected':''}}>Semua</option>
                                        @foreach( $levels as $tingkat)
                                            <option value="{{$tingkat->id}}" {{$level==$tingkat->id?'selected':''}}>{{$tingkat->level}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-brand-purple-dark btn-sm" type="submit">Saring</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-brand-purple">Laporan SPP Siswa</h6>
                            <div class="float-right">
                                @if ($level != 'semua')
                                <button class="m-0 btn btn-brand-purple-dark btn-sm" data-toggle="modal" data-target="#AturModal">Atur Sekaligus <i class="fas fa-cogs"></i></button>
                                @endif
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
                                    <th>Nominal</th>
                                    <th>Potongan</th>
                                    <th>Terbayar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->siswa->student_nis}}</td>
                                    <td>{{$data->siswa->identitas->student_name}}</td>
                                    <td>{{number_format($data->spp_nominal)}}</td>
                                    <td>{{number_format($data->deduction_nominal)}}</td>
                                    <td>{{number_format($data->spp_paid)}}</td>
                                    <td>{{$data->status=='0'?'Belum':'Lunas'}}</td>
                                    <td>
                                        <button class="m-0 btn btn-warning btn-sm" data-toggle="modal" data-target="#PotonganModal" data-id="{{$data->id}}" data-name="{{$data->siswa->student_name}}" data-potongan="{{$data->deduction_nominal}}"><i class="fas fa-cogs"></i></button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="AturModal" tabindex="-1" role="dialog" aria-labelledby="TambahModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
  
          <form action="{{route('laporan-spp-siswa-filter-atur')}}"  method="POST">
          @csrf
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Atur Sekaligus</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="form-group row">
                      <label for="spp" class="col-sm-3 control-label">SPP</label>
                      <div class="col-sm-8">
                          <input type="text" name="spp" class="form-control number-separator">
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <input type="hidden" name="year" value="{{$year}}">
                  <input type="hidden" name="month" value="{{$month}}">
                  <input type="hidden" name="level" value="{{$level}}">
                  <button type="submit" class="btn btn-primary">Atur</button>
              </div>
          </form>
      </div>
    </div>
  </div>


<!-- Modal Tambah -->
<div class="modal fade" id="PotonganModal" tabindex="-1" role="dialog" aria-labelledby="PotonganModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
  
          <form action="{{route('laporan-spp-siswa-filter-atur')}}"  method="POST">
        @method('PUT')
          @csrf
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Ubah Potongan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="form-group row">
                      <label for="potongan" class="col-sm-3 control-label">Nama</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id="name" value="" disabled>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="potongan" class="col-sm-3 control-label">Potongan</label>
                      <div class="col-sm-8">
                          <input type="text" id="potongan" name="potongan" class="form-control number-separator">
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <input type="hidden" id="id" name="id" value="">
                  <button type="submit" class="btn btn-primary">Atur</button>
              </div>
          </form>
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

<script src="{{ asset('vendor/easy-number-separator/easy-number-separator.js') }}"></script>
<!-- Page level custom scripts -->

<script>
    $(document).ready(function()
    {
        $('#PotonganModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var name = button.data('name') // Extract info from data-* attributes
            var potongan = button.data('potongan') // Extract info from data-* attributes
            var modal = $(this)
            console.log(name)
            modal.find('input[id="id"]').val(id)
            modal.find('input[id="name"]').val(name)
            modal.find('input[id="potongan"]').val(potongan)
        })
    })
</script>
@include('template.footjs.kbm.datatables')
@endsection