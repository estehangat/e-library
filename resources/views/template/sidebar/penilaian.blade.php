<div class="sidebar-heading">
    Penilaian <span class="badge badge-primary">Wali Kelas</span>
</div>
<?php
$iswali = App\Models\Kbm\Kelas::where('teacher_id', auth()->user()->pegawai->id)->first();
$semester = App\Models\Kbm\Semester::where('id', session('semester_aktif'))->first();
?>
<li class="nav-item {{ (request()->is('kependidikan/penilaian*')) ? 'active' : '' }}">
    <a class="nav-link {{ (request()->is('kependidikan/penilaian*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseRapor" aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="mdi mdi-file-document"></i>
        <span>LTS dan Rapor</span>
    </a>
    <div id="collapseRapor" class="collapse {{ (request()->is('kependidikan/penilaian*')) ? 'show' : '' }}" aria-labelledby="headingRapor" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <?php if ($iswali->unit_id == 1) { ?>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaiantk/nilaiaspek') ? 'active' : '' }}" href="/kependidikan/penilaiantk/nilaiaspek"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Aspek</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaiantk/nilaiindikator') ? 'active' : '' }}" href="/kependidikan/penilaiantk/nilaiindikator"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Indikator</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/kehadiran') ? 'active' : '' }}" href="/kependidikan/penilaian/kehadiran"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Kehadiran</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/ekstra') ? 'active' : '' }}" href="/kependidikan/penilaian/ekstra"><i class="mdi mdi-plus-circle"></i> Ekstrakurikuler</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/catatanwali') ? 'active' : '' }}" href="/kependidikan/penilaian/catatanwali"><i class="mdi mdi-plus-circle"></i> Catatan</a>
                <?php
                if ($semester->semester == "Genap") {
                ?>
                    <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/kenaikankelas') ? 'active' : '' }}" href="/kependidikan/penilaian/kenaikankelas"><i class="mdi mdi-plus-circle"></i> Kenaikan Kelas</a>
                <?php } ?>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/cetakpts') ? 'active' : '' }}" href="/kependidikan/penilaian/cetakpts"><i class="mdi mdi-printer"></i> Laporan TS</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/cetakpas') ? 'active' : '' }}" href="/kependidikan/penilaian/cetakpas"><i class="mdi mdi-printer"></i> Rapor</a>
                <hr class="sidebar-divider">
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaiantk/descaspek') ? 'active' : '' }}" href="/kependidikan/penilaiantk/descaspek"><i class="mdi mdi-cog" aria-hidden="true"></i> Deskripsi Aspek</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaiantk/indikator') ? 'active' : '' }}" href="/kependidikan/penilaiantk/indikator"><i class="mdi mdi-cog" aria-hidden="true"></i> Indikator Aspek</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaiantk/descindikator') ? 'active' : '' }}" href="/kependidikan/penilaiantk/descindikator"><i class="mdi mdi-cog" aria-hidden="true"></i> Deskripsi Indikator</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/deskripsiekstra') ? 'active' : '' }}" href="/kependidikan/penilaian/deskripsiekstra"><i class="mdi mdi-cog" aria-hidden="true"></i> Deskripsi Ekstra</a>
            <?php } else { ?>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/nilaisikap') ? 'active' : '' }}" href="/kependidikan/penilaian/nilaisikap"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Sikap</a>
                <!-- <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/iklas') ? 'active' : '' }}" href="/kependidikan/penilaian/iklas"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai IKLaS</a> -->
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/kehadiran') ? 'active' : '' }}" href="/kependidikan/penilaian/kehadiran"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Kehadiran</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/ekstra') ? 'active' : '' }}" href="/kependidikan/penilaian/ekstra"><i class="mdi mdi-plus-circle"></i> Ekstrakurikuler</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/prestasi') ? 'active' : '' }}" href="/kependidikan/penilaian/prestasi"><i class="mdi mdi-plus-circle"></i> Prestasi</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/catatanwali') ? 'active' : '' }}" href="/kependidikan/penilaian/catatanwali"><i class="mdi mdi-plus-circle"></i> Catatan</a>
                <?php
                if ($semester->semester == "Genap") {
                ?>
                    <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/kenaikankelas') ? 'active' : '' }}" href="/kependidikan/penilaian/kenaikankelas"><i class="mdi mdi-plus-circle"></i> Kenaikan Kelas</a>
                <?php } ?>

                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/deskripsipts') ? 'active' : '' }}" href="/kependidikan/penilaian/deskripsipts"><i class="mdi mdi-plus-circle"></i> Deskripsi Laporan TS</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/cetakpts') ? 'active' : '' }}" href="/kependidikan/penilaian/cetakpts"><i class="mdi mdi-printer"></i> Laporan TS</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/cetakpas') ? 'active' : '' }}" href="/kependidikan/penilaian/cetakpas"><i class="mdi mdi-printer"></i> Rapor</a>
                <hr class="sidebar-divider">
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/predikatsikap') ? 'active' : '' }}" href="/kependidikan/penilaian/predikatsikap"><i class="mdi mdi-cog" aria-hidden="true"></i> Predikat Nilai Sikap</a>
                <!-- <a class="collapse-item {{ request()->routeIs('predikat.iklas*') ? 'active' : '' }}" href="{{ route('predikat.iklas.index') }}"><i class="mdi mdi-cog" aria-hidden="true"></i> Predikat Nilai IKLaS</a> -->
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/deskripsiekstra') ? 'active' : '' }}" href="/kependidikan/penilaian/deskripsiekstra"><i class="mdi mdi-cog" aria-hidden="true"></i> Deskripsi Ekstra</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/descpts') ? 'active' : '' }}" href="/kependidikan/penilaian/descpts"><i class="mdi mdi-cog" aria-hidden="true"></i> Deskripsi Laporan TS</a>
                <!-- <a class="collapse-item {{ (Request::path()=='kependidikan/penilaian/indikatoriklas') ? 'active' : '' }}" href="/kependidikan/penilaian/indikatoriklas"><i class="mdi mdi-cog" aria-hidden="true"></i> Indikator IKLaS</a> -->
            <?php } ?>
        </div>
    </div>
</li>
<?php
if ($iswali->level_id == 8 || $iswali->level_id == 11 || $iswali->level_id == 14) {
?>
    <li class="nav-item {{ (request()->is('kependidikan/ijazah*') || request()->is('kependidikan/skhb*') || request()->is('kependidikan/refijazah*')) ? 'active' : '' }}">
        <a class="nav-link {{ (request()->is('kependidikan/ijazah*') || request()->is('kependidikan/skhb*') || request()->is('kependidikan/refijazah*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseIjazah" aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="mdi mdi-file-star"></i>
            <span>Ijazah</span>
        </a>
        <div id="collapseIjazah" class="collapse {{ (request()->is('kependidikan/ijazah*') || request()->is('kependidikan/skhb*') || request()->is('kependidikan/refijazah*')) ? 'show' : '' }}" aria-labelledby="headingIjazah" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ (Request::path()=='kependidikan/refijazah') ? 'active' : '' }}" href="/kependidikan/refijazah"><i class="mdi mdi-printer" aria-hidden="true"></i> Referensi Ijazah</a>
                <hr class="sidebar-divider">
                @if($iswali->level_id == 8)
                <a class="collapse-item {{ (Request::path()=='kependidikan/skhb/arsip') ? 'active' : '' }}" href="/kependidikan/skhb/arsip"><i class="mdi mdi-cog" aria-hidden="true"></i> Arsip SKHB</a>
                @endif
                <a class="collapse-item {{ (Request::path()=='kependidikan/ijazah/arsip') ? 'active' : '' }}" href="/kependidikan/ijazah/arsip"><i class="mdi mdi-cog" aria-hidden="true"></i> Arsip Ijazah</a>
            </div>
        </div>
    </li>
    <!-- <li class="nav-item {{ (Request::path()=='kependidikan/sertifiklas/cetak') ? 'active' : '' }}">
        <a class="nav-link" href="/kependidikan/sertifiklas/cetak">
          <i class="mdi mdi-file-certificate-outline"></i>
          <span>Sertifikat IKLaS</span>
        </a>
    </li>
    <li class="nav-item {{ (request()->is('kependidikan/sertifiklas*')) ? 'active' : '' }}">
        <a class="nav-link {{ (request()->is('kependidikan/sertifiklas*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseSertif" aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="mdi mdi-file-certificate-outline"></i>
            <span>Sertifikat IKLaS</span>
        </a>
        <div id="collapseSertif" class="collapse {{ (request()->is('kependidikan/sertifiklas*')) ? 'show' : '' }}" aria-labelledby="headingSertif" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ (Request::path()=='kependidikan/sertifiklas/nilai') ? 'active' : '' }}" href="/kependidikan/sertifiklas/nilai"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai IKLaS</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/sertifiklas/cetak') ? 'active' : '' }}" href="/kependidikan/sertifiklas/cetak"><i class="mdi mdi-printer" aria-hidden="true"></i> Sertifikat IKLaS</a>
            </div>
        </div>
    </li> -->
<?php } ?>
	@if($iswali && in_array($iswali->unit->name,['SD','SMP','SMA']))
    <li class="nav-item {{ request()->routeIs('penilaian.ikuEdukasi*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('penilaian.ikuEdukasi.kelas') }}">
          <i class="mdi mdi-trophy"></i>
          <span>Ledger Kelas</span>
        </a>
    </li>
	@endif
<hr class="sidebar-divider">