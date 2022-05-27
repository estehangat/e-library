<div class="sidebar-heading">
    Penilaian <span class="badge badge-primary">Guru Mapel</span>
</div>
<li class="nav-item {{ (request()->is('kependidikan/penilaianmapel*')) ? 'active' : '' }}">
    <a class="nav-link {{ (request()->is('kependidikan/penilaianmapel*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseRapor" aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="mdi mdi-file-document"></i>
        <span>LTS dan Rapor</span>
    </a>
    <div id="collapseRapor" class="collapse {{ (request()->is('kependidikan/penilaianmapel*')) ? 'show' : '' }}" aria-labelledby="headingRapor" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <?php
            $skbm = App\Models\Skbm\Skbm::aktif()->where('unit_id', auth()->user()->pegawai->unit_id)->first();
            $mapelskbm = $skbm ? $skbm->detail()->where('employee_id', auth()->user()->pegawai->id)->pluck('subject_id') : null;
            $mapelquran = $mapelskbm ? App\Models\Kbm\MataPelajaran::where([['subject_name', 'like', "Qur'an"], ['unit_id', auth()->user()->pegawai->unit_id]])->whereIn('id', $mapelskbm)->count() : 0;
            $mapelnotquran = $mapelskbm ? App\Models\Kbm\MataPelajaran::where([['subject_name', 'not like', "Qur'an"], ['unit_id', auth()->user()->pegawai->unit_id]])->whereIn('id', $mapelskbm)->count() : 0;
            $mapelpai = $mapelskbm ? App\Models\Kbm\MataPelajaran::where([['subject_name', 'like', "%Agama Islam%"], ['unit_id', auth()->user()->pegawai->unit_id]])->whereIn('id', $mapelskbm)->count() : 0;
            if ($mapelpai == 0 && $mapelskbm && count($mapelskbm) >= 1 && $mapelquran == 0) {
            ?>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaipengetahuan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaipengetahuan"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Pengetahuan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaiketerampilan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaiketerampilan"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Keterampilan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaisikap') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaisikap"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Sikap</a>
            <?php
            }
            if ($mapelpai == 0 && $mapelnotquran > 0 && $mapelquran > 0) {
            ?>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaipengetahuan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaipengetahuan"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Pengetahuan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaiketerampilan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaiketerampilan"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Keterampilan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaisikap') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaisikap"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Sikap</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaitilawah') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaitilawah"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Tilawah</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaihafalan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaihafalan"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Hafalan</a>
            <?php
            }
            if ($mapelpai == 0 && $mapelnotquran == 0 && $mapelquran > 0) {
            ?>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaitilawah') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaitilawah"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Tilawah</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaihafalan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaihafalan"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Hafalan</a>
            <?php
            }
            if ($mapelpai > 0 && $mapelquran > 0) {
            ?>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaipengetahuan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaipengetahuan"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Pengetahuan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaiketerampilan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaiketerampilan"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Keterampilan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaisikap') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaisikap"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Sikap</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaitilawah') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaitilawah"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Tilawah</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaihafalan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaihafalan"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Hafalan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaihadits') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaihadits"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Hadits dan Doa</a>
            <?php 
            }
            if ($mapelpai > 0 && $mapelquran == 0) {
            ?>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaipengetahuan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaipengetahuan"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Pengetahuan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaiketerampilan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaiketerampilan"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Keterampilan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaisikap') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaisikap"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Sikap</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/nilaihadits') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/nilaihadits"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Hadits dan Doa</a>
            <?php 
            }
            ?>
            <hr class="sidebar-divider">
            <?php
            if ($mapelskbm && count($mapelskbm) >= 1 && $mapelquran == 0) {
            ?>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/kdsetting') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/kdsetting"><i class="mdi mdi-cog" aria-hidden="true"></i> Jumlah NH</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/rangepredikat') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/rangepredikat"><i class="mdi mdi-cog" aria-hidden="true"></i> Range Nilai Predikat</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/predikatpengetahuan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/predikatpengetahuan"><i class="mdi mdi-cog" aria-hidden="true"></i> Predikat Pengetahuan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/predikatketerampilan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/predikatketerampilan"><i class="mdi mdi-cog" aria-hidden="true"></i> Predikat Keterampilan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/indikator/mapel') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/indikator/mapel"><i class="mdi mdi-cog" aria-hidden="true"></i> Indikator Pengetahuan</a>
            <?php
            }
            if ($mapelnotquran > 0 && $mapelquran > 0) {
            ?>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/kdsetting') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/kdsetting"><i class="mdi mdi-cog" aria-hidden="true"></i> Jumlah NH</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/rangepredikat') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/rangepredikat"><i class="mdi mdi-cog" aria-hidden="true"></i> Range Nilai Predikat</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/predikatpengetahuan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/predikatpengetahuan"><i class="mdi mdi-cog" aria-hidden="true"></i> Predikat Pengetahuan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/predikatketerampilan') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/predikatketerampilan"><i class="mdi mdi-cog" aria-hidden="true"></i> Predikat Keterampilan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/indikator/mapel') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/indikator/mapel"><i class="mdi mdi-cog" aria-hidden="true"></i> Indikator Pengetahuan</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/targettahfidz') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/targettahfidz"><i class="mdi mdi-cog" aria-hidden="true"></i> Target Tahfidz</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/deschafal') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/deschafal"><i class="mdi mdi-cog" aria-hidden="true"></i> Deskripsi Hafalan</a>
            <?php 
            }
            if ($mapelnotquran == 0 && $mapelquran > 0) {
            ?>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/targettahfidz') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/targettahfidz"><i class="mdi mdi-cog" aria-hidden="true"></i> Target Tahfidz</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/penilaianmapel/deschafal') ? 'active' : '' }}" href="/kependidikan/penilaianmapel/deschafal"><i class="mdi mdi-cog" aria-hidden="true"></i> Deskripsi Hafalan</a>
            <?php } ?>
        </div>
    </div>
</li>

<?php
if ($mapelskbm && count($mapelskbm) >= 1 && $mapelquran == 0) {
?>
    <li class="nav-item {{ (request()->is('kependidikan/ijazahmapel*')) ? 'active' : '' }}">
        <a class="nav-link {{ (request()->is('kependidikan/ijazahmapel*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseIjazah" aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="mdi mdi-file-star"></i>
            <span>Ijazah</span>
        </a>
        <div id="collapseIjazah" class="collapse {{ (request()->is('kependidikan/ijazahmapel*')) ? 'show' : '' }}" aria-labelledby="headingIjazah" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ (Request::path()=='kependidikan/ijazahmapel/nilaipraktek') ? 'active' : '' }}" href="/kependidikan/ijazahmapel/nilaipraktek"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Praktek</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/ijazahmapel/nilaiusp') ? 'active' : '' }}" href="/kependidikan/ijazahmapel/nilaiusp"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai USP</a>
            </div>
        </div>
    </li>
<?php
}
if ($mapelnotquran > 0 && $mapelquran > 0) {
?>
    <li class="nav-item {{ (request()->is('kependidikan/ijazahmapel*')) ? 'active' : '' }}">
        <a class="nav-link {{ (request()->is('kependidikan/ijazahmapel*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseIjazah" aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="mdi mdi-file-star"></i>
            <span>Ijazah</span>
        </a>
        <div id="collapseIjazah" class="collapse {{ (request()->is('kependidikan/ijazahmapel*')) ? 'show' : '' }}" aria-labelledby="headingIjazah" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ (Request::path()=='kependidikan/ijazahmapel/nilaipraktek') ? 'active' : '' }}" href="/kependidikan/ijazahmapel/nilaipraktek"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai Praktek</a>
                <a class="collapse-item {{ (Request::path()=='kependidikan/ijazahmapel/nilaiusp') ? 'active' : '' }}" href="/kependidikan/ijazahmapel/nilaiusp"><i class="mdi mdi-plus-circle" aria-hidden="true"></i> Nilai USP</a>
            </div>
        </div>
    </li>
<?php
}
?>
<hr class="sidebar-divider">