@extends('template.main.master')

@section('title')
{{ $active }}
@endsection

@section('headmeta')
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
    <li class="breadcrumb-item"><a href="{{ route($route.'.index') }}">{{ $active }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $data->id }}</li>
  </ol>
</div>

<div class="row mb-4">
  <div class="col-12">
    <div class="card">
      <div class="card-body p-3">
        <div class="row mb-0">
          <div class="col-lg-8 col-md-10 col-12">
            <div class="form-group mb-0">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                  <label class="form-control-label">Tanggal</label>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                  {{ $data->dateId ? $data->dateId : '-' }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-0">
          <div class="col-lg-8 col-md-10 col-12">
            <div class="form-group mb-0">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                  <label class="form-control-label">Nama Proposal</label>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                  {{ $data->title ? $data->title : '-' }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-0">
          <div class="col-lg-8 col-md-10 col-12">
            <div class="form-group mb-0">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                  <label class="form-control-label">Unit</label>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                  {{ $data->unit_id ? $data->unit->name : '-' }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-0">
          <div class="col-lg-8 col-md-10 col-12">
            <div class="form-group mb-0">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                  <label class="form-control-label">Jabatan</label>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                  {{ $data->position_id ? $data->jabatan->name : '-' }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-0">
          <div class="col-lg-8 col-md-10 col-12">
            <div class="form-group mb-0">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                  <label class="form-control-label">Status</label>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                  {{ $data->ppa ? 'Diajukan' : 'Menunggu' }}
                </div>
              </div>
            </div>
          </div>
        </div>
        @if(in_array($role,['ketuayys','direktur','fam','faspv']) && $data->ppa)
        <div class="row mb-0">
          <div class="col-lg-8 col-md-10 col-12">
            <div class="form-group mb-0">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                  <label class="form-control-label">Nomor PPA</label>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                  <a href="{{ route('ppa.show',['jenis' => $data->ppa->ppa->jenisAnggaranAnggaran->jenis->link, 'tahun' => $data->ppa->ppa->academic_year_id ? $data->ppa->ppa->tahunPelajaran->academicYearLink : $data->ppa->ppa->year, 'anggaran' => $data->ppa->ppa->jenisAnggaranAnggaran->anggaran->link, 'nomor' => $data->ppa->ppa->firstNumber]) }}" target="_blank" class="text-decoration-none text-info">{{ $data->ppa->ppa->number }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        <div class="d-flex justify-content-end">
          <a href="{{ route($route.'.index', ['year' => $data->year, 'status' => $data->ppa ? 'diajukan' : 'menunggu']) }}" class="btn btn-sm btn-light">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <div class="icon-circle {{ $data && $data->details()->withTrashed()->count() > 0 ? 'bg-brand-green' : 'bg-secondary' }}">
                          <i class="fas fa-calculator text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">Total Jumlah</div>
                        <h6 id="summary" class="mb-0">
                            @if($data && $data->details()->withTrashed()->count() > 0)
                            {{ $data->totalValueOriWithSeparator }}
                            @else
                            0
                            @endif
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($editable)
<div class="row mb-4">
  <div class="col-12">
    <div class="card shadow">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-brand-purple">Tambah Pengajuan</h6>
      </div>
      <div class="card-body px-4 py-3">
        <form action="{{ route($route.'.detail.store',['id' => $id]) }}" id="addItemForm" method="post" enctype="multipart/form-data" accept-charset="utf-8">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-lg-10 col-md-12">
              <div class="form-group">
                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label for="normal-input" class="form-control-label">Deskripsi</label>
                  </div>
                  <div class="col-lg-9 col-md-8 col-12">
                    <input type="text" id="desc" class="form-control form-control-sm @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" maxlength="255"  required="required">
                    @error('desc')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-10 col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label for="normal-input" class="form-control-label">Harga</label>
                  </div>
                  <div class="col-lg-6 col-md-8 col-12">
                    <input type="text" id="price" class="form-control form-control-sm @error('price') is-invalid @enderror number-separator" name="price" value="{{ old('price') ? old('price') : '0' }}" maxlength="15" required="required">
                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-10 col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label for="normal-input" class="form-control-label">Jumlah</label>
                  </div>
                  <div class="col-lg-6 col-md-8 col-12">
                    <input type="text" id="qty" class="form-control form-control-sm @error('qty') is-invalid @enderror number-separator" name="qty" value="{{ old('qty') ? old('qty') : '1' }}" maxlength="10" required="required">
                    @error('qty')
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
        <h6 class="m-0 font-weight-bold text-brand-purple">Rincian Proposal</h6>
      </div>
      @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
        <strong>Sukses!</strong> {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if(Session::has('danger'))
      <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
        <strong>Gagal!</strong> {{ Session::get('danger') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if($data && $data->details()->withTrashed()->count() > 0)
      @if($editable)
      <form action="{{ route($route.'.detail.update.all',['id' => $data->id]) }}" id="proposal-form" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
      @endif
        <div class="table-responsive">
          <table id="proposalDetails" class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th style="width: 50px">#</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Kuantitas</th>
                <th>Subtotal</th>
                @if($editable)
                <th style="width: 120px">Aksi</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($data->details()->withTrashed()->get() as $d)
              <tr id="p-{{ $d->id }}">
                <td>{{ $no++ }}</td>
                @if($editable)
                <td class="detail-desc">{{ $d->desc }}</td>
                <td class="detail-price"><input name="price-{{ $d->id }}" type="text" class="form-control form-control-sm number-separator" value="{{ $d->priceOriWithSeparator }}"></td>
                <td class="detail-qty"><input name="qty-{{ $d->id }}" type="text" class="form-control form-control-sm number-separator" value="{{ $d->quantityOriWithSeparator }}"></td>
                @else
                <td>{{ $d->desc }}</td>
                <td>{{ $d->priceOriWithSeparator }}</td>
                <td>{{ $d->quantityOriWithSeparator }}</td>
                @endif
                <td class="detail-value">{{ $d->valueOriWithSeparator }}</td>
                @if($editable)
                <td>
                  <button type="button" class="btn btn-sm btn-warning btn-edit" data-toggle="modal" data-target="#edit-form">
                    <i class="fa fa-pen"></i>
                  </button>
                  <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-confirm" onclick="deleteModal('{{ $active }}', '{!! addslashes(htmlspecialchars($d->desc)) !!}', '{{ route($route.'.detail.destroy', ['id' => $id, 'item' => $d->id]) }}')"><i class="fas fa-trash"></i></a>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          @if($editable)
          <div class="row">
            <div class="col-12">
              <div class="text-center">
                <button class="btn btn-brand-purple-dark" type="submit">Simpan</button>
              </div>
            </div>
          </div>
          @endif
        </div>
      </form>
      @else
      <div class="text-center mx-3 my-5">
        <h3 class="text-center">Mohon Maaf,</h3>
        <h6 class="font-weight-light mb-3">Tidak ada data {{ strtolower($active) }} yang ditemukan</h6>
      </div>
      <div class="card-footer"></div>
      @endif
    </div>
  </div>
</div>
<!--Row-->

@if($editable)
<div class="modal fade" id="edit-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-brand-purple border-0">
        <h5 class="modal-title text-white">Ubah Pengajuan</h5>
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
        <form action="{{ route($route.'.detail.update', ['id' => $data->id]) }}" id="editProposalDetailForm" method="post" enctype="multipart/form-data" accept-charset="utf-8">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <input type="hidden" name="editId">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <div class="row mb-3">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label for="normal-input" class="form-control-label">Deskripsi</label>
                  </div>
                  <div class="col-lg-9 col-md-8 col-12">
                    <input type="text" id="editDesc" class="form-control form-control-sm @error('editDesc') is-invalid @enderror" name="editDesc" value="{{ old('editDesc') }}" maxlength="255" required="required">
                    @error('editDesc')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label for="normal-input" class="form-control-label">Harga</label>
                  </div>
                  <div class="col-lg-6 col-md-8 col-12">
                    <input type="text" id="editPrice" class="form-control form-control-sm @error('editPrice') is-invalid @enderror number-separator" name="editPrice" value="0" maxlength="15" required="required">
                    @error('editPrice')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label for="normal-input" class="form-control-label">Jumlah</label>
                  </div>
                  <div class="col-lg-6 col-md-8 col-12">
                    <input type="text" id="editQty" class="form-control form-control-sm @error('editQty') is-invalid @enderror number-separator" name="editQty" value="1" maxlength="10" required="required">
                    @error('editQty')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-1">
            <div class="col-12">
              <div class="row">
                <div class="col-lg-9 offset-lg-3 col-md-8 offset-md-4 col-12 text-left">
                  <input type="submit" class="btn btn-sm btn-brand-purple-dark" value="Simpan">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@include('template.modal.konfirmasi_hapus')

@endif

@endsection

@section('footjs')
<!-- Plugins and scripts required by this view-->

<!-- Page level plugins -->

<!-- Easy Number Separator JS -->
<script src="{{ asset('vendor/easy-number-separator/easy-number-separator.js') }}"></script>

<!-- Page level custom scripts -->
@include('template.footjs.kepegawaian.tooltip')
@if($editable)
@include('template.footjs.modal.get_delete')
@include('template.footjs.modal.proposal_edit')
@endif
@endsection