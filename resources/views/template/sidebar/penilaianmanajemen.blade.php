<div class="sidebar-heading">
    Penilaian
</div>
<li class="nav-item {{ request()->routeIs('penilaian.ikuEdukasi.persen*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('penilaian.ikuEdukasi.persen') }}">
      <i class="mdi mdi-file-percent"></i>
      <span>IKU Edukasi</span>
  </a>
</li>
<li class="nav-item {{ request()->routeIs('penilaian.ikuEdukasi.unit*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('penilaian.ikuEdukasi.unit') }}">
        <i class="mdi mdi-trophy"></i>
        <span>Ledger Unit</span>
    </a>
</li>
<hr class="sidebar-divider">