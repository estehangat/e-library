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
      <li class="nav-item {{ request()->routeIs('ppa*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('ppa.index') }}">
          <i class="mdi mdi-inbox-arrow-up"></i>
          <span>PPA</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('lppa*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lppa.index') }}">
          <i class="mdi mdi-text-box-check"></i>
          <span>RPPA</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      @include('template.sidebar.keuangan.pembayaran')
@endsection