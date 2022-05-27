@extends('template.main.sidebar')

@section('brand-system')
Kepegawaian @endsection

@section('sidebar-menu')
      <li class="nav-item {{ request()->routeIs('kepegawaian.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kepegawaian.index') }}">
          <i class="mdi mdi-view-dashboard"></i>
          <span>Beranda</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Manajemen Pegawai
      </div>
      <li class="nav-item {{ request()->routeIs('pegawai*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pegawai.index') }}">
          <i class="mdi mdi-account-group"></i>
          <span>Pegawai</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('struktural*') || request()->routeIs('nonstruktural*') ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs('struktural*') || request()->routeIs('nonstruktural*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapsePenempatan" aria-expanded="{{ request()->routeIs('struktural*') || request()->routeIs('nonstruktural*') ? 'true' : 'false' }}" aria-controls="collapsePenempatan">
          <i class="mdi mdi-account-switch"></i>
          <span>Penempatan</span>
        </a>
        <div id="collapsePenempatan" class="collapse {{ request()->routeIs('struktural*') || request()->routeIs('nonstruktural*') ? 'show' : '' }}" aria-labelledby="headingPenempatan" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Penempatan</h6>
            <a class="collapse-item {{ request()->routeIs('struktural*') ? 'active' : '' }}" href="{{ route('struktural.index') }}">
              <i class="mdi mdi-account-tie"></i>
              <span>Struktural</span>
            </a>
            <a class="collapse-item {{ request()->routeIs('nonstruktural*') ? 'active' : '' }}" href="{{ route('nonstruktural.index') }}">
              <i class="mdi mdi-account"></i>
              <span>Nonstruktural</span>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item {{ request()->routeIs('pelatihan.saya*') || request()->routeIs('pelatihan.sertifikat*') ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs('pelatihan.saya*') || request()->routeIs('pelatihan.sertifikat*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapsePelatihan" aria-expanded="{{ request()->routeIs('pelatihan.saya*') || request()->routeIs('pelatihan.sertifikat*') ? 'true' : 'false' }}" aria-controls="collapsePelatihan">
          <i class="mdi mdi-clipboard-arrow-up"></i>
          <span>Pelatihan</span>
        </a>
        <div id="collapsePelatihan" class="collapse {{ request()->routeIs('pelatihan.saya*') || request()->routeIs('pelatihan.sertifikat*') ? 'show' : '' }}" aria-labelledby="headingPelatihan" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pelatihan</h6>
            <a class="collapse-item {{ request()->routeIs('pelatihan.saya*') ? 'active' : '' }}" href="{{ route('pelatihan.saya.index') }}">
              <i class="mdi mdi-calendar-check"></i>
              <span>Pelatihan Saya</span>
            </a>
            <a class="collapse-item {{ request()->routeIs('pelatihan.sertifikat*') ? 'active' : '' }}" href="{{ route('pelatihan.sertifikat.index') }}">
              <i class="mdi mdi-certificate"></i>
              <span>Sertifikat Kompetensi</span>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item {{ request()->routeIs('phk*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('phk.index') }}">
          <i class="mdi mdi-account-multiple-minus"></i>
          <span>Putus Hubungan Kerja</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      @include('template.sidebar.kepegawaian.penilaian_kinerja')
@endsection