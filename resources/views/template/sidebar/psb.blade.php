
@if(in_array(Auth::user()->role->name,['pembinayys','ketuayys','direktur','kepsek','wakasek','ctl','ctm','fam','faspv','es','sek','keu']))
<div class="sidebar-heading">
    Penerimaan Siswa Baru
</div>
    <li class="nav-item {{ (request()->is('kependidikan/infopsb/dashboard*')) ? 'active' : '' }}">
        <a class="nav-link {{ (request()->is('kependidikan/infopsb/dashboard*')) ? 'active' : '' }}" href="{{route('kependidikan.infopsb.dashboard')}}">
            <i class="mdi mdi-chart-tree"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item {{ (request()->is('kependidikan/infopsb/chart*')) ? 'active' : '' }}">
        <a class="nav-link {{ (request()->is('kependidikan/infopsb/chart*')) ? 'active' : '' }}" href="{{route('kependidikan.infopsb.chart')}}">
            <i class="mdi mdi-chart-bar"></i>
            <span>Chart</span>
        </a>
    </li>

    <li class="nav-item {{ (request()->is('kependidikan/psb*')) ? 'active' : '' }}">
        <a class="nav-link {{ (request()->is('kependidikan/psb*')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseSiswa" aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Calon Siswa</span>
        </a>
        <div id="collapseSiswa" class="collapse {{ (request()->is('kependidikan/psb*')) ? 'show' : '' }}" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if(in_array(Auth::user()->role->name,['pembinayys','ketuayys','direktur','kepsek','wakasek','ctl','ctm','fam','faspv','es','sek','keu']))
                <a class="collapse-item {{ (request()->is('kependidikan/psb/formulir-terisi*')) ? 'active' : '' }}" href="/kependidikan/psb/formulir-terisi">
                    <i class="mdi mdi-file-account" aria-hidden="true"></i>
                    <span>Formulir Terisi</span>
                </a>
                @endif
                @if(in_array(Auth::user()->role->name,['pembinayys','ketuayys','direktur','kepsek','wakasek','ctl','ctm','fam','faspv','es','sek','keu']))
                <a class="collapse-item {{ (request()->is('kependidikan/psb/saving-seat*')) ? 'active' : '' }}" href="/kependidikan/psb/saving-seat">
                    <i class="mdi mdi-cash" aria-hidden="true"></i>
                    <span>Bayar Formulir</span>
                </a>
                @endif
                @if(in_array(Auth::user()->role->name,['pembinayys','ketuayys','direktur','kepsek','wakasek','ctl','ctm','fam','faspv','es','sek','keu']))
                <a class="collapse-item {{ (request()->is('kependidikan/psb/wawancara*')) ? 'active' : '' }}" href="/kependidikan/psb/wawancara">
                    <i class="mdi mdi-comment" aria-hidden="true"></i>
                    <span>Wawancara</span>
                </a>
                @endif
                @if(in_array(Auth::user()->role->name,['pembinayys','ketuayys','direktur','kepsek','wakasek','ctl','ctm','fam','faspv','es','sek','keu']))
                <a class="collapse-item {{ (request()->is('kependidikan/psb/diterima*')) ? 'active' : '' }}" href="/kependidikan/psb/diterima">
                    <i class="mdi mdi-account-check" aria-hidden="true"></i>
                    <span>Diterima</span>
                </a>
                @endif
                @if(in_array(Auth::user()->role->name,['pembinayys','ketuayys','direktur','kepsek','wakasek','ctl','ctm','fam','faspv','es','keu']))
                <a class="collapse-item {{ (request()->is('kependidikan/psb/belum-lunas*')) ? 'active' : '' }}" href="/kependidikan/psb/belum-lunas">
                    <i class="mdi mdi-timer-sand" aria-hidden="true"></i>
                    <span>Belum Lunas DU</span>
                </a>
                @endif
                @if(in_array(Auth::user()->role->name,['pembinayys','ketuayys','direktur','kepsek','wakasek','ctl','ctm','fam','faspv','es','keu']))
                <a class="collapse-item {{ (request()->is('kependidikan/psb/sudah-lunas*')) ? 'active' : '' }}" href="/kependidikan/psb/sudah-lunas">
                    <i class="mdi mdi-cash-multiple" aria-hidden="true"></i>
                    <span>Sudah Lunas DU</span>
                </a>
                @endif
                @if(in_array(Auth::user()->role->name,['pembinayys','ketuayys','direktur','kepsek','wakasek','ctl','ctm','fam','faspv','es','sek','keu']))
                <a class="collapse-item {{ (request()->is('kependidikan/psb/peresmian-siswa*')) ? 'active' : '' }}" href="/kependidikan/psb/peresmian-siswa">
                    <i class="mdi mdi-bank-check" aria-hidden="true"></i>
                    <span>Peresmian Siswa</span>
                </a>
                @endif
                @if(in_array(Auth::user()->role->name,['pembinayys','ketuayys','direktur','kepsek','wakasek','ctl','ctm','es','sek','keu']))
                <hr class="sidebar-divider">
                    <a class="collapse-item {{ (request()->is('kependidikan/psb/diterima*')) ? 'active' : '' }}" href="/kependidikan/psb/dicadangkan">
                        <i class="mdi mdi-account-remove" aria-hidden="true"></i>
                        <span>Dicadangkan</span>
                    </a>
                    @endif
                    @if(in_array(Auth::user()->role->name,['pembinayys','ketuayys','direktur','kepsek','wakasek','ctl','ctm','fam','faspv','keu']))
                    <a class="collapse-item {{ (request()->is('kependidikan/psb/kelas/batal-daftar-ulang*')) ? 'active' : '' }}" href="/kependidikan/psb/batal-daftar-ulang">
                        <i class="mdi mdi-currency-usd-off" aria-hidden="true"></i> 
                        <span>Batal Daftar Ulang</span>
                    </a>
                    @endif
            </div>
        </div>
    </li>
    
<hr class="sidebar-divider">
@endif