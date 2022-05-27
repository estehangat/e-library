@extends('penilaian.iku_edukasi_persen_index')

@section('ledger')
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-brand-purple">Daftar Kelas</h6>
            </div>
            <div class="card-body p-3">
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
                @if(count($kelasList) > 0)
                <div class="table-responsive">
                    <table id="dataTable" class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th rowspan="3">Kelas</th>
                                @php
                                $competences = $refIklas->groupBy('competence')->keys()->all();
                                @endphp
                                @foreach($competences as $c)
                                @php
                                $categoryCount = $refIklas->where('competence',$c)->count();
                                @endphp
                                <th colspan="{{ $categoryCount > 0 ? $categoryCount : '1'}}">{{ $c }}</th>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($refIklas as $i)
                                <th>{{ $i->categoryNumber.' '.$i->category }}</th>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($refIklas as $i)
                                <th>Prosentase Pencapaian</th>
                                @endforeach
                        </thead>
                        <tbody>
                            @php
                            $levelActive = null;
                            @endphp
                            @foreach($kelasList->sortBy('levelName')->all() as $k)
                            <tr>
                                <td>{{ $k->levelName }}</td>
                                @foreach($refIklas as $i)
                                @php
                                $nilai = $classes ? $classes->where('id',$k->id)->where('iklas_ref_id',$i->id)->first() : null;
                                @endphp
                                <td>
                                    @if($nilai)
                                    {{ $nilai['percentage'].'%' }}
                                    @else
                                    {{ '-' }}
                                    @endif
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center mx-3 mt-4 mb-5">
                    <h3 >Mohon Maaf,</h3>
                    <h6 class="font-weight-light mb-3">Tidak ada data kelas yang ditemukan</h6>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
