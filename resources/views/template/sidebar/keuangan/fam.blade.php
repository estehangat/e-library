@extends('template.main.sidebar')

@section('brand-system')
Keuangan @endsection

@section('sidebar-menu')
      <li class="nav-item {{ request()->routeIs('keuangan.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('keuangan.index') }}">
          <i class="mdi mdi-view-dashboard"></i>
          <span>Beranda</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Pengelolaan Keuangan
      </div>
      <li class="nav-item {{ request()->routeIs('rkat*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('rkat.index') }}">
          <i class="mdi mdi-file-edit"></i>
          <span>RKAT</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('apby*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('apby.index') }}">
          <i class="mdi mdi-cart"></i>
          <span>APB</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('ppa*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('ppa.index') }}">
          <i class="mdi mdi-inbox-arrow-up"></i>
          <span>PPA</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('ppb*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('ppb.index') }}">
          <i class="mdi mdi-bank-transfer-out"></i>
          <span>PPB</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('lppa*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lppa.index') }}">
          <i class="mdi mdi-text-box-check"></i>
          <span>RPPA</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('realisasi*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('realisasi.index') }}">
          <i class="mdi mdi-file-chart"></i>
          <span>Realisasi</span>
        </a>
      </li>
      <hr class="sidebar-divider">
	  <div class="sidebar-heading">
        Pengelolaan Anggaran
      </div>
      <li class="nav-item {{ request()->routeIs('keuangan.akun*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('keuangan.akun.index') }}">
          <i class="mdi mdi-playlist-edit"></i>
          <span>Akun</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      @include('template.sidebar.keuangan.pembayaran')
@endsection