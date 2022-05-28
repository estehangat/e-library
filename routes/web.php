<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Akun
use App\Http\Controllers\Akun\ProfilController; 
use App\Http\Controllers\Akun\RoleController;
use App\Http\Controllers\Akun\UbahSandiController;

// Kepegawaian
use App\Http\Controllers\KepegawaianController;

// Rekrutmen
use App\Http\Controllers\Rekrutmen\PegawaiController;
use App\Http\Controllers\Rekrutmen\CalonPegawaiController;
use App\Http\Controllers\Rekrutmen\EvalPegawaiController;
use App\Http\Controllers\Rekrutmen\SpkController;
use App\Http\Controllers\Rekrutmen\JenisMitraController;
use App\Http\Controllers\Rekrutmen\PendidikanTerakhirController;
use App\Http\Controllers\Rekrutmen\ProgramStudiController;
use App\Http\Controllers\Rekrutmen\UniversitasController;

// Penempatan
use App\Http\Controllers\Penempatan\StrukturalController;
use App\Http\Controllers\Penempatan\NonstrukturalController;
use App\Http\Controllers\Penempatan\SkbmController;

// Pelatihan
use App\Http\Controllers\Pelatihan\MateriPelatihanController;
use App\Http\Controllers\Pelatihan\KehadiranPelatihanController;
use App\Http\Controllers\Pelatihan\PelatihanController;
use App\Http\Controllers\Pelatihan\SertifikatPelatihanController;

// Putus Hubungan Kerja
use App\Http\Controllers\Phk\PhkController;
use App\Http\Controllers\Phk\AlasanPhkController;

// Penilaian
use App\Http\Controllers\Psc\PscController;
use App\Http\Controllers\Psc\PemetaanPeranController as PemetaanPeranPscController;
use App\Http\Controllers\Psc\AspekEvaluasiController as AspekEvaluasiPscController;
use App\Http\Controllers\Psc\AspekUtamaController as AspekUtamaPscController;
use App\Http\Controllers\Psc\KunciAspekController as KunciAspekPscController;
use App\Http\Controllers\Psc\RentangNilaiController;

use App\Http\Controllers\Psc\PenilaianKinerjaController;
use App\Http\Controllers\Psc\PenilaianKinerjaPenilaiController;
use App\Http\Controllers\Psc\PenilaianKinerjaValidatorController;
use App\Http\Controllers\Psc\LaporanPrestasiController;
use App\Http\Controllers\Psc\LaporanSayaController as LaporanPrestasiSayaController;
//use App\Http\Controllers\Psc\LaporanPrestasiSayaController;
//use App\Http\Controllers\Psc\LaporanPrestasiPegawaiController;

// IKU
use App\Http\Controllers\Iku\IkuPegawaiController;
use App\Http\Controllers\Iku\IkuEdukasiController;
use App\Http\Controllers\Iku\IkuLayananController;
use App\Http\Controllers\Iku\IkuPersepsiController;
use App\Http\Controllers\Iku\IkuSasaranController;

use App\Http\Controllers\Iku\AspekIkuController;

// Kependidikan
use App\Http\Controllers\KependidikanController;

// Penilaian
use App\Http\Controllers\Penilaian\PenilaianController;
use App\Http\Controllers\Penilaian\SkhbController;
use App\Http\Controllers\Penilaian\AspekController;
use App\Http\Controllers\Penilaian\NilaiSikapController;
use App\Http\Controllers\Penilaian\NilaiPengetahuanController;
use App\Http\Controllers\Penilaian\NilaiKeterampilanController;
use App\Http\Controllers\Penilaian\NilaiEkstraController;
use App\Http\Controllers\Penilaian\PtsController;
use App\Http\Controllers\Penilaian\PasController;
use App\Http\Controllers\Penilaian\IklasController;
use App\Http\Controllers\Penilaian\KehadiranController;
use App\Http\Controllers\Penilaian\EkstraController;
use App\Http\Controllers\Penilaian\PrestasiController;
use App\Http\Controllers\Penilaian\HaditsController;
use App\Http\Controllers\Penilaian\NilaiAspekController;
use App\Http\Controllers\Penilaian\IndikatorController;
use App\Http\Controllers\Penilaian\NilaiIndikatorController;
use App\Http\Controllers\Penilaian\TilawahController;
use App\Http\Controllers\Penilaian\TahfidzController;
use App\Http\Controllers\Penilaian\RaporKepsekController;
use App\Http\Controllers\Penilaian\PraktekUspController;
use App\Http\Controllers\Penilaian\RangePredikatController;

// Indikator
use App\Http\Controllers\Penilaian\Indikator\PengetahuanController as IndikatorPengetahuanController;

// Predikat
use App\Http\Controllers\Penilaian\Predikat\NilaiIklasController as PredikatNilaiIklasController;

// Penilaian Kepsek
use App\Http\Controllers\Penilaian\PengetahuanController;
use App\Http\Controllers\Penilaian\KeterampilanController;
use App\Http\Controllers\Penilaian\SikapController;
use App\Http\Controllers\Penilaian\HafalanController;

// IKU Edukasi
use App\Http\Controllers\Penilaian\IkuEdukasiController as PenilaianIkuEdukasiController;

// Arsip Ijazah
use App\Http\Controllers\Arsip\ArsipIjazahController;
// Arsip SKHB
use App\Http\Controllers\Arsip\ArsipSkhbController;

// KBM
use App\Http\Controllers\KbmController;

/* Ready to Delete */
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Generator\BmsGeneratorController;
use App\Http\Controllers\Import\ImportVaController;
/* --------------- */

//KBM
use App\Http\Controllers\Kbm\SiswaController;
use App\Http\Controllers\Kbm\NamaKelasController;
use App\Http\Controllers\Kbm\PelajaranController;
use App\Http\Controllers\Kbm\TahunAjaranController;
use App\Http\Controllers\Kbm\KelasController;
use App\Http\Controllers\Kbm\AmpuKelasController;
use App\Http\Controllers\Kbm\PengajuanKelasController;
use App\Http\Controllers\Kbm\JamPelajaranController;
use App\Http\Controllers\Kbm\JadwalPelajaranController;
use App\Http\Controllers\Kbm\ParentController;
// PSB ADMIN
use App\Http\Controllers\Psb\Ortu\LoginController as LoginSiswaController;
use App\Http\Controllers\Psb\Ortu\RegisterController as RegisterSiswaController;

// PSB ORTU
use App\Http\Controllers\Psb\Ortu\OrtuController;

// Keuangan
use App\Http\Controllers\KeuanganController;

use App\Http\Controllers\Keuangan\AkunController;
use App\Http\Controllers\Keuangan\RkatController;
use App\Http\Controllers\Keuangan\ApbyController;
use App\Http\Controllers\Keuangan\ProposalPpaController;
use App\Http\Controllers\Keuangan\PpaController;
use App\Http\Controllers\Keuangan\PpbController;
use App\Http\Controllers\Keuangan\LppaController;
use App\Http\Controllers\Keuangan\RealisasiController as RealisasiKeuanganController;
use App\Http\Controllers\Keuangan\SaldoController as SaldoAnggaranController;

use App\Http\Controllers\Keuangan\Pembayaran\BmsController;
use App\Http\Controllers\Keuangan\Pembayaran\Bms\DasborBmsController;
use App\Http\Controllers\Keuangan\Pembayaran\Bms\NominalBmsController;
use App\Http\Controllers\Keuangan\Pembayaran\Bms\PembayaranBmsController;
use App\Http\Controllers\Keuangan\Pembayaran\Bms\PotonganBmsController;
use App\Http\Controllers\Keuangan\Pembayaran\Bms\StatusBmsController;
use App\Http\Controllers\Keuangan\Pembayaran\Bms\VaBmsController;
use App\Http\Controllers\Keuangan\Pembayaran\ExchangeTransactionController;
use App\Http\Controllers\Keuangan\Pembayaran\SppController;
use App\Http\Controllers\Keuangan\Pembayaran\DashboardController as PembayaranDashboardController;
use App\Http\Controllers\Keuangan\Pembayaran\Spp\DasborSppController;
use App\Http\Controllers\Keuangan\Pembayaran\Spp\LaporanSppController;
use App\Http\Controllers\Keuangan\Pembayaran\Spp\NominalSppController;
use App\Http\Controllers\Keuangan\Pembayaran\Spp\PembayaranSppController;
use App\Http\Controllers\Keuangan\Pembayaran\Spp\PotonganSppController;
use App\Http\Controllers\Keuangan\Pembayaran\Spp\StatusSppController;
use App\Http\Controllers\Keuangan\Pembayaran\Spp\VaSppController;
use App\Http\Controllers\Psb\Admin\KunciPsbController;
use App\Http\Controllers\Psb\Admin\AkunOrtuController;
use App\Http\Controllers\Psb\Admin\BmsPsbController;
use App\Http\Controllers\Psb\Admin\CalonSiswaController;
use App\Http\Controllers\Psb\Admin\DaftarUlangPsbController;
use App\Http\Controllers\Psb\Admin\PenerimaanSiswaController;
use App\Http\Controllers\Psb\Admin\SavingSeatController;
use App\Http\Controllers\Psb\Admin\StatusPsbController;
use App\Http\Controllers\Psb\Admin\WawancaraPsbController;
use App\Http\Controllers\Psb\Admin\KomitmenController;
use App\Http\Controllers\Psb\Admin\DashboardController as PsbDashboardController;
// PSB
use App\Http\Controllers\Psb\AdminPsbController;

//Unit
use App\Http\Controllers\UnitController;

//Wilayah
use App\Http\Controllers\WilayahController;
use App\Http\Services\Generator\BmsPlanFixing;
use App\Http\Services\Generator\SppGenerator;
use App\Http\Services\Generator\CheckRedudantBms;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return redirect()->route('login');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/sso', [LoginController::class, 'login'])->name('sso');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token?}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('komitmen', function () {
	return view('psb.komitmen');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/dashboard', [DashboardController::class, 'index']);

	// Keamanan

	Route::prefix('akun')->group(function () {
		Route::get('/', function () {
			return redirect()->route('profil.index');;
		})->name('akun.index');
		Route::get('profil-saya', [ProfilController::class, 'index'])->name('profil.index');
		Route::get('unit/{unit?}', [RoleController::class, 'changeUnit'])->name('akun.unit.change')->middleware('role:keulsi');
		Route::get('peran/{unit?}/{position?}', [RoleController::class, 'changeRole'])->name('akun.role.change');
		Route::prefix('ubah-sandi')->group(function () {
			Route::get('/', [UbahSandiController::class, 'index'])->name('ubahsandi.index');
			Route::put('perbarui', [UbahSandiController::class, 'update'])->name('ubahsandi.perbarui');
		});
	});

	// Kepegawaian

	Route::prefix('kepegawaian')->group(function () {

		Route::get('/', [KepegawaianController::class, 'index'])->name('kepegawaian.index');
		Route::prefix('pegawai')->group(function () {
			Route::group(['middleware' => 'role:admin,kepsek,wakasek,pembinayys,ketuayys,direktur,etl,etm,fam,faspv,am,aspv'], function () {
				Route::get('/', [PegawaiController::class, 'index'])->name('pegawai.index');
				Route::get('ekspor', [PegawaiController::class, 'export'])->name('pegawai.ekspor')->middleware('role:aspv');
				Route::get('{id}', [PegawaiController::class, 'show'])->where('id', '[0-9]+')->name('pegawai.detail');
			});
			Route::group(['middleware' => 'role:etm'], function () {
				Route::get('tambah', [PegawaiController::class, 'create'])->name('pegawai.tambah');
				Route::post('simpan', [PegawaiController::class, 'store'])->name('pegawai.simpan');
				Route::get('{id}/ubah', [PegawaiController::class, 'edit'])->where('id', '[0-9]+')->name('pegawai.ubah');
				Route::put('{id}/perbarui', [PegawaiController::class, 'update'])->where('id', '[0-9]+')->name('pegawai.perbarui');
			});
			// Route::delete('{id}/hapus', [PegawaiController::class, 'destroy'])->where('id', '[0-9]+')->name('pegawai.hapus');
			Route::put('{id}/validasi', [PegawaiController::class, 'accept'])->where('id', '[0-9]+')->name('pegawai.validasi')->middleware('role:faspv');
			Route::put('{id}/reset', [PegawaiController::class, 'reset'])->where('id', '[0-9]+')->name('pegawai.reset')->middleware('role:admin');
			Route::post('impor', [PegawaiController::class, 'import'])->name('pegawai.impor')->middleware('role:etm');
		});

		Route::prefix('rekrutmen')->group(function () {
			Route::get('/', function () {
				return redirect()->route('calon.index');
			})->name('rekrutmen.index');
			Route::prefix('calon')->group(function () {
				Route::group(['middleware' => 'role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl,etm,am,aspv'], function () {
					Route::get('/', [CalonPegawaiController::class, 'index'])->name('calon.index');
					Route::get('{id}', [CalonPegawaiController::class, 'show'])->where('id', '[0-9]+')->name('calon.detail');
				});
				Route::group(['middleware' => 'role:etm'], function () {
					Route::get('tambah', [CalonPegawaiController::class, 'create'])->name('calon.tambah');
					Route::post('simpan', [CalonPegawaiController::class, 'store'])->name('calon.simpan');
					Route::get('{id}/ubah', [CalonPegawaiController::class, 'edit'])->where('id', '[0-9]+')->name('calon.ubah');
					Route::delete('{id}/hapus', [CalonPegawaiController::class, 'destroy'])->where('id', '[0-9]+')->name('calon.hapus');
					Route::post('impor', [CalonPegawaiController::class, 'import'])->name('calon.impor');
				});
				Route::put('{id}/perbarui', [CalonPegawaiController::class, 'update'])->where('id', '[0-9]+')->name('calon.perbarui')->middleware('role:etl,etm');
				Route::group(['middleware' => 'role:etl'], function () {
					Route::post('ubah', [CalonPegawaiController::class, 'editRecommend'])->name('calon.ubah.etl');
					Route::put('{id}/validasi', [CalonPegawaiController::class, 'accept'])->where('id', '[0-9]+')->name('calon.validasi');
				});
			});
			Route::prefix('perjanjian-kerja')->group(function () {
				Route::get('/', [SpkController::class, 'index'])->name('spk.index')->middleware('role:pembinayys,ketuayys,etm,am,aspv');
				Route::group(['middleware' => 'role:etm,aspv'], function () {
					Route::post('ubah', [SpkController::class, 'edit'])->name('spk.ubah');
					Route::put('perbarui', [SpkController::class, 'update'])->name('spk.perbarui');
					Route::put('perbarui/semua', [SpkController::class, 'updateAll'])->name('spk.perbarui.semua');
					Route::put('reset', [SpkController::class, 'reset'])->name('spk.reset');
				});
				Route::get('{id}/cetak', [SpkController::class, 'print'])->name('spk.cetak');
				Route::get('ekspor', [SpkController::class, 'export'])->name('spk.ekspor')->middleware('role:etm,am,aspv');
			});
			Route::group(['middleware' => 'role:direktur,etl,etm,aspv'], function () {
				Route::prefix('jenis-mitra')->name('jenis-mitra')->group(function () {
					Route::get('/', [JenisMitraController::class, 'index'])->name('.index');
					Route::post('simpan', [JenisMitraController::class, 'store'])->name('.simpan');
					Route::post('ubah', [JenisMitraController::class, 'edit'])->name('.ubah');
					Route::put('perbarui', [JenisMitraController::class, 'update'])->name('.perbarui');
					Route::delete('{id}/hapus', [JenisMitraController::class, 'destroy'])->where('id', '[0-9]+')->name('.hapus');
				});
				Route::prefix('pendidikan-terakhir')->name('pendidikanterakhir')->group(function () {
					Route::get('/', [PendidikanTerakhirController::class, 'index'])->name('.index');
					Route::post('simpan', [PendidikanTerakhirController::class, 'store'])->name('.simpan');
					Route::post('ubah', [PendidikanTerakhirController::class, 'edit'])->name('.ubah');
					Route::put('perbarui', [PendidikanTerakhirController::class, 'update'])->name('.perbarui');
					Route::delete('{id}/hapus', [PendidikanTerakhirController::class, 'destroy'])->where('id', '[0-9]+')->name('.hapus');
				});
				Route::prefix('program-studi')->name('programstudi')->group(function () {
					Route::get('/', [ProgramStudiController::class, 'index'])->name('.index');
					Route::post('simpan', [ProgramStudiController::class, 'store'])->name('.simpan');
					Route::post('ubah', [ProgramStudiController::class, 'edit'])->name('.ubah');
					Route::put('perbarui', [ProgramStudiController::class, 'update'])->name('.perbarui');
					Route::delete('{id}/hapus', [ProgramStudiController::class, 'destroy'])->where('id', '[0-9]+')->name('.hapus');
				});
				Route::prefix('universitas')->name('universitas')->group(function () {
					Route::get('/', [UniversitasController::class, 'index'])->name('.index');
					Route::post('simpan', [UniversitasController::class, 'store'])->name('.simpan');
					Route::post('ubah', [UniversitasController::class, 'edit'])->name('.ubah');
					Route::put('perbarui', [UniversitasController::class, 'update'])->name('.perbarui');
					Route::delete('{id}/hapus', [UniversitasController::class, 'destroy'])->where('id', '[0-9]+')->name('.hapus');
				});
			});
		});

		Route::prefix('penempatan')->group(function () {
			Route::get('/', function () {
				return redirect()->route('struktural.index');;
			})->name('penempatan.index');
			Route::prefix('struktural')->group(function () {
				Route::get('/', [StrukturalController::class, 'index'])->name('struktural.index')->middleware('role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl,etm,fam,faspv,am,aspv');
				Route::prefix('{tahunajaran?}/{unit?}')->group(function () {
					Route::get('/', [StrukturalController::class, 'show'])->name('struktural.show')->middleware('role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl,etm,fam,faspv,am,aspv');
					Route::post('simpan', [StrukturalController::class, 'store'])->name('struktural.simpan')->middleware('role:etm');
					Route::group(['middleware' => 'role:direktur,etl,etm,aspv'], function () {
						Route::post('ubah', [StrukturalController::class, 'edit'])->name('struktural.ubah');
						Route::put('perbarui', [StrukturalController::class, 'update'])->name('struktural.perbarui');
						Route::put('perbarui/semua', [StrukturalController::class, 'updateAll'])->name('struktural.perbarui.semua');
					});
					Route::delete('{id}/hapus', [StrukturalController::class, 'destroy'])->where('id', '[0-9]+')->name('struktural.hapus')->middleware('role:etm');
					Route::get('ekspor', [StrukturalController::class, 'export'])->name('struktural.ekspor')->middleware('role:aspv');
				});
			});
			Route::prefix('nonstruktural')->group(function () {
				Route::get('/', [NonstrukturalController::class, 'index'])->name('nonstruktural.index')->middleware('role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl,etm,fam,am,aspv');
				Route::prefix('{tahunajaran?}/{unit?}')->group(function () {
					Route::get('/', [NonstrukturalController::class, 'show'])->name('nonstruktural.show')->middleware('role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl,etm,fam,am,aspv');
					Route::post('simpan', [NonstrukturalController::class, 'store'])->name('nonstruktural.simpan')->middleware('role:etm');
					Route::group(['middleware' => 'role:etl,etm,aspv'], function () {
						Route::post('ubah', [NonstrukturalController::class, 'edit'])->name('nonstruktural.ubah');
						Route::put('perbarui', [NonstrukturalController::class, 'update'])->name('nonstruktural.perbarui');
						Route::put('perbarui/semua', [NonstrukturalController::class, 'updateAll'])->name('nonstruktural.perbarui.semua');
					});
					Route::delete('{id}/hapus', [NonstrukturalController::class, 'destroy'])->where('id', '[0-9]+')->name('nonstruktural.hapus')->middleware('role:etm');
					Route::get('ekspor', [NonstrukturalController::class, 'export'])->name('nonstruktural.ekspor')->middleware('role:aspv');
				});
			});
		});

		Route::prefix('pelatihan')->group(function () {
			Route::get('/', function () {
				return redirect()->route('pelatihan.materi.index');
			})->name('pelatihan.index');
			Route::prefix('materi')->group(function () {
				Route::group(['middleware' => 'role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl,etm'], function () {
					Route::get('/', [MateriPelatihanController::class, 'index'])->name('pelatihan.materi.index');
					Route::get('{id}', [MateriPelatihanController::class, 'show'])->where('id', '[0-9]+')->name('pelatihan.materi.detail');
				});
				Route::group(['middleware' => 'role:etm'], function () {
					Route::post('simpan', [MateriPelatihanController::class, 'store'])->name('pelatihan.materi.simpan');
					Route::put('perbarui/atribut', [MateriPelatihanController::class, 'updateAttribute'])->name('pelatihan.materi.perbarui.atribut');
					Route::put('{id}/selesai', [MateriPelatihanController::class, 'end'])->where('id', '[0-9]+')->name('pelatihan.materi.selesai');
				});
				Route::group(['middleware' => 'role:etl,etm'], function () {
					Route::post('ubah', [MateriPelatihanController::class, 'edit'])->name('pelatihan.materi.ubah');
					Route::put('perbarui', [MateriPelatihanController::class, 'update'])->name('pelatihan.materi.perbarui');
					Route::delete('{id}/hapus', [MateriPelatihanController::class, 'destroy'])->where('id', '[0-9]+')->name('pelatihan.materi.hapus');
				});
			});
			Route::prefix('kehadiran')->group(function () {
				Route::get('/', function () {
					return redirect()->route('pelatihan.materi.index');
				});
				Route::group(['middleware' => 'role:etm'], function () {
					Route::put('hadir', [KehadiranPelatihanController::class, 'update'])->name('pelatihan.kehadiran.hadir');
					Route::put('batal', [KehadiranPelatihanController::class, 'cancel'])->name('pelatihan.kehadiran.batal');
				});
			});
			Route::prefix('pelatihan-saya')->group(function () {
				Route::get('/', [PelatihanController::class, 'index'])->name('pelatihan.saya.index');
				Route::get('riwayat', [PelatihanController::class, 'history'])->name('pelatihan.saya.riwayat');
			});
			Route::prefix('sertifikat')->group(function () {
				Route::get('/', [SertifikatPelatihanController::class, 'index'])->name('pelatihan.sertifikat.index');
				Route::get('{id}/unduh', [SertifikatPelatihanController::class, 'download'])->where('id', '[0-9]+')->name('pelatihan.sertifikat.unduh');
			});
		});

		Route::prefix('evaluasi')->group(function () {
			Route::get('/', [EvalPegawaiController::class, 'index'])->name('evaluasi.index')->middleware('role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl,etm,am,aspv');
			Route::group(['middleware' => 'role:kepsek,etm,etl'], function () {
				Route::post('ubah', [EvalPegawaiController::class, 'edit'])->name('evaluasi.ubah');
				Route::put('perbarui', [EvalPegawaiController::class, 'update'])->name('evaluasi.perbarui');
			});
		});

		Route::prefix('phk')->group(function () {
			Route::get('/', [PhkController::class, 'index'])->name('phk.index')->middleware('role:ketuayys,pembinayys,kepsek,wakasek,direktur,etl,etm,fam,faspv,am,aspv');
			Route::group(['middleware' => 'role:etm'], function () {
				Route::post('tambah', [PhkController::class, 'create'])->name('phk.tambah');
				Route::post('simpan', [PhkController::class, 'store'])->name('phk.simpan');
				Route::post('ubah', [PhkController::class, 'edit'])->name('phk.ubah');
				Route::put('perbarui', [PhkController::class, 'update'])->name('phk.perbarui');
				Route::delete('{id}/hapus', [PhkController::class, 'destroy'])->where('id', '[0-9]+')->name('phk.hapus');
			});
			Route::put('{id}/validasi', [PhkController::class, 'accept'])->where('id', '[0-9]+')->name('phk.validasi')->middleware('role:direktur');
			Route::get('ekspor', [PhkController::class, 'export'])->name('phk.ekspor')->middleware('role:faspv');
			Route::group(['middleware' => 'role:etm'], function () {
				Route::prefix('alasan')->group(function () {
					Route::get('/', [AlasanPhkController::class, 'index'])->name('alasanphk.index');
					Route::post('simpan', [AlasanPhkController::class, 'store'])->name('alasanphk.simpan');
					Route::post('ubah', [AlasanPhkController::class, 'edit'])->name('alasanphk.ubah');
					Route::put('perbarui', [AlasanPhkController::class, 'update'])->name('alasanphk.perbarui');
					Route::delete('{id}/hapus', [AlasanPhkController::class, 'destroy'])->where('id', '[0-9]+')->name('alasanphk.hapus');
				});
			});
		});

		Route::prefix('psc')->group(function () {
			Route::get('/', function () {
				return redirect()->route('psc.penilaian.index');
			})->name('psc.index');
			Route::prefix('penilaian')->group(function () {
				Route::prefix('{tahun?}/{unit?}')->group(function () {
					Route::get('/', [PenilaianKinerjaController::class, 'index'])->name('psc.penilaian.index');
				});
				Route::prefix('{tahun}/{unit}')->group(
					function () {
					Route::get('penilai', [PenilaianKinerjaPenilaiController::class, 'index'])->name('psc.penilaian.penilai.index');
					Route::prefix('penilai/{pegawai}')->group(function () {
						Route::get('/', [PenilaianKinerjaPenilaiController::class, 'show'])->name('psc.penilaian.penilai.show');
						Route::put('perbarui', [PenilaianKinerjaPenilaiController::class, 'update'])->name('psc.penilaian.penilai.perbarui');
					});
					Route::get('validator', [PenilaianKinerjaValidatorController::class, 'index'])->name('psc.penilaian.validator.index');
					Route::prefix('validator/{pegawai}')->group(function () {
						Route::get('/', [PenilaianKinerjaValidatorController::class, 'show'])->name('psc.penilaian.validator.show');
						Route::put('validasi', [PenilaianKinerjaValidatorController::class, 'accept'])->name('psc.penilaian.validator.validasi');
					});
				});
			});
			Route::prefix('laporan')->group(function () {
				Route::prefix('{tahun?}/{unit?}')->group(function () {
					Route::get('/', [LaporanPrestasiController::class, 'index'])->name('psc.laporan.pegawai.index');
				});
				Route::prefix('{tahun}/{unit}')->group(function () {
					Route::get('ekspor', [LaporanPrestasiController::class, 'export'])->name('psc.laporan.pegawai.ekspor');
					Route::prefix('{pegawai}')->group(function () {
						Route::get('/', [LaporanPrestasiController::class, 'show'])->name('psc.laporan.pegawai.show');
						Route::get('unduh', [LaporanPrestasiController::class, 'download'])->name('psc.laporan.pegawai.unduh');
					});
				});
			});
			Route::prefix('saya')->group(function () {
				Route::prefix('{tahun?}')->group(function () {
					Route::get('/', [LaporanPrestasiSayaController::class, 'index'])->name('psc.laporan.saya.index');
				});
				Route::prefix('{tahun}')->group(function () {
					Route::prefix('{pegawai}')->group(function () {
						Route::get('/', [LaporanPrestasiSayaController::class, 'show'])->name('psc.laporan.saya.show');
					});
				});
			});

			Route::group(['middleware' => 'role:etl,etm'], function () {
				Route::prefix('peran')->group(function () {
					Route::get('/', [PemetaanPeranPscController::class, 'index'])->name('psc.peran.index');
					Route::post('simpan', [PemetaanPeranPscController::class, 'store'])->name('psc.peran.simpan');
					Route::post('ubah', [PemetaanPeranPscController::class, 'edit'])->name('psc.peran.ubah');
					Route::put('perbarui', [PemetaanPeranPscController::class, 'update'])->name('psc.peran.perbarui');
					Route::delete('{id}/hapus', [PemetaanPeranPscController::class, 'destroy'])->where('id', '[0-9]+')->name('psc.peran.hapus');
				});
				Route::prefix('rentang')->group(function () {
					Route::get('/', [RentangNilaiController::class, 'index'])->name('psc.rentang.index');
					Route::post('simpan', [RentangNilaiController::class, 'store'])->name('psc.rentang.simpan');
					Route::post('ubah', [RentangNilaiController::class, 'edit'])->name('psc.rentang.ubah');
					Route::put('perbarui', [RentangNilaiController::class, 'update'])->name('psc.rentang.perbarui');
					Route::delete('{id}/hapus', [RentangNilaiController::class, 'destroy'])->where('id', '[0-9]+')->name('psc.rentang.hapus');
					Route::get('{id}/aktif', [RentangNilaiController::class, 'active'])->where('id', '[0-9]+')->name('psc.rentang.aktif');
				});
			});
			Route::prefix('aspek')->group(function () {
				Route::prefix('kunci')->group(function () {
					Route::get('/', [KunciAspekPscController::class, 'index'])->name('psc.aspek.kunci.index');
					Route::put('simpan', [KunciAspekPscController::class, 'update'])->name('psc.aspek.kunci.perbarui');
				});
				Route::prefix('{position?}')->group(function () {
					Route::get('/', [AspekEvaluasiPscController::class, 'index'])->name('psc.aspek.index');
				});
				Route::prefix('{position}')->group(function () {
					Route::post('simpan', [AspekEvaluasiPscController::class, 'store'])->name('psc.aspek.posisi.simpan');
					Route::post('ubah', [AspekEvaluasiPscController::class, 'edit'])->name('psc.aspek.posisi.ubah');
					Route::put('perbarui', [AspekEvaluasiPscController::class, 'update'])->name('psc.aspek.posisi.perbarui');
					Route::post('relasikan', [AspekEvaluasiPscController::class, 'relate'])->name('psc.aspek.posisi.relasikan');
					Route::put('perbarui/semua', [AspekEvaluasiPscController::class, 'updateAll'])->name('psc.aspek.posisi.perbarui.semua');
					Route::delete('{id}/hapus', [AspekEvaluasiPscController::class, 'unrelate'])->where('id', '[0-9]+')->name('psc.aspek.posisi.hapus');
				});
				Route::delete('{id}/hapus', [AspekEvaluasiPscController::class, 'destroy'])->where('id', '[0-9]+')->name('psc.aspek.hapus');
			});
			Route::prefix('aspek-utama')->group(function () {
				Route::get('/', [AspekUtamaPscController::class, 'index'])->name('psc.utama.index');
				Route::post('simpan', [AspekUtamaPscController::class, 'store'])->name('psc.utama.simpan');
				Route::post('ubah', [AspekUtamaPscController::class, 'edit'])->name('psc.utama.ubah');
				Route::put('perbarui', [AspekUtamaPscController::class, 'update'])->name('psc.utama.perbarui');
				Route::put('perbarui/semua', [AspekUtamaPscController::class, 'updateAll'])->name('psc.utama.perbarui.semua');
				Route::delete('{id}/hapus', [AspekUtamaPscController::class, 'destroy'])->where('id', '[0-9]+')->name('psc.utama.hapus');
			});
		});

		Route::prefix('iku')->group(function () {
			Route::get('/', [IkuEdukasiController::class, 'index'])->name('iku.index');
			Route::prefix('edukasi')->group(function () {
				Route::prefix('{tahun?}/{unit?}')->group(function () {
					Route::get('/', [IkuEdukasiController::class, 'index'])->name('iku.edukasi.index');
				});
				Route::prefix('{tahun}/{unit}')->group(function () {
					Route::post('ubah', [IkuEdukasiController::class, 'edit'])->name('iku.edukasi.ubah');
					Route::put('perbarui', [IkuEdukasiController::class, 'update'])->name('iku.edukasi.perbarui');
					Route::post('perbarui/semua', [IkuEdukasiController::class, 'updateAll'])->name('iku.edukasi.perbarui.semua');
					Route::put('{id}/setujui', [IkuEdukasiController::class, 'accept'])->where('id', '[0-9]+')->name('iku.edukasi.setujui');
				});
			});
			Route::prefix('layanan')->group(function () {
				Route::prefix('{tahun?}/{unit?}')->group(function () {
					Route::get('/', [IkuLayananController::class, 'index'])->name('iku.layanan.index');
				});
				Route::prefix('{tahun}/{unit}')->group(function () {
					Route::post('ubah', [IkuLayananController::class, 'edit'])->name('iku.layanan.ubah');
					Route::put('perbarui', [IkuLayananController::class, 'update'])->name('iku.layanan.perbarui');
					Route::post('perbarui/semua', [IkuLayananController::class, 'updateAll'])->name('iku.layanan.perbarui.semua');
					Route::put('{id}/setujui', [IkuLayananController::class, 'accept'])->where('id', '[0-9]+')->name('iku.layanan.setujui');
				});
			});
			Route::group(['middleware' => 'role:kepsek,pembinayys,ketuayys,direktur,etl'], function () {
				Route::prefix('pegawai')->group(function () {
					Route::prefix('{tahun?}/{unit?}')->group(function () {
						Route::get('/', [IkuPegawaiController::class, 'index'])->name('iku.pegawai.index');
					});
				});
			});
			Route::prefix('persepsi')->group(function () {
				Route::prefix('{tahun?}/{unit?}')->group(function () {
					Route::get('/', [IkuPersepsiController::class, 'index'])->name('iku.persepsi.index');
				});
				Route::prefix('{tahun}/{unit}')->group(function () {
					Route::post('ubah', [IkuPersepsiController::class, 'edit'])->name('iku.persepsi.ubah');
					Route::put('perbarui', [IkuPersepsiController::class, 'update'])->name('iku.persepsi.perbarui');
					Route::post('perbarui/semua', [IkuPersepsiController::class, 'updateAll'])->name('iku.persepsi.perbarui.semua');
					Route::put('{id}/setujui', [IkuPersepsiController::class, 'accept'])->where('id', '[0-9]+')->name('iku.persepsi.setujui');
				});
			});
			Route::prefix('sasaran')->group(function () {
				Route::prefix('{tahun?}/{unit?}')->group(function () {
					Route::get('/', [IkuSasaranController::class, 'index'])->name('iku.sasaran.index');
				});
				Route::prefix('{tahun}/{unit}')->group(function () {
					Route::post('ubah', [IkuSasaranController::class, 'edit'])->name('iku.sasaran.ubah');
					Route::put('perbarui', [IkuSasaranController::class, 'update'])->name('iku.sasaran.perbarui');
					Route::post('perbarui/semua', [IkuSasaranController::class, 'updateAll'])->name('iku.sasaran.perbarui.semua');
					Route::put('{id}/setujui', [IkuSasaranController::class, 'accept'])->where('id', '[0-9]+')->name('iku.sasaran.setujui');
				});
			});
			Route::prefix('aspek')->group(function () {
				Route::get('{iku?}/{unit?}', [AspekIkuController::class, 'index'])->name('iku.aspek.index');
				Route::prefix('{iku}/{unit}')->group(function () {
					Route::post('simpan', [AspekIkuController::class, 'store'])->name('iku.aspek.simpan');
					Route::put('ubah', [AspekIkuController::class, 'edit'])->name('iku.aspek.ubah');
					Route::delete('{id}/hapus', [AspekIkuController::class, 'destroy'])->where('id', '[0-9]+')->name('iku.aspek.hapus');
					Route::put('{id}/setujui', [AspekIkuController::class, 'accept'])->where('id', '[0-9]+')->name('iku.aspek.setujui');
					Route::put('setujui/semua', [AspekIkuController::class, 'acceptAll'])->name('iku.aspek.setujui.semua');
				});
			});
		});
	});

	// Penilaian
	Route::get('/kependidikan', [KependidikanController::class, 'index'])->name('kependidikan.index')->middleware('role:kepsek,wakasek,etl,pembinayys,ketuayys,direktur,etm,am,guru,aspv,ctl,ctm,fam,faspv,sek,keu');
	Route::get('/kependidikan/dashboardmapel', [KependidikanController::class, 'penilaianmapel'])->middleware('role:guru');

	Route::prefix('kependidikan/penilaian')->group(function () {
		Route::prefix('predikatsikap')->group(function () {
			Route::get('/', [NilaiSikapController::class, 'predikatsikap']);
			Route::post('tambah', [NilaiSikapController::class, 'simpanPredikat'])->name('predikatsikap.tambah');
			Route::post('hapus', [NilaiSikapController::class, 'hapusPredikat'])->name('predikatsikap.hapus');
			Route::post('ubah', [NilaiSikapController::class, 'ubahPredikat'])->name('predikatsikap.ubah');
		});

		Route::prefix('predikat/iklas')->group(function () {
			Route::get('/', [PredikatNilaiIklasController::class, 'index'])->name('predikat.iklas.index');
			Route::post('tambah', [PredikatNilaiIklasController::class, 'store'])->name('predikat.iklas.tambah');
			Route::post('ubah', [PredikatNilaiIklasController::class, 'edit'])->name('predikat.iklas.ubah');
			Route::put('perbarui', [PredikatNilaiIklasController::class, 'update'])->name('predikat.iklas.perbarui');
		});

		Route::prefix('nilaisikap')->group(function () {
			Route::get('/', [NilaiSikapController::class, 'index']);
			Route::post('simpan', [NilaiSikapController::class, 'simpan'])->name('nilaisikap.simpan');
		});

		Route::prefix('ekstra')->group(function () {
			Route::get('/', [EkstraController::class, 'index']);
			Route::post('simpan', [EkstraController::class, 'simpan'])->name('ekstra.simpan');
			Route::post('getEkstra', [EkstraController::class, 'getEkstra'])->name('ekstra.getEkstra');
		});

		Route::prefix('deskripsiekstra')->group(function () {
			Route::get('/', [NilaiEkstraController::class, 'deskripsiekstra']);
			Route::post('tambah', [NilaiEkstraController::class, 'simpanDeskripsi'])->name('deskripsiekstra.tambah');
			Route::post('hapus', [NilaiEkstraController::class, 'hapusDeskripsi'])->name('deskripsiekstra.hapus');
			Route::post('ubah', [NilaiEkstraController::class, 'ubahDeskripsi'])->name('deskripsiekstra.ubah');
		});

		Route::prefix('kehadiran')->group(function () {
			Route::get('/', [KehadiranController::class, 'index']);
			Route::post('simpan', [KehadiranController::class, 'create'])->name('kehadiran.simpan');
		});

		Route::prefix('prestasi')->group(function () {
			Route::get('/', [PrestasiController::class, 'index']);
			Route::post('simpan', [PrestasiController::class, 'simpan'])->name('prestasi.simpan');
			Route::post('getPrestasi', [PrestasiController::class, 'getPrestasi'])->name('prestasi.getPrestasi');
		});
		Route::prefix('catatanwali')->group(function () {
			Route::get('/', [PenilaianController::class, 'catatanwali']);
			Route::post('simpancatatan', [PenilaianController::class, 'simpancatatan'])->name('catatan.simpan');
		});

		Route::get('kenaikankelas', [PenilaianController::class, 'kenaikankelas']);
		Route::get('cetakpts', [PtsController::class, 'cetakpts'])->name('pts.cetak');
		//Hari yang buat
		Route::get('cetakpts/{id?}/cover', [PtsController::class, 'cover'])->where('id', '[0-9]+')->name('pts.cetak.cover');
		Route::get('cetakpts/{id?}/laporan', [PtsController::class, 'laporan'])->where('id', '[0-9]+')->name('pts.cetak.laporan');
		Route::get('cetakpts/{id?}/laporantk', [PtsController::class, 'laporantk'])->where('id', '[0-9]+')->name('pts.cetak.laporantk');

		Route::prefix('descpts')->group(function () {
			Route::get('/', [PtsController::class, 'descpts']);
			Route::post('tambah', [PtsController::class, 'simpanDeskripsi'])->name('descpts.tambah');
			Route::post('hapus', [PtsController::class, 'hapusDeskripsi'])->name('descpts.hapus');
			Route::post('ubah', [PtsController::class, 'ubahDeskripsi'])->name('descpts.ubah');
		});

		Route::prefix('deskripsipts')->group(function () {
			Route::get('/', [PtsController::class, 'index']);
			Route::post('simpan', [PtsController::class, 'store'])->name('deskripsipts.simpan');
		});
		Route::prefix('indikatoriklas')->group(function () {
			Route::get('/', [PenilaianController::class, 'indikatoriklas'])->name('indikator');
			Route::post('tambah', [PenilaianController::class, 'tambahindikator'])->name('indikator.tambah');
			Route::post('hapus', [PenilaianController::class, 'hapusindikator'])->name('indikator.hapus');
			Route::post('ubah', [PenilaianController::class, 'ubahindikator'])->name('indikator.ubah');
		});

		
		Route::get('cetakpas', [PasController::class, 'cetakpas'])->name('pas.cetak');
		//Hari yang buat
		Route::get('cetakpas/{id?}/cover', [PasController::class, 'cover'])->where('id', '[0-9]+')->name('pas.cetak.cover');
		Route::get('cetakpas/{id?}/laporan', [PasController::class, 'laporan'])->where('id', '[0-9]+')->name('pas.cetak.laporan');
		Route::get('cetakpas/{id?}/laporantk', [PasController::class, 'laporantk'])->where('id', '[0-9]+')->name('pas.cetak.laporantk');
		Route::get('cetakpas/{id?}/akhir', [PasController::class, 'akhir'])->where('id', '[0-9]+')->name('pas.cetak.akhir');

		Route::prefix('iklas')->group(function () {
			Route::get('/', [IklasController::class, 'index']);
			Route::post('simpan', [IklasController::class, 'create'])->name('iklas.simpan');
			Route::post('getNilai', [IklasController::class, 'getNilai'])->name('iklas.getNilai');
		});
	});

Route::prefix('kependidikan')->group(function () {
	Route::prefix('skbm')->group(function () {
		Route::get('/', [SkbmController::class, 'index'])->name('skbm.index')->middleware('role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl,am');
		Route::prefix('{tahunpelajaran?}/{unit?}')->group(function () {
			Route::get('/', [SkbmController::class, 'show'])->name('skbm.tampil')->middleware('role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl,am');
			Route::group(['middleware' => 'role:kepsek'], function () {
				Route::post('simpan', [SkbmController::class, 'store'])->name('skbm.simpan');
				Route::post('ubah', [SkbmController::class, 'edit'])->name('skbm.ubah');
				Route::put('perbarui', [SkbmController::class, 'update'])->name('skbm.perbarui');
				Route::delete('{id}/hapus', [SkbmController::class, 'destroy'])->where('id', '[0-9]+')->name('skbm.hapus');
				Route::get('ekspor', [SkbmController::class, 'export'])->name('skbm.ekspor');
			});
		});
	});
	
		Route::prefix('penilaian')->group(function () {
			Route::group(['middleware' => 'role:kepsek'], function () {
				Route::prefix('mapel')->group(function () {
					Route::prefix('pengetahuan/{tahun?}/{semester?}/{kelas?}/{mataPelajaran?}')->group(function () {
						Route::get('/', [PengetahuanController::class, 'index'])->name('mapel.pengetahuan.index');
						Route::post('perbarui', [PengetahuanController::class, 'update'])->name('mapel.pengetahuan.perbarui');
					});
					Route::prefix('keterampilan/{tahun?}/{semester?}/{kelas?}/{mataPelajaran?}')->group(function () {
						Route::get('/', [KeterampilanController::class, 'index'])->name('mapel.keterampilan.index');
						Route::post('perbarui', [KeterampilanController::class, 'update'])->name('mapel.keterampilan.perbarui');
					});
				});
				Route::prefix('sikap/{tahun?}/{semester?}/{kelas?}')->group(function () {
					Route::get('/', [SikapController::class, 'index'])->name('penilaian.sikap.index');
					Route::post('perbarui', [SikapController::class, 'update'])->name('penilaian.sikap.perbarui');
				});	
				Route::prefix('quran')->group(function () {
					Route::prefix('tilawah/{tahun?}/{semester?}/{kelas?}')->group(function () {
						Route::get('/', [TilawahController::class, 'indexkepsek'])->name('penilaian.tilawah.index');
						Route::post('perbarui', [TilawahController::class, 'update'])->name('penilaian.tilawah.perbarui');
					});
					Route::prefix('hafalan/{tahun?}/{semester?}/{kelas?}/{siswa?}')->group(function () {
						Route::get('/', [HafalanController::class, 'index'])->name('penilaian.hafalan.index');
						Route::post('perbarui', [HafalanController::class, 'update'])->name('penilaian.hafalan.perbarui');
					});
				});
			});
		});

		//Sertifikat IKLaS
		Route::prefix('sertifiklas')->group(function () {
			Route::get('nilai', [IklasController::class, 'sertif']);
			Route::post('simpan', [IklasController::class, 'sertifcreate'])->name('sertifiklas.simpan');
			Route::post('getNilai', [IklasController::class, 'sertifgetNilai'])->name('sertifiklas.getNilai');
			Route::get('cetak', [IklasController::class, 'sertifcetak'])->name('sertifiklas.cetak');
			Route::post('print', [IklasController::class, 'sertifprint'])->name('sertifiklas.print');
			Route::post('set_tanggal', [IklasController::class, 'set_tanggal'])->name('sertifiklas.set_tanggal');
		});

		Route::prefix('ledger')->group(function () {
			Route::prefix('kelas/{tahun?}/{semester?}/{kelas?}')->group(function () {
				Route::get('/', [PenilaianIkuEdukasiController::class, 'index'])->name('penilaian.ikuEdukasi.kelas')->middleware('role:kepsek,wakasek,guru,pembinayys,ketuayys,direktur,etl');
			});
			Route::prefix('unit/{ledger?}/{unit?}/{tahun?}/{semester?}')->group(function () {
				Route::get('/', [PenilaianIkuEdukasiController::class, 'unit'])->name('penilaian.ikuEdukasi.unit')->middleware('role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl');
			});
			Route::prefix('grafik/{ledger?}/{unit?}/{tahun?}/{semester?}')->group(function () {
				Route::get('/', [PenilaianIkuEdukasiController::class, 'chart'])->name('penilaian.ikuEdukasi.grafik')->middleware('role:kepsek,pembinayys,ketuayys,direktur,etl');
			});
		});

		Route::prefix('iku-edukasi/{ledger?}/{unit?}/{tahun?}/{semester?}')->group(function () {
			Route::get('/', [PenilaianIkuEdukasiController::class, 'persen'])->name('penilaian.ikuEdukasi.persen')->middleware('role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl');
			Route::post('/', [PenilaianIkuEdukasiController::class, 'getPersen'])->name('penilaian.ikuEdukasi.persen.get')->middleware('role:kepsek,wakasek,pembinayys,ketuayys,direktur,etl');
		});
	});

	//Khusus TK
	Route::prefix('kependidikan/penilaiantk')->group(function () {
		Route::prefix('indikator')->group(function () {
			Route::get('/', [IndikatorController::class, 'index']);
			Route::post('simpan', [IndikatorController::class, 'simpan'])->name('indikatoraspek.tambah');
			Route::post('ubah', [IndikatorController::class, 'ubah'])->name('indikatoraspek.ubah');
			Route::post('hapus', [IndikatorController::class, 'hapus'])->name('indikatoraspek.hapus');
			Route::post('getindikator', [IndikatorController::class, 'getindikator'])->name('indikatoraspek.getindikator');
		});
		Route::prefix('descindikator')->group(function () {
			Route::get('/', [IndikatorController::class, 'desc']);
			Route::post('simpan', [IndikatorController::class, 'simpandesc'])->name('descindikator.tambah');
			Route::post('ubah', [IndikatorController::class, 'ubahdesc'])->name('descindikator.ubah');
			Route::post('hapus', [IndikatorController::class, 'hapusdesc'])->name('descindikator.hapus');
			Route::post('getdesc', [IndikatorController::class, 'getdesc'])->name('descindikator.getdesc');
		});
		Route::prefix('nilaiaspek')->group(function () {
			Route::get('/', [NilaiAspekController::class, 'index']);
			Route::post('getNilai', [NilaiAspekController::class, 'getnilai'])->name('nilaiaspek.getNilai');
			Route::post('simpan', [NilaiAspekController::class, 'store'])->name('nilaiaspek.simpan');
		});
		Route::prefix('nilaiindikator')->group(function () {
			Route::get('/', [NilaiIndikatorController::class, 'index']);
			Route::post('getNilai', [NilaiIndikatorController::class, 'getnilai'])->name('nilaiindikator.getNilai');
			Route::post('simpan', [NilaiIndikatorController::class, 'store'])->name('nilaiindikator.simpan');
		});
		Route::prefix('descaspek')->group(function () {
			Route::get('/', [AspekController::class, 'index']);
			Route::post('simpan', [AspekController::class, 'simpan'])->name('descaspek.tambah');
			Route::post('ubah', [AspekController::class, 'ubah'])->name('descaspek.ubah');
			Route::post('hapus', [AspekController::class, 'hapus'])->name('descaspek.hapus');
			Route::post('getdesc', [AspekController::class, 'getdeskripsi'])->name('descaspek.getdesc');
			Route::post('getubahdesc', [AspekController::class, 'getubah'])->name('descaspek.getubahdesc');
		});
	});
	Route::prefix('kependidikan/refijazah')->group(function () {
		Route::get('/', [SkhbController::class, 'index']);
		Route::post('generate', [SkhbController::class, 'generate'])->name('refijazah.generate');
		Route::get('regenerate/{id?}', [SkhbController::class, 'regenerate'])->where('id', '[0-9]+')->name('refijazah.regenerate');
		Route::post('regenerate_nilai', [SkhbController::class, 'regenerate_simpan'])->name('refijazah.regenerate_simpan');
	});

	// Guru Mapel
	Route::prefix('kependidikan/ijazahmapel')->group(function () {
		Route::prefix('nilaipraktek')->group(function () {
			Route::get('/', [PraktekUspController::class, 'praktek']);
			Route::post('simpan', [PraktekUspController::class, 'storepraktek'])->name('nilaipraktek.simpan');
			Route::post('getkelas', [PraktekUspController::class, 'getkelas'])->name('nilaipraktek.getkelas');
			Route::post('getsiswa', [PraktekUspController::class, 'getsiswapraktek'])->name('nilaipraktek.getsiswa');
		});
		Route::prefix('nilaiusp')->group(function () {
			Route::get('/', [PraktekUspController::class, 'usp']);
			Route::post('simpan', [PraktekUspController::class, 'storeusp'])->name('nilaiusp.simpan');
			Route::post('getkelas', [PraktekUspController::class, 'getkelas'])->name('nilaiusp.getkelas');
			Route::post('getsiswa', [PraktekUspController::class, 'getsiswausp'])->name('nilaiusp.getsiswa');
		});
	});
	Route::prefix('kependidikan/penilaianmapel')->group(function () {
		Route::prefix('nilaipengetahuan')->group(function () {
			Route::get('/', [NilaiPengetahuanController::class, 'index']);
			Route::post('simpan', [NilaiPengetahuanController::class, 'store'])->name('nilaipengetahuan.simpan');
			Route::post('getkelas', [NilaiPengetahuanController::class, 'getkelas'])->name('pengetahuan.getkelas');
			Route::post('getsiswa', [NilaiPengetahuanController::class, 'getsiswa'])->name('pengetahuan.getsiswa');
		});
		
		Route::prefix('indikator/mapel')->group(function () {
			Route::get('/', [IndikatorPengetahuanController::class, 'index'])->name('indikator.pengetahuan.index');
			Route::post('tambah', [IndikatorPengetahuanController::class, 'tambahindikator'])->name('indikator.pengetahuan.tambah');
			Route::post('hapus', [IndikatorPengetahuanController::class, 'hapusindikator'])->name('indikator.pengetahuan.hapus');
			Route::post('ubah', [IndikatorPengetahuanController::class, 'ubahindikator'])->name('indikator.pengetahuan.ubah');
		});
		
		Route::prefix('nilaitilawah')->group(function () {
			Route::get('/', [TilawahController::class, 'index']);
			Route::post('simpan', [TilawahController::class, 'store'])->name('tilawah.simpan');
			Route::post('getkelas', [TilawahController::class, 'getkelas'])->name('tilawah.getkelas');
			Route::post('getsiswa', [TilawahController::class, 'getsiswa'])->name('tilawah.getsiswa');
		});
		Route::prefix('nilaisikap')->group(function () {
			Route::get('/', [NilaiSikapController::class, 'nilaipts']);
			Route::post('simpan', [NilaiSikapController::class, 'simpannilaipts'])->name('nilaisikappts.simpan');
			Route::post('getkelas', [NilaiSikapController::class, 'getkelas'])->name('nilaisikappts.getkelas');
			Route::post('getsiswa', [NilaiSikapController::class, 'getsiswa'])->name('nilaisikappts.getsiswa');
		});
		Route::prefix('nilaihafalan')->group(function () {
			Route::get('/', [TahfidzController::class, 'index']);
			Route::post('simpan', [TahfidzController::class, 'store'])->name('hafalan.simpan');
			Route::post('getHafalan', [TahfidzController::class, 'getHafalan'])->name('hafalan.getHafalan');
			Route::post('getsiswa', [TahfidzController::class, 'getsiswa'])->name('hafalan.getsiswa');
			Route::post('getkelas', [TahfidzController::class, 'getkelas'])->name('hafalan.getkelas');
		});
		Route::prefix('nilaihadits')->group(function () {
			Route::get('/', [HaditsController::class, 'index']);
			Route::post('simpan', [HaditsController::class, 'store'])->name('hadits.simpan');
			Route::post('getHadits', [HaditsController::class, 'getHadits'])->name('hadits.getHadits');
			Route::post('getsiswa', [HaditsController::class, 'getsiswa'])->name('hadits.getsiswa');
			Route::post('getkelas', [HaditsController::class, 'getkelas'])->name('hadits.getkelas');
		});
		Route::prefix('deschafal')->group(function () {
			Route::get('/', [TahfidzController::class, 'desc']);
			Route::post('tambah', [TahfidzController::class, 'simpanDeskripsi'])->name('deschafal.tambah');
			Route::post('hapus', [TahfidzController::class, 'hapusDeskripsi'])->name('deschafal.hapus');
			Route::post('ubah', [TahfidzController::class, 'ubahDeskripsi'])->name('deschafal.ubah');
			Route::post('getdesc', [TahfidzController::class, 'getdesc'])->name('deschafal.getdesc');
		});
		Route::prefix('targettahfidz')->group(function () {
			Route::get('/', [TahfidzController::class, 'target']);
			Route::post('simpan', [TahfidzController::class, 'simpanTarget'])->name('targettahfidz.simpan');
			Route::post('gettarget', [TahfidzController::class, 'gettarget'])->name('targettahfidz.gettarget');
		});
		Route::prefix('predikatpengetahuan')->group(function () {
			Route::get('/', [NilaiPengetahuanController::class, 'predikat']);
			Route::post('tambah', [NilaiPengetahuanController::class, 'simpanPredikat'])->name('predikatpengetahuan.tambah');
			Route::post('hapus', [NilaiPengetahuanController::class, 'hapusPredikat'])->name('predikatpengetahuan.hapus');
			Route::post('ubah', [NilaiPengetahuanController::class, 'ubahPredikat'])->name('predikatpengetahuan.ubah');
			Route::post('getlevel', [NilaiPengetahuanController::class, 'getlevel'])->name('predikatpengetahuan.getlevel');
			Route::post('getdesc', [NilaiPengetahuanController::class, 'getdesc'])->name('predikatpengetahuan.getdesc');
		});
		Route::prefix('nilaiketerampilan')->group(function () {
			Route::get('/', [NilaiKeterampilanController::class, 'index']);
			Route::post('simpan', [NilaiKeterampilanController::class, 'store'])->name('nilaiketerampilan.simpan');
			Route::post('getkelas', [NilaiKeterampilanController::class, 'getkelas'])->name('keterampilan.getkelas');
			Route::post('getsiswa', [NilaiKeterampilanController::class, 'getsiswa'])->name('keterampilan.getsiswa');
		});
		Route::prefix('predikatketerampilan')->group(function () {
			Route::get('/', [NilaiKeterampilanController::class, 'predikat']);
			Route::post('tambah', [NilaiKeterampilanController::class, 'simpanPredikat'])->name('predikatketerampilan.tambah');
			Route::post('hapus', [NilaiKeterampilanController::class, 'hapusPredikat'])->name('predikatketerampilan.hapus');
			Route::post('ubah', [NilaiKeterampilanController::class, 'ubahPredikat'])->name('predikatketerampilan.ubah');
			Route::post('getlevel', [NilaiKeterampilanController::class, 'getlevel'])->name('predikatketerampilan.getlevel');
			Route::post('getdesc', [NilaiKeterampilanController::class, 'getdesc'])->name('predikatketerampilan.getdesc');
		});
		Route::prefix('kdsetting')->group(function () {
			Route::get('/', [PenilaianController::class, 'kdsetting'])->name('kd.setting');
			Route::post('simpan', [PenilaianController::class, 'kdsimpan'])->name('kd.simpan');
			Route::post('getlevel', [PenilaianController::class, 'kdlevel'])->name('kdsetting.getlevel');
			Route::post('getkd', [PenilaianController::class, 'getkd'])->name('kdsetting.getkd');
		});
		Route::prefix('rangepredikat')->group(function () {
			Route::get('/', [RangePredikatController::class, 'index'])->name('range.index');
			Route::post('simpan', [RangePredikatController::class, 'simpan'])->name('range.simpan');
			Route::post('getlevel', [RangePredikatController::class, 'level'])->name('range.getlevel');
			Route::post('getrange', [RangePredikatController::class, 'getrange'])->name('range.getrange');
		});
	});

	// Kepsek

	Route::prefix('kependidikan/penilaiankepsek')->group(function () {
		Route::prefix('pts')->group(function () {
			Route::get('/', [RaporKepsekController::class, 'pts'])->name('ptskepsek');
			Route::post('validasi', [RaporKepsekController::class, 'validasipts'])->name('ptskepsek.validasi');
			Route::get('validasi/{id}', [RaporKepsekController::class, 'validasisiswapts'])->where('id', '[0-9]+');
			Route::post('getkelas', [RaporKepsekController::class, 'getkelas'])->name('ptskepsek.getkelas');
			Route::post('getsiswa', [RaporKepsekController::class, 'getsiswapts'])->name('ptskepsek.getsiswa');
			Route::post('lihatnilai', [RaporKepsekController::class, 'lihatnilaipts'])->name('ptskepsek.lihatnilai');
			Route::post('lihatnilaitk', [RaporKepsekController::class, 'lihatnilaiptstk'])->name('ptskepsek.lihatnilaitk');
		});
		Route::prefix('pas')->group(function () {
			Route::get('/', [RaporKepsekController::class, 'pas'])->name('paskepsek');
			Route::post('validasi', [RaporKepsekController::class, 'validasipas'])->name('paskepsek.validasi');
			Route::get('validasi/{id}', [RaporKepsekController::class, 'validasisiswapas'])->where('id', '[0-9]+');
			Route::post('getkelas', [RaporKepsekController::class, 'getkelas'])->name('paskepsek.getkelas');
			Route::post('getsiswa', [RaporKepsekController::class, 'getsiswapas'])->name('paskepsek.getsiswa');
			Route::post('naikkelas', [RaporKepsekController::class, 'naikkelas'])->name('paskepsek.naikkelas');
			Route::post('lihatnilai', [RaporKepsekController::class, 'lihatnilaipas'])->name('paskepsek.lihatnilai');
			Route::post('lihatnilaitk', [RaporKepsekController::class, 'lihatnilaipastk'])->name('paskepsek.lihatnilaitk');
			Route::prefix('cover/{tahun?}/{semester?}/{kelas?}/{id?}')->group(function () {
				Route::get('/', [RaporKepsekController::class, 'cover'])->name('paskepsek.cover')->middleware('role:kepsek');
			});
			Route::prefix('akhir/{tahun?}/{semester?}/{kelas?}/{id?}')->group(function () {
				Route::get('/', [RaporKepsekController::class, 'akhir'])->name('paskepsek.akhir')->middleware('role:kepsek');
			});
		});
		Route::prefix('tanggalrapor')->group(function () {
			Route::get('/', [RaporKepsekController::class, 'tanggalrapor'])->name('kepsek.tanggalrapor');
			Route::post('simpan', [RaporKepsekController::class, 'simpantanggal'])->name('kepsek.simpantanggal');
		});
		Route::prefix('tk')->group(function () {
			Route::get('aspekperkembangan', [RaporKepsekController::class, 'aspekperkembangan'])->name('kepsek.aspekperkembangan');
			Route::post('tambahaspek', [RaporKepsekController::class, 'tambahaspek'])->name('aspekperkembangan.tambah');
			Route::post('ubahaspek', [RaporKepsekController::class, 'ubahaspek'])->name('aspekperkembangan.ubah');
			Route::post('hapusaspek', [RaporKepsekController::class, 'hapusaspek'])->name('aspekperkembangan.hapus');
		});
		Route::prefix('nilaipengetahuan')->group(function () {
			Route::get('/', [NilaiPengetahuanController::class, 'indexkepsek']);
			Route::post('simpan', [NilaiPengetahuanController::class, 'storekepsek'])->name('npkepsek.simpan');
			Route::post('getkelas', [NilaiPengetahuanController::class, 'getkelaskepsek'])->name('npkepsek.getkelas');
			Route::post('getsiswa', [NilaiPengetahuanController::class, 'getsiswakepsek'])->name('npkepsek.getsiswa');
		});
		Route::prefix('passwordverifikasi')->group(function () {
			Route::get('/', [RaporKepsekController::class, 'password'])->name('pwkepsek.index');
			Route::post('simpan', [RaporKepsekController::class, 'simpanpassword'])->name('pwkepsek.simpan');
		});
		Route::prefix('rangepredikat')->group(function () {
			Route::get('/', [RangePredikatController::class, 'indexkepsek'])->name('rangekepsek.index');
			Route::post('simpan', [RangePredikatController::class, 'simpankepsek'])->name('rangekepsek.simpan');
			Route::post('getlevel', [RangePredikatController::class, 'levelkepsek'])->name('rangekepsek.getlevel');
			Route::post('getrange', [RangePredikatController::class, 'getrange'])->name('rangekepsek.getrange');
		});
	});

	Route::prefix('kependidikan/ijazahkepsek')->group(function () {
		Route::prefix('refijazah')->group(function () {
			Route::get('/', [SKHBController::class, 'kepsek']);
			Route::get('validasi/{id}', [SKHBController::class, 'validasisiswa']);
			Route::post('validasi_all', [SKHBController::class, 'validasi'])->name('refijazah.validasi');
			Route::post('getsiswa', [SKHBController::class, 'getsiswa'])->name('refijazah.getsiswa');
			Route::post('lihatnilai', [SKHBController::class, 'lihatnilai'])->name('refijazah.lihatnilai');
		});
	});
	Route::prefix('kependidikan/ijazah/arsip')->group(function () {
		Route::get('/', [ArsipIjazahController::class, 'index']);
		Route::post('store', [ArsipIjazahController::class, 'store']);
	});

	Route::prefix('kependidikan/skhb/arsip')->group(function () {
		Route::get('/', [ArsipSkhbController::class, 'index']);
		Route::post('store', [ArsipSkhbController::class, 'store']);
	});

	//Sertifikat IKLaS Kepsek
	Route::prefix('kependidikan/sertifiklaskepsek')->group(function () {
		Route::get('/', [IklasController::class, 'sertifKepsek'])->name('sertifiklaskepsek.index');
		Route::post('getSiswa', [IklasController::class, 'sertifKepsekGetSiswa'])->name('sertifiklaskepsek.getsiswa');
		Route::post('print', [IklasController::class, 'sertifPrintKepsek'])->name('sertifiklaskepsek.print');
	});


	Route::prefix('kependidikan/kbm')->group(function () {


		Route::prefix('siswa')->group(function () {
			// KBM
			// marketing
			Route::get('new', [SiswaController::class, 'newIndex']);
			Route::get('onLoad', [SiswaController::class, 'onLoadIndex']);
			Route::get('test', [SiswaController::class, 'test']);
			Route::group(['middleware' => ['auth', 'checkRole:1,7,11,12,13,15,16,18,25,26,29,30,31,2,3,18']], function () {
				Route::get('', [SiswaController::class, 'index']);
				Route::post('', [SiswaController::class, 'filter']);
				Route::get('aktif', [SiswaController::class, 'index']);
				Route::post('aktif', [SiswaController::class, 'filter']);
				Route::get('aktif/datatables', [SiswaController::class, 'datatablesSiswa'])->name('siswa-datatables');
			});
			Route::group(['middleware' => ['auth', 'checkRole:1,7,11,12,13,15,16,18,29,30,31,2,3,18']], function () {
				Route::get('aktif/download', [SiswaController::class, 'downloadSiswa'])->name('siswa-datatables');
				Route::get('alumni', [SiswaController::class, 'indexAlumni']);
				Route::post('alumni', [SiswaController::class, 'filterAlumni']);
				Route::get('alumni/datatables', [SiswaController::class, 'datatablesAlumni'])->name('siswa-datatables');
				Route::get('alumni/download', [SiswaController::class, 'downloadAlumni'])->name('siswa-datatables');
			});
			Route::group(['middleware' => ['auth', 'checkRole:1,2']], function () {
				Route::get('/tambah', [SiswaController::class, 'create']);
				Route::post('/tambah', [SiswaController::class, 'store']);
			});
			Route::group(['middleware' => ['auth', 'checkRole:1,2,7,18,30,31']], function () {
				Route::get('/ubah/{id}', [SiswaController::class, 'edit']);
				Route::put('/ubah/{id}', [SiswaController::class, 'update']);
			});
			Route::group(['middleware' => ['auth', 'checkRole:25,26']], function () {
				Route::post('/ubah-spp', [SiswaController::class, 'updateStartOfSpp'])->name('siswa.ubah-awal-spp');
			});
			Route::group(['middleware' => ['auth', 'checkRole:1,7,11,12,13,15,16,18,29,30,31,2,3,18']], function () {
				Route::get('/lihat/{id}', [SiswaController::class, 'show']); // ??
			});
			Route::post('/hapus/{id}', [SiswaController::class, 'destroy']); // ??
		});


		Route::prefix('kelas')->group(function () {

			Route::prefix('nama-kelas')->group(function () {
				// kepsek
				// Nama Kelas
				Route::group(['middleware' => ['auth', 'checkRole:1,11,12,13,15,16,2']], function () {
					Route::get('', [NamaKelasController::class, 'index']);
				});
				Route::group(['middleware' => ['auth', 'checkRole:1,2']], function () {
					Route::get('tambah', [NamaKelasController::class, 'create']);
					Route::post('tambah', [NamaKelasController::class, 'store']);
					Route::put('ubah/{id}', [NamaKelasController::class, 'update']);
					Route::post('hapus/{id}', [NamaKelasController::class, 'destroy']);
				});
			});

			Route::prefix('jurusan')->group(function () {
				// kepsek
				// Jurusan
				Route::group(['middleware' => ['auth', 'checkRole:1,11,12,13,15,16,2']], function () {
					Route::get('', [NamaKelasController::class, 'index']);
				});
				Route::group(['middleware' => ['auth', 'checkRole:1,2']], function () {
					Route::get('tambah', [NamaKelasController::class, 'create']);
					Route::post('tambah', [NamaKelasController::class, 'store']);
					Route::put('ubah/{id}', [NamaKelasController::class, 'update']);
					Route::post('hapus/{id}', [NamaKelasController::class, 'destroy']);
				});
			});

			Route::prefix('daftar-kelas')->group(function () {
				// kelas
				Route::group(['middleware' => ['auth', 'checkRole:1,11,12,13,15,16,2']], function () {
					Route::get('', [KelasController::class, 'index']);
				});
				Route::group(['middleware' => ['auth', 'checkRole:1,2']], function () {
					Route::get('tambah', [KelasController::class, 'create']);
					Route::post('tambah', [KelasController::class, 'store']);
					Route::get('lihat/{id}', [KelasController::class, 'show']);
					Route::get('ubah/{id}', [KelasController::class, 'edit']);
					Route::put('ubah/{id}', [KelasController::class, 'update']);
					Route::post('hapus/{id}', [KelasController::class, 'destroy']);
				});
			});

			//kepsek
			//pengajuan kelas
			Route::group(['middleware' => ['auth', 'checkRole:1,11,12,13,15,16,2,3,29,30']], function () {
				Route::get('pengajuan-kelas', [PengajuanKelasController::class, 'index']);
				Route::get('pengajuan-kelas/lihat/{id}', [PengajuanKelasController::class, 'lihat']);
			});
			Route::group(['middleware' => ['auth', 'checkRole:1,2,29,30']], function () {
				Route::get('pengajuan-kelas/unduh/{id}', [PengajuanKelasController::class, 'cetakPDF']);
			});
			Route::group(['middleware' => ['auth', 'checkRole:1,2']], function () {
				Route::post('pengajuan-kelas/setuju/{id}', [PengajuanKelasController::class, 'setuju']);
				Route::post('pengajuan-kelas/tolak/{id}', [PengajuanKelasController::class, 'tolak']);
				Route::post('pengajuan-kelas/lihat/{id}', [PengajuanKelasController::class, 'tambah']);
				Route::post('pengajuan-kelas/lihat/{kelas}/{id}', [PengajuanKelasController::class, 'hapus']);
			});
			Route::group(['middleware' => ['auth', 'checkRole:1,5']], function () {
				// wali kelas
				Route::get('kelas-diampu', [AmpuKelasController::class, 'index']);
				Route::get('kelas-diampu/cetak', [AmpuKelasController::class, 'cetakPDF']);
				Route::post('kelas-diampu/ajukan/{id}', [AmpuKelasController::class, 'ajukan']);
				Route::post('kelas-diampu/tambah/{id}', [AmpuKelasController::class, 'tambah']);
				Route::post('kelas-diampu/hapus/{id}', [AmpuKelasController::class, 'hapus']);
			});
		});


		Route::prefix('pelajaran')->group(function () {

			Route::prefix('kelompok-mata-pelajaran')->group(function () {
				// kepsek
				// kelompok mata pelajaran
				Route::group(['middleware' => ['auth', 'checkRole:1,11,12,13,15,16,2']], function () {
					Route::get('', [PelajaranController::class, 'kelompokMataPelajaran']);
				});
				Route::group(['middleware' => ['auth', 'checkRole:1,2']], function () {
					Route::get('tambah', [PelajaranController::class, 'kelompokMataPelajaranTambah']);
					Route::post('tambah', [PelajaranController::class, 'kelompokMataPelajaranStore']);
					Route::put('ubah/{id}', [PelajaranController::class, 'kelompokMataPelajaranUbah']);
					Route::post('hapus/{id}', [PelajaranController::class, 'kelompokMataPelajaranHapus']);
				});
			});


			Route::prefix('mata-pelajaran')->group(function () {
				// mata pelajaran
				Route::group(['middleware' => ['auth', 'checkRole:1,11,12,13,15,16,2,5']], function () {
					Route::get('', [PelajaranController::class, 'index']);
				});
				Route::group(['middleware' => ['auth', 'checkRole:1,2,5']], function () {
					Route::get('tambah', [PelajaranController::class, 'create']);
					Route::post('tambah', [PelajaranController::class, 'store']);
					Route::get('ubah/{id}', [PelajaranController::class, 'edit']);
					Route::put('ubah/{id}', [PelajaranController::class, 'update']);
					Route::post('hapus/{id}', [PelajaranController::class, 'destroy']);
				});
			});

			Route::prefix('waktu-pelajaran')->group(function () {
				// jam pelajaran
				Route::group(['middleware' => ['auth', 'checkRole:1,11,12,13,15,16,2,3']], function () {
					Route::get('', [JamPelajaranController::class, 'index']);
					Route::post('', [JamPelajaranController::class, 'find']);
					Route::get('{tingkat}/{hari}', [JamPelajaranController::class, 'found']);
				});
				Route::group(['middleware' => ['auth', 'checkRole:1,2,3']], function () {
					Route::post('tambah', [JamPelajaranController::class, 'store']);
					Route::put('ubah/{id}', [JamPelajaranController::class, 'update']);
					Route::post('hapus/{id}', [JamPelajaranController::class, 'destroy']);
				});
			});

			// kepsek crud, guru read only
			Route::prefix('jadwal-pelajaran')->group(function () {
				// jadwal pelajaran
				Route::group(['middleware' => ['auth', 'checkRole:1,11,12,13,15,16,2,3,5']], function () {
					Route::get('', [JadwalPelajaranController::class, 'index']);
					Route::post('', [JadwalPelajaranController::class, 'find']);
					Route::get('{kelas}/{hari}', [JadwalPelajaranController::class, 'found']);
					Route::get('unduh', [JadwalPelajaranController::class, 'unduh']);
				});
				Route::group(['middleware' => ['auth', 'checkRole:1,2,3']], function () {
					Route::get('tambah', [JadwalPelajaranController::class, 'create']);
					Route::post('tambah', [JadwalPelajaranController::class, 'store']);
					Route::post('{kelas}/{hari}/tambah', [JadwalPelajaranController::class, 'store']);
					Route::put('{kelas}/{hari}/ubah/{id}', [JadwalPelajaranController::class, 'update']);
					Route::post('{kelas}/{hari}/hapus/{id}', [JadwalPelajaranController::class, 'destroy']);
				});
			});
		});

		Route::prefix('tahun-ajaran')->group(function () {
			// etm
			Route::group(['middleware' => ['auth', 'checkRole:1,11,12,13,15,16']], function () {
				Route::get('', [TahunAjaranController::class, 'index']);
			});
			Route::group(['middleware' => ['auth', 'checkRole:1,13']], function () {
				Route::post('ubah', [TahunAjaranController::class, 'ubah']);
				Route::post('ubah-semester', [TahunAjaranController::class, 'semesterAktif']);
				Route::post('tambah', [TahunAjaranController::class, 'store']);
			});
		});
	});

	/** 
	 *
	 *  Modul Keuangan
	 * 
	 */
	Route::prefix('keuangan')->group(function () {
		Route::get('/', [KeuanganController::class, 'index'])->name('keuangan.index');

		Route::prefix('akun')->group(function () {
			Route::group(['middleware' => 'role:fam,faspv'], function () {
				Route::get('/', [AkunController::class, 'index'])->name('keuangan.akun.index');
				Route::post('simpan', [AkunController::class, 'store'])->name('keuangan.akun.simpan');
				Route::post('ubah', [AkunController::class, 'edit'])->name('keuangan.akun.ubah');
				Route::put('perbarui', [AkunController::class, 'update'])->name('keuangan.akun.perbarui');
				Route::delete('{id}/hapus', [AkunController::class, 'destroy'])->where('id', '[0-9]+')->name('keuangan.akun.hapus');
				Route::get('urutkan', [AkunController::class, 'sort'])->name('keuangan.akun.urutkan');
			});
		});
		Route::prefix('rkat')->group(function () {
			Route::prefix('{jenis?}/{tahun?}/{anggaran?}')->group(function () {
				Route::get('/', [RkatController::class, 'index'])->name('rkat.index')->middleware('role:kepsek,pembinayys,ketuayys,direktur,etl,ctl,fam,faspv,am,ftm');
			});
			Route::prefix('{jenis}/{tahun}/{anggaran}')->group(function () {
				Route::get('buat', [RkatController::class, 'create'])->name('rkat.buat')->middleware('role:kepsek,etl,ctl,fam,faspv,am,ftm');
				Route::post('perbarui', [RkatController::class, 'update'])->name('rkat.perbarui')->middleware('role:kepsek,direktur,etl,ctl,fam,faspv,am,ftm');
				Route::put('validasi/semua', [RkatController::class, 'acceptAll'])->name('rkat.validasi.semua')->middleware('role:direktur,fam');
			});
		});
		Route::prefix('apb')->group(function () {
			Route::prefix('{jenis}/{tahun}')->group(function () {
				Route::get('ekspor', [ApbyController::class, 'export'])->name('apby.ekspor')->middleware('role:ketuayys,direktur,fam,faspv');
				Route::put('perubahan', [ApbyController::class, 'revise'])->name('apby.perubahan')->middleware('role:fam,faspv');
				Route::post('tutup', [ApbyController::class, 'lock'])->name('apby.tutup')->middleware('role:ketuayys');
			});
			Route::prefix('{jenis?}/{tahun?}/{anggaran?}')->group(function () {
				Route::get('/', [ApbyController::class, 'index'])->name('apby.index')->middleware('role:pembinayys,ketuayys,direktur,fam,faspv');
			});
			Route::prefix('{jenis}/{tahun}/{anggaran}')->group(function () {
				Route::post('perbarui', [ApbyController::class, 'update'])->name('apby.perbarui')->middleware('role:ketuayys,direktur,fam,faspv');
				Route::put('validasi/semua', [ApbyController::class, 'acceptAll'])->name('apby.validasi.semua')->middleware('role:ketuayys,direktur');
				Route::post('ubah', [ApbyController::class, 'edit'])->name('apby.ubah');
				Route::put('transfer', [ApbyController::class, 'transfer'])->name('apby.transfer');
			});
		});
		Route::prefix('proposal')->name('proposal-ppa')->group(function () {
			//Route::prefix('{tahun?}')->group(function () {
				Route::get('/', [ProposalPpaController::class, 'index'])->name('.index');
			//});
			//Route::prefix('{tahun}')->group(function () {
				Route::post('create', [ProposalPpaController::class, 'create'])->name('.create');
				Route::post('edit', [ProposalPpaController::class, 'edit'])->name('.edit');
				Route::put('update', [ProposalPpaController::class, 'update'])->where('id', '[0-9]+')->name('.update');
				Route::delete('{id}/destroy', [ProposalPpaController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
				Route::prefix('{id}')->name('.detail')->group(function () {
					Route::get('/', [ProposalPpaController::class, 'show'])->where('id', '[0-9]+')->name('.show');
					Route::post('store', [ProposalPpaController::class, 'detailStore'])->where('id', '[0-9]+')->name('.store');
					Route::put('update/detail/all', [ProposalPpaController::class, 'detailUpdateAll'])->where('id', '[0-9]+')->name('.update.all');  
					Route::put('update/detail', [ProposalPpaController::class, 'detailUpdate'])->where('id', '[0-9]+')->name('.update');
					Route::delete('{item}/destroy', [ProposalPpaController::class, 'detailDestroy'])->where('id', '[0-9]+')->where('item', '[0-9]+')->name('.destroy');
				});
			//});
		});
		Route::prefix('ppa')->group(function () {
			Route::prefix('{jenis?}/{tahun?}/{anggaran?}')->group(function () {
				Route::get('/', [PpaController::class, 'index'])->name('ppa.index')->middleware('role:kepsek,wakasek,keu,pembinayys,ketuayys,direktur,etl,etm,ctl,ctm,fam,faspv,fas,am,aspv,ftm,ftspv,fts');
			});
			Route::prefix('{jenis}/{tahun}/{anggaran}')->group(function () {
				Route::get('buat/{type?}', [PpaController::class, 'create'])->name('ppa.buat')->middleware('role:kepsek,wakasek,keu,etl,etm,ctl,ctm,faspv,fas,am,aspv,ftm,ftspv,fts');
				Route::prefix('{nomor}')->group(function () {
					Route::get('/', [PpaController::class, 'show'])->where('nomor', '[0-9]+')->name('ppa.show')->middleware('role:kepsek,wakasek,keu,pembinayys,ketuayys,direktur,etl,etm,ctl,ctm,fam,faspv,fas,am,aspv,ftm,ftspv,fts');
					Route::group(['middleware' => 'role:kepsek,wakasek,keu,etl,etm,ctl,ctm,fam,faspv,fas,am,aspv,ftm,ftspv,fts'], function () {
						Route::post('tambah', [PpaController::class, 'store'])->where('nomor', '[0-9]+')->name('ppa.tambah');
						Route::post('ubah/detail', [PpaController::class, 'edit'])->name('ppa.ubah.detail');
						Route::put('perbarui/detail', [PpaController::class, 'updateDetail'])->where('nomor', '[0-9]+')->name('ppa.perbarui.detail');
						Route::prefix('{id}')->group(function () {
							Route::get('ubah', [PpaController::class, 'editProposal'])->where('nomor', '[0-9]+')->where('id', '[0-9]+')->name('ppa.ubah.proposal');
							Route::put('perbarui/semua', [PpaController::class, 'updateAllProposal'])->where('nomor', '[0-9]+')->where('id', '[0-9]+')->name('ppa.perbarui.semua.proposal');
							Route::put('perbarui', [PpaController::class, 'updateProposal'])->where('nomor', '[0-9]+')->where('id', '[0-9]+')->name('ppa.perbarui.proposal');
							Route::delete('{item}/hapus', [PpaController::class, 'destroyProposal'])->where('nomor', '[0-9]+')->where('id', '[0-9]+')->where('item', '[0-9]+')->name('ppa.hapus.proposal');
						});
						Route::delete('{id}/hapus', [PpaController::class, 'destroy'])->where('nomor', '[0-9]+')->where('id', '[0-9]+')->name('ppa.hapus');
					});
					Route::put('perbarui/semua', [PpaController::class, 'update'])->where('nomor', '[0-9]+')->name('ppa.perbarui.semua')->middleware('role:kepsek,wakasek,keu,ketuayys,direktur,etl,etm,ctl,ctm,fam,faspv,fas,am,aspv,ftm,ftspv,fts');
					Route::delete('ekslusi', [PpaController::class, 'exclude'])->where('nomor', '[0-9]+')->name('ppa.eksklusi')->middleware('role:fam');
					Route::get('ekspor', [PpaController::class, 'export'])->where('nomor', '[0-9]+')->name('ppa.ekspor')->middleware('role:fam,faspv,keulsi');
				});
			});
		});
		Route::prefix('ppb')->group(function () {
			Route::prefix('{jenis?}/{tahun?}')->group(function () {
				Route::get('/', [PpbController::class, 'index'])->name('ppb.index')->middleware('role:pembinayys,ketuayys,direktur,fam,faspv,fas,keulsi');
			});
			Route::prefix('{jenis}/{tahun}')->group(function () {
				Route::get('buat', [PpbController::class, 'create'])->name('ppb.buat')->middleware('role:faspv');
				Route::prefix('{nomor}')->group(function () {
					Route::get('/', [PpbController::class, 'show'])->where('nomor', '[0-9]+')->name('ppb.show')->middleware('role:pembinayys,ketuayys,direktur,fam,faspv,fas,keulsi');
					Route::get('{ppa}', [PpbController::class, 'view'])->where('nomor', '[0-9]+')->where('ppa', '[0-9]+')->name('ppb.lihat')->middleware('role:keulsi');
					Route::group(['middleware' => 'role:ketuayys,direktur,keulsi'], function () {
						Route::get('{ppa}/ubah', [PpbController::class, 'edit'])->where('nomor', '[0-9]+')->where('ppa', '[0-9]+')->name('ppb.ubah');
						Route::put('{ppa}/perbarui', [PpbController::class, 'update'])->where('nomor', '[0-9]+')->where('ppa', '[0-9]+')->name('ppb.perbarui');
						Route::put('validasi', [PpbController::class, 'accept'])->name('ppb.validasi');
					});
					Route::put('{ppa}/sepakati', [PpbController::class, 'agree'])->where('nomor', '[0-9]+')->where('ppa', '[0-9]+')->name('ppb.sepakati')->middleware('role:direktur,keulsi');
					Route::delete('{ppa}/hapus', [PpbController::class, 'destroy'])->where('nomor', '[0-9]+')->where('id', '[0-9]+')->name('ppb.hapus')->middleware('role:fam');
					Route::get('ekspor', [PpbController::class, 'export'])->name('ppb.ekspor')->middleware('role:fam,faspv,fas,keulsi');
				});
			});
		});
		Route::prefix('rppa')->group(function () {
			Route::prefix('{jenis?}/{tahun?}/{anggaran?}')->group(function () {
				Route::get('/', [LppaController::class, 'index'])->name('lppa.index')->middleware('role:kepsek,wakasek,keu,pembinayys,ketuayys,direktur,etl,etm,ctl,ctm,fam,faspv,fas,am,aspv,ftm,ftspv,fts');
			});
			Route::prefix('{jenis}/{tahun}/{anggaran}/{nomor}')->group(function () {
				Route::get('/', [LppaController::class, 'show'])->where('nomor', '[0-9]+')->name('lppa.show')->middleware('role:kepsek,wakasek,keu,pembinayys,ketuayys,direktur,etl,etm,ctl,ctm,fam,faspv,fas,am,aspv,ftm,ftspv,fts');
				Route::put('perbarui', [LppaController::class, 'update'])->where('nomor', '[0-9]+')->name('lppa.perbarui')->middleware('role:kepsek,wakasek,keu,ketuayys,direktur,etl,etm,ctl,ctm,fam,faspv,am,aspv,ftm,ftspv,fts');
				Route::put('validasi', [LppaController::class, 'accept'])->name('lppa.validasi')->middleware('role:fam');
				Route::get('ekspor', [LppaController::class, 'export'])->name('lppa.ekspor')->middleware('role:fam,faspv');
			});
		});
		Route::prefix('realisasi')->group(function () {
			Route::get('sinkronisasi', [RealisasiKeuanganController::class, 'sync'])->name('realisasi.sync')->middleware('role:fam,faspv');
			Route::prefix('{jenis?}/{tahun?}/{anggaran?}')->group(function () {
				Route::get('/', [RealisasiKeuanganController::class, 'index'])->name('realisasi.index')->middleware('role:pembinayys,ketuayys,direktur,fam,faspv');
			});
		});
		Route::prefix('saldo')->group(function () {
			Route::prefix('{jenis?}/{tahun?}/{anggaran?}')->group(function () {
				Route::get('/', [SaldoAnggaranController::class, 'index'])->name('saldo.index')->middleware('role:keulsi');
			});
		});

		/** 
		 *  Sub Modul Pembayaran Uang Sekolah
		 */
		Route::get('dashboard', [PembayaranDashboardController::class, 'index']);
		Route::group(['middleware' => ['auth', 'checkRole:25']], function () {
			Route::prefix('pemindahan-transaksi')->name('exchange')->group(function (){
				Route::get('/', [ExchangeTransactionController::class, 'index'])->name('.index');
	 			Route::get('refund', [ExchangeTransactionController::class, 'refund'])->name('.refund');
	 			Route::post('/', [ExchangeTransactionController::class, 'update'])->name('.update');
	 			Route::put('/', [ExchangeTransactionController::class, 'store'])->name('.store');
	 			Route::delete('/', [ExchangeTransactionController::class, 'destroy'])->name('.destroy');
			});
 		});

		Route::group(['middleware' => ['auth', 'checkRole:1,2,8,11,12,13,18,25,26']], function () {
			Route::prefix('bms')->name('bms')->group(function () {
				// Deprecated
				//Route::get('', [BmsController::class, 'index'])->name('.index');
				//Route::get('dashboard', [PembayaranDashboardController::class, 'dashboardBms']);
				//Route::post('dashboard', [PembayaranDashboardController::class, 'bmsData']);
				//Route::get('siswa', [BmsController::class, 'index']);
				Route::get('/', [DasborSppController::class, 'index'])->name('.index');
				Route::prefix('dashboard')->name('.dasbor')->group(function (){
					Route::get('{jenis?}', [DasborBmsController::class, 'index'])->name('.index');
					Route::post('{jenis?}', [DasborBmsController::class, 'indexGet'])->name('.get');
				});
				Route::prefix('status')->name('.status')->group(function (){
					Route::get('{siswa?}', [StatusBmsController::class, 'index'])->name('.index');
				});
				Route::get('cetak/{id}', [BmsController::class, 'cetakTagihan'])->name('.print');
				Route::prefix('pengingat/{siswa?}')->name('.reminder')->group(function (){
					Route::post('email/buat', [StatusBmsController::class, 'reminderEmailCreate'])->name('.email.create');
					Route::post('email/{id}', [StatusBmsController::class, 'reminderEmail'])->name('.email');
					Route::get('wa/{id}', [StatusBmsController::class, 'reminderWhatsApp'])->name('.wa');
				});
				Route::prefix('va')->name('.va')->group(function (){
					Route::get('/', [VaBmsController::class, 'index'])->name('.index');
					Route::post('/', [VaBmsController::class, 'vaGet'])->name('.get');
				});
				Route::prefix('nominal')->name('.nominal')->group(function () {
					Route::get('/', [NominalBmsController::class, 'index'])->name('.index')->middleware('role:pembinayys,ketuayys,direktur,fam');
					Route::group(['middleware' => 'role:fam'], function () {
						Route::post('simpan', [NominalBmsController::class, 'store'])->name('.store');
						Route::post('ubah', [NominalBmsController::class, 'edit'])->name('.edit');
						Route::put('perbarui', [NominalBmsController::class, 'update'])->name('.update');
						Route::delete('{id}/hapus', [NominalBmsController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
					});		
				});		
				Route::prefix('potongan')->name('.potongan')->group(function () {
					Route::get('/', [PotonganBmsController::class, 'index'])->name('.index')->middleware('role:pembinayys,ketuayys,direktur,fam');
					Route::group(['middleware' => 'role:fam'], function () {
						Route::post('simpan', [PotonganBmsController::class, 'store'])->name('.store');
						Route::post('ubah', [PotonganBmsController::class, 'edit'])->name('.edit');
						Route::put('perbarui', [PotonganBmsController::class, 'update'])->name('.update');
						Route::delete('{id}/hapus', [PotonganBmsController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
					});
				});
				Route::prefix('pembayaran')->name('.pembayaran')->group(function (){
					Route::post('ubah-transaksi', [PembayaranBmsController::class, 'changeTransaction'])->name('.change.transaction');
					Route::post('ubah-kategori', [PembayaranBmsController::class, 'bmsToSpp'])->name('.change.category');
					Route::get('{siswa?}', [PembayaranBmsController::class, 'index'])->name('.index');
					Route::post('{siswa?}', [PembayaranBmsController::class, 'indexGet'])->name('.get');
				});
				// Deprecated
				//Route::get('rencana', [BmsController::class, 'rencana']);
				//Route::get('laporan-bms-siswa', [BmsController::class, 'LaporanSiswa']);
				//Route::get('log', [BmsController::class, 'log']);
			});
			Route::prefix('spp')->name('spp')->group(function () {
				// Deprecated
				//Route::get('', [SppController::class, 'index'])->name('.index');
				//Route::get('dashboard', [PembayaranDashboardController::class, 'dashboardSpp']);
				//Route::post('dashboard', [PembayaranDashboardController::class, 'sppData']);
				Route::get('/', [DasborSppController::class, 'index'])->name('.index');
				Route::get('dashboard', [DasborSppController::class, 'index'])->name('.dasbor.index');
				Route::prefix('status')->name('.status')->group(function (){
					Route::get('{siswa?}', [StatusSppController::class, 'index'])->name('.index');
					Route::post('{siswa?}', [StatusSppController::class, 'indexGet'])->name('.get');
				});
				Route::prefix('pengingat')->name('.reminder')->group(function (){
					Route::post('email/buat', [StatusSppController::class, 'reminderEmailCreate'])->name('.email.create');
					Route::post('email/{id}', [StatusSppController::class, 'reminderEmail'])->name('.email');
					Route::get('wa/{id}', [StatusSppController::class, 'reminderWhatsApp'])->name('.wa');
				});
				Route::prefix('va')->name('.va')->group(function (){
					Route::get('/', [VaSppController::class, 'index'])->name('.index');
					Route::post('/', [VaSppController::class, 'vaGet'])->name('.get');
				});
				Route::prefix('nominal')->name('.nominal')->group(function () {
					Route::get('/', [NominalSppController::class, 'index'])->name('.index')->middleware('role:pembinayys,ketuayys,direktur,fam');
					Route::group(['middleware' => 'role:fam'], function () {
						Route::post('simpan', [NominalSppController::class, 'store'])->name('.store');
						Route::post('ubah', [NominalSppController::class, 'edit'])->name('.edit');
						Route::put('perbarui', [NominalSppController::class, 'update'])->name('.update');
						Route::delete('{id}/hapus', [NominalSppController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
					});
				});
				Route::prefix('potongan')->name('.potongan')->group(function () {
					Route::get('/', [PotonganSppController::class, 'index'])->name('.index')->middleware('role:pembinayys,ketuayys,direktur,fam');
					Route::group(['middleware' => 'role:fam'], function () {
						Route::post('simpan', [PotonganSppController::class, 'store'])->name('.store');
						Route::post('ubah', [PotonganSppController::class, 'edit'])->name('.edit');
						Route::put('perbarui', [PotonganSppController::class, 'update'])->name('.update');
						Route::delete('{id}/hapus', [PotonganSppController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
					});
				});
				Route::prefix('laporan')->name('.laporan')->group(function (){
					Route::get('/', [LaporanSppController::class, 'index'])->name('.index');
					Route::post('/', [LaporanSppController::class, 'indexGet'])->name('.get');
					Route::post('atur', [LaporanSppController::class, 'set'])->name('.set');
					Route::put('potong', [LaporanSppController::class, 'deduct'])->name('.deduct');
				});
				Route::get('cetak/{id}', [SppController::class, 'cetakTagihan'])->name('.print');
				Route::prefix('pembayaran')->name('.pembayaran')->group(function (){
					Route::get('/', [PembayaranSppController::class, 'index'])->name('.index');
					Route::post('/', [PembayaranSppController::class, 'indexGet'])->name('.get');
					Route::post('ubah-transaksi', [PembayaranSppController::class, 'changeTransaction'])->name('.change');
				});
				Route::get('list-siswa/{unit_id?}', [SppController::class, 'siswaList'])->name('.list-siswa');
				Route::get('list-calon/{unit_id?}', [BmsController::class, 'calonList'])->name('.list-calon');
				
				// Deprecated
				//Route::get('rencana', [SppController::class, 'rencana']);
				//Route::get('bulanan', [SppController::class, 'bulanan']);
				//Route::get('log', [SppController::class, 'log']);
			});
		});
		/** 
		 *  Tutup Sub Modul Pembayaran Uang Sekolah
		 */
	});
	
	Route::prefix('kependidikan/infopsb')->name('kependidikan.infopsb.')->group(function () {
		Route::group(['middleware' => ['auth', 'checkRole:1,2,3,7,8,11,12,13,14,17,18,20,21,25,26']], function () {
			Route::get('all-pegawai', [CalonSiswaController::class,'allPegawai']);

			Route::get('dashboard', [PsbDashboardController::class,'index'])->name('dashboard');
			Route::get('chart', [AdminPsbController::class,'chart'])->name('chart');
		});
	});

	Route::prefix('kependidikan/psb')->name('kependidikan.psb.')->group(function () {
		Route::group(['middleware' => ['auth', 'checkRole:1,2,3,7,8,11,12,13,14,17,18,20,21,25,26']], function () {
			Route::get('all-pegawai', [CalonSiswaController::class,'allPegawai']);

			Route::get('dashboard', [PsbDashboardController::class,'index'])->name('.dashboard');
			Route::get('chart', [AdminPsbController::class,'chart'])->name('.chart');

			Route::put('calon/ubah/{id}', [CalonSiswaController::class,'update'])->name('calonsiswa.update');
			Route::get('calon/ubah/{id}', [CalonSiswaController::class,'edit'])->name('calonsiswa.edit');
			Route::get('calon/lihat/{id}', [CalonSiswaController::class,'show'])->name('calonsiswa.lihat');
			Route::post('calon', [CalonSiswaController::class,'store'])->name('tahun-angkatan');
			Route::post('hapus', [CalonSiswaController::class,'destroy'])->name('hapus');

			Route::get('formulir-terisi', [AdminPsbController::class,'formulirTerisi']);
			// Route::post('formulir-terisi', [AdminPsbController::class,'formulirTerisiFind']);
			Route::post('wawancara-link', [AdminPsbController::class,'wawancaraLink'])->name('wawancaraLink');
			Route::post('wawancara-done', [AdminPsbController::class,'wawancaraDone'])->name('wawancaraDone');

			Route::get('wawancara', [WawancaraPsbController::class,'index']);
			Route::post('wawancara', [WawancaraPsbController::class,'index']);
			Route::get('wawancara/komitmen/{id?}', [KomitmenController::class,'index'])->name('komitmen');
			Route::post('diterima-done', [PenerimaanSiswaController::class,'store'])->name('diterimaDone');
			Route::post('dicadangkan-done', [AdminPsbController::class,'dicadangkan'])->name('dicadangkanDone');
			
			Route::get('diterima', [AdminPsbController::class,'linkDiterima']);
			// Route::post('diterima', [AdminPsbController::class,'linkDiterimaFind']);
			
			Route::get('saving-seat', [SavingSeatController::class,'index'])->name('saving-seat');
			Route::post('saving-seat', [SavingSeatController::class,'savingSeatFind']);
			Route::get('saving-seat/cari', [SavingSeatController::class,'show']);
			Route::post('acc-saving-seat', [SavingSeatController::class,'store'])->name('acc-saving-seat');

			Route::get('belum-lunas', [DaftarUlangPsbController::class,'index'])->name('belum-lunas');
			Route::get('sudah-lunas', [DaftarUlangPsbController::class,'create'])->name('sudah-lunas');
			Route::post('ubah-du', [DaftarUlangPsbController::class,'update'])->name('ubah-du');
			Route::post('konfirmasi', [DaftarUlangPsbController::class,'store'])->name('konfirmasiLunas');
			Route::post('batal', [AdminPsbController::class,'batalDaftarUlang'])->name('batalDaftarUlang');
			
			Route::get('peresmian-siswa', [AdminPsbController::class,'linkPeresmianSiswa']);
			// Route::post('peresmian-siswa', [AdminPsbController::class,'linkPeresmianSiswaFind']);
			Route::post('resmikan', [StatusPsbController::class,'store'])->name('resmikan');
			Route::post('ubah-awal-spp', [StatusPsbController::class,'updateStartOfSpp'])->name('ubah-awal-spp');		
			
			Route::get('batal-daftar-ulang', [AdminPsbController::class,'linkBatalDaftarUlang']);
			Route::post('batal-daftar-ulang', [AdminPsbController::class,'linkBatalDaftarUlangFind']);
			Route::get('dicadangkan', [AdminPsbController::class,'linkDicadangkan']);
			Route::post('dicadangkan', [AdminPsbController::class,'linkDicadangkanFind']);
			
			Route::post('ubah-bms', [BmsPsbController::class,'update']);
			
			// Route::get('{link}', [AdminPsbController::class,'data']);
			// Route::post('{link}', [AdminPsbController::class,'find']);
		});
		Route::prefix('ortu')->name('ortu')->group(function () {
			Route::get('/', [AkunOrtuController::class, 'index'])->name('.index')->middleware('role:sek,pembinayys,ketuayys,direktur,am,aspv');
			Route::group(['middleware' => 'role:sek'], function () {
				Route::post('ubah', [AkunOrtuController::class, 'edit'])->name('.edit');
				Route::put('perbarui', [AkunOrtuController::class, 'update'])->name('.update');
				Route::put('{id}/reset', [AkunOrtuController::class, 'reset'])->where('id', '[0-9]+')->name('.reset');
			});
			Route::group(['middleware' => 'role:am,aspv'], function () {
				Route::delete('{id}/hapus', [AkunOrtuController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
			});
		});
		Route::prefix('kunci')->name('kunci')->middleware('role:ketuayys,pembinayys,direktur,ctl')->group(function () {
			Route::get('/', [KunciPsbController::class, 'index'])->name('.index');
			Route::put('simpan', [KunciPsbController::class, 'update'])->name('.perbarui');
		});
	});

	Route::get('/unit/jabatan/{id}', [UnitController::class, 'getJabatan']);

	Route::get('/wilayah/cari', [WilayahController::class, 'searchDesa']);
	Route::get('/guru/{mapel}', [JadwalPelajaranController::class, 'guruMapel']);
	Route::get('/guru', [JadwalPelajaranController::class, 'guruUnit']);
	Route::get('/siswa/import', [SiswaController::class, 'importView']);
	Route::post('/siswa/import', [SiswaController::class, 'import']);
	
	Route::get('/bms-generator/reset', [BmsGeneratorController::class, 'resetBmsCandidate'])->name('bms-generator.reset');
	Route::get('/bms-generator/generate', [BmsGeneratorController::class, 'generateBmsCandidate'])->name('bms-generator.generate');

	Route::get('/tes/query', [DashboardController::class, 'query']);
});

Route::get('/wilayah/kabupaten/{code}', [WilayahController::class, 'getKabupaten']);
Route::get('/wilayah/kecamatan/{code}', [WilayahController::class, 'getKecamatan']);
Route::get('/wilayah/desa/{code}', [WilayahController::class, 'getDesa']);

Route::prefix('psb')->name('psb')->group(function () {
	Route::get('', [LoginSiswaController::class, 'index'])->name('.index');
	Route::post('', [LoginSiswaController::class, 'login']);
	// Route::get('daftar', [RegisterSiswaController::class, 'index']);
	// Route::post('daftar', [RegisterSiswaController::class, 'store']);
	Route::get('pendaftaran', [RegisterSiswaController::class, 'create'])->name('.pendaftaran');
	Route::post('pendaftaran', [RegisterSiswaController::class, 'storeOrtu'])->name('.register');
	Route::get('pendaftaran-siswa', [RegisterSiswaController::class, 'createSiswa'])->name('.siswa.create');
	Route::post('pendaftaran-siswa', [RegisterSiswaController::class, 'storeSiswa'])->name('.siswa.store');
	Route::group(['middleware' => ['auth', 'checkRole:36']], function () {
		Route::get('index', [OrtuController::class, 'index']);
		Route::get('calon-siswa', [OrtuController::class, 'siswa']);
		Route::get('calon-siswa/{nickname}', [OrtuController::class, 'siswa']);
		Route::get('siswa/{nickname}', [OrtuController::class, 'siswaAktif']);
		Route::get('logout', [LoginSiswaController::class, 'logout']);
	});
	Route::get('password',[OrtuController::class,'password'])->name('.password.get');
	Route::post('password',[OrtuController::class,'changePassword'])->name('.password.post');
	Route::get('profile',[OrtuController::class,'show'])->name('.profil');
	Route::get('profile/edit',[OrtuController::class,'edit'])->name('.profil.edit');
	Route::post('profile/edit',[OrtuController::class,'update'])->name('.profil.update');
});

Route::get('/ortu-enc', [OrtuController::class, 'encrypt']);
Route::get('/siswa/import', [SiswaController::class, 'importView']);
Route::post('/siswa/import', [SiswaController::class, 'import']);
Route::post('/siswa/va',[ImportVaController::class, 'import']);
Route::get('/ortu/{id}',[ParentController::class,'show']);
Route::post('/ortu',[ParentController::class,'store'])->name('ortu-ubah');
// Route::get('/siswacek', [SiswaController::class, 'index']);
Route::get('generate-deduction',function (){
	SppGenerator::generateDeduction();	
});
Route::get('reset-spp-deduction',function (){
	SppGenerator::resetSppDeduction();	
});
Route::get('generate-trx',function (){
	SppGenerator::generateFromTransaction();	
});
Route::get('check-spp-paid/{student_id}',function ($student_id){
	SppGenerator::checkTotalPaidStudent($student_id);
});
Route::get('bmsplan', function(){
    BmsPlanFixing::generating();
});
Route::get('pass/{pass}', function($pass){
	// dd(bcrypt($pass));
	$haveMulti = CheckRedudantBms::checkHaveMultiTermin();
	$doesntHave = CheckRedudantBms::checkDoesntHaveTermin();

	// $generate
	dd($doesntHave, $haveMulti);

	return response()->json(['doesntHave' => $doesntHave, 'redundant' => $haveMulti]);
	return [$doesntHave, $haveMulti];
});