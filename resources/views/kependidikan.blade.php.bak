@extends('template.main.master')

@section('title')
Dasbor
@endsection

@section('sidebar')
@include('template.sidebar.kependidikan')
@endsection

@section('topbarpenilaian')
@include('template.topbar.gurumapel')
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
</div>
<!-- Semua -->
<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Laki-laki ({{$namaunit}})</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlsiswalaki}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-brand-purple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Perempuan ({{$namaunit}})</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlsiswacewe}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-brand-purple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Kelas ({{$namaunit}}) {{$tahun->academic_year}}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlkelas}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-brand-green"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pelajaran ({{$namaunit}})</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$jmlmapel}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@if($unit == 5)
<!-- TK -->
<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Laki-laki (TK)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlsiswalaki1}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-brand-purple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Perempuan (TK)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlsiswacewe1}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-brand-purple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Kelas (TK) {{$tahun->academic_year}}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlkelas1}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-brand-green"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pelajaran (TK)</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$jmlmapel1}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- SD -->
<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Laki-laki (SD)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlsiswalaki2}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-brand-purple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Perempuan (SD)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlsiswacewe2}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-brand-purple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Kelas (SD) {{$tahun->academic_year}}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlkelas2}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-brand-green"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pelajaran (SD)</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$jmlmapel2}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- SMP -->
<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Laki-laki (SMP)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlsiswalaki3}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-brand-purple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Perempuan (SMP)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlsiswacewe3}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-brand-purple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Kelas (SMP) {{$tahun->academic_year}}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlkelas3}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-brand-green"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pelajaran (SMP)</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$jmlmapel3}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- SMA -->
<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Laki-laki (SMA)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlsiswalaki4}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-brand-purple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Perempuan (SMA)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlsiswacewe4}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-brand-purple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Kelas (SMA) {{$tahun->academic_year}}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jmlkelas4}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-brand-green"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pelajaran (SMA)</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$jmlmapel4}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
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