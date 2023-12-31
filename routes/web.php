<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\PulangController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\RekapMasukController;
use App\Http\Controllers\RekapPulangController;
use App\Http\Controllers\RekapUnitController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengecualianPegawaiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\LiburController;
use App\Http\Controllers\KodeAsetController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MappingDashboardController;
use App\Http\Controllers\KategoriPendidikanController;
use App\Http\Controllers\KategoriUsiaController;
use App\Http\Controllers\KearsipanController;

/*booking
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
    return view('register.login');
})->name('login');

Route::get('/login',[UserController::class, 'login']);
Route::post('/login',[UserController::class, 'authenticate']);

Route::group(['middleware' => ['auth','hakAkses:Admin']], function(){
    Route::get('/index',[UserController::class, 'index']);
    Route::get('/register',[UserController::class, 'register']);
    Route::post('/register',[UserController::class, 'store_register']);
    Route::get('/register/{id}', [UserController::class, 'show']);
    Route::get('/register/edit/{id}', [UserController::class,'edit']);
    Route::get('/register/delete/{id}',[UserController::class, 'delete']);
}); 

Route::group(['middleware' =>['auth']], function(){
    Route::post('/register/update/{id}', [UserController::class,'updateByUser']);
    Route::get('/account/{id}', [UserController::class, 'editByUser']);
    Route::post('/account/{id}', [UserController::class, 'updateByUser']);
    Route::post('/change-password', [UserController::class, 'changePassword']);
    
});

Route::post('/update-status', [UserController::class, 'updateStatus'])->name('update-status');

Route::group(['middleware' =>['auth']], function(){
    Route::get('/dashboard',[DashboardController::class, 'index']);
});

// Route::get('/dashboard', function () {
//     return view('home.dashboard', [
//         "title" => "Dashboard"
//     ]);
// })->middleware('auth');

Route::get('/logout', [UserController::class, 'logout']);

//laporan
Route::group(['middleware' =>['auth','hakAkses:Admin,IT']], function(){
    Route::get('/laporan', [LaporanController::class,'index']);
    Route::get('/laporan/create',[LaporanController::class, 'create']);
    Route::post('/laporan/create',[LaporanController::class, 'store']);
    Route::get('/laporan-edit/{id}', [LaporanController::class,'edit']);
    Route::put('/laporan-edit/{id}', [LaporanController::class,'update']);
    Route::get('/laporan-execute/{id}', [LaporanController::class,'execute']);
    Route::put('/laporan-execute/{id}', [LaporanController::class,'executed']);
    Route::get('/laporan/{id}', [LaporanController::class,'show']);
    Route::get('/laporan-delete/{id}', [LaporanController::class,'delete']);
});


//inventaris
Route::group(['middleware' =>['auth','hakAkses:Admin,Aset']], function(){
    Route::get('/inventaris',[InventarisController::class, 'index']);
    Route::get('/inventaris/create',[InventarisController::class, 'create']);
    Route::post('/inventaris/store',[InventarisController::class, 'store']);
    Route::get('/inventaris/{id}', [InventarisController::class,'show']);
    Route::get('/inventaris-update/{id}', [InventarisController::class,'edit']);
    Route::post('/inventaris-update/{id}', [InventarisController::class,'update']);
    Route::get('/inventaris/delete/{id}',[InventarisController::class, 'delete']);
    Route::get('/export-excel', [InventarisController::class, 'exportExcel']);

// kodeAset
    Route::get('/kodeAset',[KodeAsetController::class, 'index']);
    Route::post('/kodeAset/create',[KodeAsetController::class, 'store']);
    Route::get('/kodeAset/{id}', [KodeAsetController::class,'edit']);
    Route::post('/kodeAset/{id}', [KodeAsetController::class,'update']);
    Route::get('/kodeAset/delete/{id}',[KodeAsetController::class, 'delete']);

// booking
    Route::get('/booking',[BookingController::class, 'index']);
    Route::get('/booking/create',[BookingController::class, 'create']);
    Route::post('/booking-check',[BookingController::class, 'bookingCheck']); // baru sampe sini
    Route::post('/booking-store',[BookingController::class, 'buat']);
    Route::get('/booking/{id}',[BookingController::class, 'show']);
    Route::get('/booking-edit/{id}',[BookingController::class, 'edit']);
    Route::get('/bookingEdit/{id}',[BookingController::class, 'edtasst']);
    Route::post('/booking-update/{id}',[BookingController::class, 'update']);
    Route::get('/booking/delete/{id}',[BookingController::class, 'delete']);
    Route::get('/booking-reject',[BookingController::class, 'reject']);
    Route::get('/booking-acc',[BookingController::class, 'acc']);
    Route::get('/booking-selesai',[BookingController::class, 'selesai']);
    Route::post('/booking-prsbarang/{id}',[BookingController::class, 'updbarang']);
   //Route::post('/booking-updasst/{id}',[BookingController::class, 'updasst']);
    //Route::get('/keamanan/{id}',[BookingController::class, 'detailasst']);
    
    // aset
    Route::get('/aset',[AsetController::class, 'index']);
    Route::post('/aset/create',[AsetController::class, 'store']);
    Route::get('/aset/{id}', [AsetController::class,'edit']);
    Route::post('/aset/{id}', [AsetController::class,'update']);
    Route::get('/aset/delete/{id}',[AsetController::class, 'delete']);

});

//bidang
Route::group(['middleware' =>['auth','hakAkses:Admin']], function(){
    // Route::resource('/unitkerja', UnitKerjaController::class);
    Route::get('/unitkerja',[UnitKerjaController::class, 'index']);
    Route::post('/unitkerja/create',[UnitKerjaController::class, 'store']);
    Route::get('/unitkerja/{id}', [UnitKerjaController::class,'edit']);
    Route::post('/unitkerja/{id}', [UnitKerjaController::class,'update']);
    Route::get('/unitkerja/delete/{id}',[UnitKerjaController::class, 'delete']);
});


//kategori
Route::group(['middleware' =>['auth','hakAkses:Admin,IT']], function(){
    Route::resource('/kategori', KategoriController::class);
    Route::post('/kategori/create',[KategoriController::class, 'store']);
    Route::get('/kategori/{id}', [KategoriController::class,'edit']);
    Route::post('/kategori/{id}', [KategoriController::class,'update']);
    Route::get('/kategori/delete/{id}',[KategoriController::class, 'delete']);
});


//role
Route::group(['middleware' =>['auth','hakAkses:Admin']], function(){
    Route::resource('/role', RoleController::class);
    Route::post('/role/create',[RoleController::class, 'store']);
    Route::get('/role/{id}',[RoleController::class, 'edit']);
    Route::post('/role/{id}',[RoleController::class, 'update']);
    Route::get('/role/delete/{id}', [RoleController::class, 'delete']);
});


//merk
Route::group(['middleware' =>['auth','hakAkses:Admin,Aset']], function(){
    Route::resource('/merk', MerkController::class);
    Route::post('/merk/create',[MerkController::class, 'store']);
    Route::get('/merk/{id}', [MerkController::class, "edit"]);
    Route::post('/merk/{id}', [MerkController::class,'update']);
    Route::get('/merk/delete/{id}',[MerkController::class, 'delete']);
});


//satuan
Route::group(['middleware' =>['auth','hakAkses:Admin,Aset']], function(){
    Route::get('/satuan', [SatuanController::class, 'index']);
    Route::post('/satuan/create',[SatuanController::class, 'store']);
    Route::get('/satuan/{id}', [SatuanController::class,'edit']);
    Route::post('/satuan/{id}', [SatuanController::class,'update']);
    Route::get('/satuan/delete/{id}',[SatuanController::class, 'delete']);
});

//keamanan
Route::group(['middleware' =>['auth','hakAkses:Admin,Keamanan']], function(){
    Route::get('/keamanan', [BookingController::class, 'beranda']);
    Route::get('/keamanan-riwayat', [BookingController::class, 'riwayat']);
    Route::get('/keamanan-riwayatdetail/{id}',[BookingController::class, 'riwayatdetail']);
    Route::get('/keamanan/{id}',[BookingController::class, 'detail']);
    Route::get('/keamanan-edit/{id}',[BookingController::class, 'edt']);
    Route::get('/keamanan-dipinjam/{id}',[BookingController::class, 'dipinjam']);
    Route::get('/keamanan-proses/{id}',[BookingController::class, 'proses']);
    Route::post('/keamanan-upd/{id}',[BookingController::class, 'upd']);
    Route::post('/keamanan-prs/{id}',[BookingController::class, 'updproses']);
    Route::post('/keamanan-dipinjam/{id}',[BookingController::class, 'updpinjam']);
   
    
});

//mappingdashbord
Route::group(['middleware' =>['auth','hakAkses:Admin']], function(){
    Route::get('/mapDashboard', [MappingDashboardController::class, 'index']);
    Route::get('/mappingDashboard-edit/{id}',[MappingDashboardController::class, 'edit']);
    Route::post('/map/create',[MappingDashboardController::class, 'store']);
    Route::post('/mappingDashboard-upd/{id}',[MappingDashboardController::class, 'upd']);
    Route::get('/mappingDashboard-dlt/{id}',[MappingDashboardController::class, 'delete']);
});


// KEARSIPAN
Route::group(['middleware' =>['auth','hakAkses:Admin,IT']], function(){
    Route::get('/kearsipan', [KearsipanController::class, 'index']);
    Route::get('/kearsipan/create', [KearsipanController::class, 'create']);
    Route::get('/kearsipan/edit/{id}', [KearsipanController::class, 'edit']);
    Route::get('/kearsipan/master/media', [KearsipanController::class, 'media']);
    Route::get('/kearsipan/master/editmedia', [KearsipanController::class, 'editmedia']);
});


//--KEPEGAWAIAN--
Route::group(['middleware' =>['auth','hakAkses:Admin,Kepegawaian']], function(){
    //kehadiran
    Route::get('/kepegawaian/kehadiran', [KehadiranController::class, 'index']); 
    Route::get('/kepegawaian/kehadiran', [KehadiranController::class, 'show']);
    Route::get('/store/kehadiran', [KehadiranController::class, 'store']);
    Route::get('/terlambat-harian',[KehadiranController::class, 'belum_absendet']);

    // Cuti
    Route::get('/store-cuti',[CutiController::class,'store']);
    Route::get('/cuti',[CutiController::class,'show']);
    Route::get('/sedang-cuti',[CutiController::class,'this_month']);
    Route::get('/jumlah-cuti',[CutiController::class,'jumlah']);

    // Masuk
    Route::get('/absen-masuk', [MasukController::class, 'index']);
    Route::get('/store-masuk', [MasukController::class, 'store']);
    Route::get('/masuk-export', [MasukController::class, 'export']);

    // Pulang
    Route::get('/absen-pulang', [PulangController::class, 'index']);
    Route::get('/store-pulang', [PulangController::class, 'store']);
    Route::get('/pulang-export', [PulangController::class, 'export']);

    // Rekapitulasi
    Route::get('/rekap/terlambat-masuk', [RekapMasukController::class,'index']);
    Route::get('/store/terlambat-masuk', [RekapMasukController::class,'store']);

    Route::get('/rekap/tidak-absen-pulang', [RekapPulangController::class,'index']);
    Route::get('/store/tidak-absen-pulang', [RekapPulangController::class,'store']);

    Route::get('/rekap/terlambat-masuk-unit', [RekapUnitController::class,'index']);
    Route::get('/store/terlambat-masuk-unit', [RekapUnitController::class,'store']);
    
    Route::get('/rekap/cuti', [CutiController::class,'rekap']);
    Route::get('/store/cuti', [CutiController::class,'srekap']);

    //PEGAWAI
    Route::get('/master-pegawai', [PegawaiController::class, 'index']);
    Route::get('/tambah-data-pegawai', [PegawaiController::class, 'create']);
    Route::post('/store-data-pegawai', [PegawaiController::class, 'store']);
    Route::get('/update-data-pegawai', [PegawaiController::class, 'update']);
    Route::get('/delete{id}', [PegawaiController::class, 'delete']);
    Route::get('/pegawai-sync', [PegawaiController::class, 'sync']);
    Route::get('/pns-sync', [PegawaiController::class, 'pnsSync']);
    Route::get('/nonpns-sync', [PegawaiController::class, 'nonPnsSync']);
    Route::get('/pegawai-conflict', [PegawaiController::class, 'conflict']);
    Route::get('/pegawai-resolve/{id}', [PegawaiController::class, 'resolving']);
    Route::post('/pegawai-resolve/{id}', [PegawaiController::class, 'resolved']);

    // PNS
    Route::get('/detail-pegawai/{id}', [PegawaiController::class, 'show']);
    Route::get('/pns', [PegawaiController::class, 'pnsindex']);
    Route::get('/pegawai/{id}',[PegawaiController::class, 'edit']);
    Route::post('/update-pns/{id}', [PegawaiController::class, 'upd']);
    
    // NON-PNS
    Route::get('/nonpns', [PegawaiController::class, 'nonpns']);
    Route::get('/detail-nonpns/{id}', [PegawaiController::class, 'detail']);
    Route::get('/nonpns/{id}',[PegawaiController::class, 'editnon']);
    Route::post('/update-nonpns/{id}', [PegawaiController::class, 'updnon']);

    // NON-AKTIF
    Route::get('/nonaktif', [PegawaiController::class, 'nonaktifindex']);

    
    // exception pegawai
    Route::get('/pengecualian', [PengecualianPegawaiController::class, 'index']);
    Route::post('/insert-pengecualian', [PengecualianPegawaiController::class, 'insert']);
    Route::get('/update-pengecualian/{id}', [PengecualianPegawaiController::class, 'edit']);
    Route::post('/update-pengecualian/{id}', [PengecualianPegawaiController::class, 'update']);
    Route::get('/delete-pengecualian/{id}', [PengecualianPegawaiController::class, 'delete']);


    // libur
    Route::get('/libur', [LiburController::class, 'index']);
    Route::post('/libur/create',[LiburController::class, 'store']);
    Route::get('/libur/{id}', [LiburController::class,'edit']);
    Route::post('/libur/{id}', [LiburController::class, 'update']);
    Route::get('/libur/delete/{id}',[LiburController::class, 'delete']);

    // kategori pendidikan
    Route::get('/kategori-pendidikan', [KategoriPendidikanController::class, 'index']);
    Route::post('/katpen/create',[KategoriPendidikanController::class, 'store']);
    Route::get('/katpen/edit/{id}', [KategoriPendidikanController::class,'edit']);
    Route::post('/katpen/update/{id}', [KategoriPendidikanController::class, 'update']);
    Route::get('/katpen/delete/{id}',[KategoriPendidikanController::class, 'delete']);

    // kategori usia
    Route::get('/usia', [KategoriUsiaController::class, 'index']);
    Route::post('/usia/create',[KategoriUsiaController::class, 'store']);
    Route::get('/usia/{id}', [KategoriUsiaController::class,'edit']);
    Route::post('/usia/{id}', [KategoriUsiaController::class, 'update']);
    Route::get('/usia/delete/{id}',[KategoriUsiaController::class, 'delete']);

});


// Settings
Route::get('/change', function () {
    return view('home/settings/change');
})->middleware('auth');

Route::get('/settings', function () {
    return view('home/settings/settings');
})->middleware('auth');

Route::get('/light', function () {
    return view('home/settings/light');
})->middleware('auth');

// Account Setting 
Route::get('/maintenance', [UserController::class, 'maintenance']);
Route::get('/fiturmaintenance', [UserController::class, 'fiturmaintenance']);


// ROUTE UNTUK PUBLIC

// tracking
Route::get('/public',[TrackingController::class, 'index']);
Route::get('/tracking',[TrackingController::class, 'track']);
Route::post('/tracking',[TrackingController::class, 'find']);
Route::get('/tracking/{ticket}',[TrackingController::class, 'found']);
Route::get('/laporPermasalahan',[TrackingController::class, 'laporPermasalahan']);
Route::get('/pinjam',[TrackingController::class, 'pinjam']);
Route::post('/upload-surat/{id}',[TrackingController::class, 'unggah']);

Route::get('/block',[BlockController::class, 'block']);
Route::get('/booking-export/{id}', [BookingController::class, 'export']);


Route::get('/tes',[TrackingController::class, 'tes']);

//permohonan publik
Route::get('/peminjaman',[BookingController::class, 'permohonan']);
Route::get('/permohonan-result/{id}',[BookingController::class, 'result']);
Route::post('/permohonan-check',[BookingController::class, 'permohonanCheck']);
Route::post('/permohonan-store',[BookingController::class, 'store']);
Route::get('/permohonan-store',[BookingController::class, 'permohonanCheck']);
Route::get('/booked/{id}',[BookingController::class, 'booked']);

// Route upload image

// Route Google Calendar
Route::get('/google-calendar/connect', [GoogleCalendarController::class, 'connect']);
Route::post('/google-calendar/connect', [GoogleCalendarController::class, 'store']);
Route::get('get-resource', [GoogleCalendarController::class, 'getResources']);
