
@if( in_array((auth()->user()->role_id), array(1,2,8,18,25,26)))
<div class="sidebar-heading">
    Pembayaran Uang Sekolah
</div>
    <li class="nav-item {{ (request()->is('keuangan/bms*')) ? 'active' : '' }}">
        <a class="nav-link {{ (request()->is('kependidikan/kbm/pelajaran*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseBms" aria-expanded="true" aria-controls="collapseBms">
            <i class="fas fa-fw fa-money-check"></i>
            <span>BMS</span>
        </a>
        <div id="collapseBms" class="collapse {{ (request()->is('keuangan/bms*')) ? 'show' : '' }}" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ (request()->is('keuangan/bms/siswa*')) ? 'active' : '' }}" href="/keuangan/bms/siswa">
                    <i class="mdi mdi-cash-multiple" aria-hidden="true"></i>
                    <span>BMS Keseluruhan</span>
                </a>
                <a class="collapse-item {{ (request()->is('keuangan/bms/va*')) ? 'active' : '' }}" href="/keuangan/bms/va">
                    <i class="mdi mdi-card-account-details" aria-hidden="true"></i>
                    <span>VA</span>
                </a>
                <hr class="sidebar-divider">
                <!-- <a class="collapse-item {{ (Request::path()=='keuangan/bms/rencana*') ? 'active' : '' }}" href="/keuangan/bms/rencana">
                    <i class="mdi mdi-plus-circle" aria-hidden="true"></i>
                    <span>Rencana & Realisasi</span>
                </a> -->
                <a class="collapse-item {{ (request()->is('keuangan/bms/laporan-masukan-bms*')) ? 'active' : '' }}" href="/keuangan/bms/laporan-masukan-bms">
                    <i class="mdi mdi-text-box-check" aria-hidden="true"></i>
                    <span>Laporan Masukan BMS</span>
                </a>
                <!-- <a class="collapse-item {{ (Request::path()=='keuangan/bms/pertahun*') ? 'active' : '' }}" href="#">
                    <i class="mdi mdi-plus-circle" aria-hidden="true"></i>
                    <span>Jumlah Total</span>
                </a> -->
                <!-- <a class="collapse-item {{ (Request::path()=='keuangan/bms/log*') ? 'active' : '' }}" href="/keuangan/bms/log">
                    <i class="mdi mdi-plus-circle" aria-hidden="true"></i>
                    <span>Log Transaksi</span>
                </a> -->
            </div>
        </div>
    </li>
    <li class="nav-item {{ (request()->is('keuangan/spp*')) ? 'active' : '' }}">
        <a class="nav-link {{ (request()->is('kependidikan/kbm/pelajaran*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseSpp" aria-expanded="true" aria-controls="collapseSpp">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>SPP</span>
        </a>
        <div id="collapseSpp" class="collapse {{ (request()->is('keuangan/spp*')) ? 'show' : '' }}" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ (request()->is('keuangan/spp/siswa*')) ? 'active' : '' }}" href="/keuangan/spp/siswa">
                    <i class="mdi mdi-cash" aria-hidden="true"></i>
                    <span>SPP Keseluruhan</span>
                </a>
                <a class="collapse-item {{ (request()->is('keuangan/spp/va*')) ? 'active' : '' }}" href="/keuangan/spp/va">
                    <i class="mdi mdi-card-account-details" aria-hidden="true"></i>
                    <span>VA</span>
                </a>
                <hr class="sidebar-divider">
                <a class="collapse-item {{ (request()->is('keuangan/spp/laporan-spp-siswa*')) ? 'active' : '' }}" href="/keuangan/spp/laporan-spp-siswa">
                    <i class="mdi mdi-file-document-edit" aria-hidden="true"></i>
                    <span>SPP Per Bulan</span>
                </a>
                <a class="collapse-item {{ (request()->is('keuangan/spp/laporan-masukan-spp*')) ? 'active' : '' }}" href="/keuangan/spp/laporan-masukan-spp">
                    <i class="mdi mdi-text-box-check" aria-hidden="true"></i>
                    <span>Laporan Masukan SPP</span>
                </a>
                <!-- <a class="collapse-item {{ (Request::path()=='keuangan/spp/rencana*') ? 'active' : '' }}" href="/keuangan/spp/rencana">
                    <i class="mdi mdi-plus-circle" aria-hidden="true"></i>
                    <span>Rencana & Realisasi</span>
                </a> -->
                <!-- <a class="collapse-item {{ (Request::path()=='keuangan/spp/log*') ? 'active' : '' }}" href="/keuangan/spp/log">
                    <i class="mdi mdi-plus-circle" aria-hidden="true"></i>
                    <span>Log Transaksi</span>
                </a> -->
                <!-- <a class="collapse-item {{ (Request::path()=='kependidikan/kbm/pelajaran/mata-pelajaran*') ? 'active' : '' }}" href="#">
                    <i class="mdi mdi-plus-circle" aria-hidden="true"></i>
                    <span>Jumlah Total</span>
                </a> -->
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
@endif