<div class="sidebar-heading">
    Penilaian
</div>
<li class="nav-item {{ (request()->is('kependidikan/penilaiankepsek*')) || request()->routeIs('mapel.keterampilan*') || request()->routeIs('penilaian.sikap*') || request()->routeIs('penilaian.tilawah*')  || request()->routeIs('penilaian.hafalan*')? 'active' : '' }}">
    <a class="nav-link {{ (request()->is('kependidikan/penilaiankepsek*')) || request()->routeIs('mapel.keterampilan*') || request()->routeIs('penilaian.sikap*') || request()->routeIs('penilaian.tilawah*') || request()->routeIs('penilaian.hafalan*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseRapor" aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="mdi mdi-file-document"></i>
        <span>LTS dan Rapor</span>
    </a>
    <div id="collapseRapor" class="collapse {{ (request()->is('kependidikan/penilaiankepsek*')) || request()->routeIs('mapel.pengetahuan*') ||  request()->routeIs('mapel.keterampilan*') || request()->routeIs('penilaian.sikap*') || request()->routeIs('penilaian.tilawah*') || request()->routeIs('penilaian.hafalan*') ? 'show' : '' }}" aria-labelledby="headingRapor" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @if(auth()->user()->pegawai->unit_id != 1 && auth()->user()->role->name != 'wakasek')
            <a class="collapse-item {{ request()->routeIs('mapel.pengetahuan*') ? 'active' : '' }}" href="{{ route('mapel.pengetahuan.index') }}"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Pengetahuan</a>
			<a class="collapse-item {{ request()->routeIs('mapel.keterampilan*') ? 'active' : '' }}" href="{{ route('mapel.keterampilan.index') }}"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Keterampilan</a>
			<a class="collapse-item {{ request()->routeIs('penilaian.sikap*') ? 'active' : '' }}" href="{{ route('penilaian.sikap.index') }}"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Sikap</a>
            <!-- <a class="collapse-item {{ request()->routeIs('penilaian.tilawah*') ? 'active' : '' }}" href="{{ route('penilaian.tilawah.index') }}"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Tilawah</a>
			<a class="collapse-item {{ request()->routeIs('penilaian.hafalan*') ? 'active' : '' }}" href="{{ route('penilaian.hafalan.index') }}"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Hafalan</a> -->
			@endif
            <a class="collapse-item {{ (Request::path()=='kependidikan/penilaiankepsek/pts') ? 'active' : '' }}" href="kependidikan/penilaiankepsek/pts"><i class="mdi mdi-text-box" aria-hidden="true"></i> Laporan TS</a>
            <a class="collapse-item {{ (Request::path()=='kependidikan/penilaiankepsek/pas') ? 'active' : '' }}" href="kependidikan/penilaiankepsek/pas"><i class="mdi mdi-book-open-page-variant" aria-hidden="true"></i> Rapor</a>
            <hr class="sidebar-divider">
            <a class="collapse-item {{ (Request::path()=='kependidikan/penilaiankepsek/tanggalrapor') ? 'active' : '' }}" href="kependidikan/penilaiankepsek/tanggalrapor"><i class="mdi mdi-cog" aria-hidden="true"></i> Tanggal Rapor</a>
            @if(auth()->user()->pegawai->unit_id != 1)
            <a class="collapse-item {{ (Request::path()=='kependidikan/penilaiankepsek/rangepredikat') ? 'active' : '' }}" href="kependidikan/penilaiankepsek/rangepredikat"><i class="mdi mdi-cog" aria-hidden="true"></i> Range Nilai Predikat</a>
            @if(auth()->user()->role->name != 'wakasek')
            <a class="collapse-item {{ (Request::path()=='kependidikan/penilaiankepsek/passwordverifikasi') ? 'active' : '' }}" href="kependidikan/penilaiankepsek/passwordverifikasi"><i class="mdi mdi-cog" aria-hidden="true"></i> Password Verifikasi</a>
            @endif
            @endif
            @if(auth()->user()->pegawai->unit_id == 1)
            <a class="collapse-item {{ (Request::path()=='kependidikan/penilaiankepsek/tk/aspekperkembangan') ? 'active' : '' }}" href="kependidikan/penilaiankepsek/tk/aspekperkembangan"><i class="mdi mdi-cog" aria-hidden="true"></i> Aspek Perkembangan</a>
            @endif
        </div>
    </div>
</li>

@if(auth()->user()->pegawai->unit_id != 1)
<li class="nav-item {{ (request()->is('kependidikan/ijazahkepsek*')) ? 'active' : '' }}">
    <a class="nav-link {{ (request()->is('kependidikan/ijazakepsek*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseIjazah" aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="mdi mdi-file-star"></i>
        <span>Ijazah</span>
    </a>
    <div id="collapseIjazah" class="collapse {{ (request()->is('kependidikan/ijazahkepsek*')) ? 'show' : '' }}" aria-labelledby="headingIjazah" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ (Request::path()=='kependidikan/ijazahkepsek/refijazah') ? 'active' : '' }}" href="kependidikan/ijazahkepsek/refijazah"><i class="mdi mdi-checkbox-marked-circle" aria-hidden="true"></i> Referensi Ijazah</a>
        </div>
    </div>
</li>
<!-- <li class="nav-item {{ (Request::path()=='kependidikan/sertifiklaskepsek') ? 'active' : '' }}">
    <a class="nav-link" href="/kependidikan/sertifiklaskepsek">
      <i class="mdi mdi-file-certificate-outline"></i>
      <span>Sertifikat IKLaS</span>
  </a>
</li> -->
<li class="nav-item {{ request()->routeIs('penilaian.ikuEdukasi.persen*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('penilaian.ikuEdukasi.persen') }}">
      <i class="mdi mdi-file-percent"></i>
      <span>IKU Edukasi</span>
  </a>
</li>
@php $menuName = 'Ledger'; @endphp
<li class="nav-item {{ request()->routeIs('penilaian.ikuEdukasi.unit*') || request()->routeIs('penilaian.ikuEdukasi.kelas*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->routeIs('penilaian.ikuEdukasi.unit*') || request()->routeIs('penilaian.ikuEdukasi.kelas*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapse{{ $menuName }}" aria-expanded="{{ request()->routeIs('penilaian.ikuEdukasi.unit*') || request()->routeIs('penilaian.ikuEdukasi.kelas*') ? 'true' : 'false' }}" aria-controls="collapse{{ $menuName }}">
        <i class="mdi mdi-trophy"></i>
        <span>{{ $menuName }}</span>
    </a>
    <div id="collapse{{ $menuName }}" class="collapse {{ request()->routeIs('penilaian.ikuEdukasi.unit*') || request()->routeIs('penilaian.ikuEdukasi.kelas*') ? 'show' : '' }}" aria-labelledby="heading{{ $menuName }}" data-parent="#accordionSidebar" style="">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Ledger</h6>
            <a class="collapse-item {{ request()->routeIs('penilaian.ikuEdukasi.unit*') ? 'active' : '' }}" href="{{ route('penilaian.ikuEdukasi.unit') }}">
              <i class="mdi mdi-office-building"></i>
              <span>Unit</span>
            </a>
            <a class="collapse-item {{ request()->routeIs('penilaian.ikuEdukasi.kelas*') ? 'active' : '' }}" href="{{ route('penilaian.ikuEdukasi.kelas') }}">
              <i class="mdi mdi-book-education"></i>
              <span>Kelas</span>
            </a>
        </div>
    </div>
</li>
@endif
<hr class="sidebar-divider">