<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Agenda
Route::post('tambahagenda','AgendaController@tambahagenda');
Route::get('lihatagenda','AgendaController@lihatagenda');
Route::post('updateagenda/{id}','AgendaController@UpdateAgenda');
Route::post('hapusagenda/{id}','AgendaController@HapusAgenda');

// Konten
Route::post('tambahkonten','KontenEdukasiController@tambahkonten');
Route::get('lihatkonten','KontenEdukasiController@lihatkonten');
Route::post('updatekonten/{id}','KontenEdukasiController@UpdateKonten');
Route::post('hapuskonten/{id}','KontenEdukasiController@HapusKonten');

// Poin 

Route::get('lihatpoin','PoinController@LihatPoin');
Route::post('updatepoin/{id}','PoinController@UpdatePoin');
Route::post('kode/{id}','PoinController@pushtukarcode');

// Feedback 
Route::post('tambahfeedback','FeedbackController@tambahfeedback');
Route::get('lihatfeedback','FeedbackController@lihatfeedback');
Route::post('hapusfeedback/{id}','FeedbackController@HapusFeedback');

// Login Register
Route::post('Daftar','UserController@DaftarPengguna');
Route::post('Masuk','UserController@MasukPengguna');

// Hadiah 
Route::post('tambahhadiah','HadiahController@TambahHadiah');
Route::get('lihathadiah','HadiahController@LihatHadiah');
Route::post('updatehadiah/{id}','HadiahController@UpdateHadiah');
Route::post('upjumlah/{id}','HadiahController@UpdateJumlahHadiah');
Route::post('hapushadiah/{id}','HadiahController@HapusHadiah');

// Monitoring Sampah 
Route::get('monitoring', 'TempatSampahController@MonitoringSampah');
Route::get('notifsampah', 'MonitoringSampahController@NotifikasiSampah');
Route::post('notif', 'MonitoringSampahController@PushNotifSampah');

// Masyarakat 
Route::get('masyarakat', 'MasyarakatController@Masyarakat');
Route::post('tambahmasyarakat', 'MasyarakatController@TambahMasyarakat');
Route::post('up/{id}', 'MasyarakatController@up');
Route::post('edit/{id}', 'MasyarakatController@edit');
Route::get('show/{id}', 'MasyarakatController@show');

// Pimpinan Ecoranger
Route::get('pimpinan', 'PimpinanController@Pimpinan');
Route::post('tpimpinan', 'PimpinanController@TambahPimpinan');
Route::get('showpimpinan/{id}', 'PimpinanController@showpimpinan');
Route::post('editdatapimpinan/{id}', 'PimpinanController@edit');

// Petugas Lapangan 
Route::get('petugaslapangan', 'PetugasLapanganController@PetugasLapangan');
Route::get('showlapangan/{id}', 'PetugasLapanganController@DataPetugasLapangan');
Route::post('tpetugaslapangan', 'PetugasLapanganController@TambahPetugasLapangan');
Route::post('editdatapl/{id}', 'PetugasLapanganController@edit');

// Petugas Konten Reward 
Route::get('petugaskontenreward', 'PetugasKontenRewardController@PetugasKontenReward');
Route::post('tpetugaskontenreward', 'PetugasKontenRewardController@TambahPetugasKontenReward');
Route::get('showkonten/{id}','PetugasKontenRewardController@datapetugaskonten');
Route::post('editdatapkw/{id}', 'PetugasKontenRewardController@edit');

// Transaksi 
// Route::get('showt/{id}','TransaksiController@show');
Route::post('transaksi/{id}','TransaksiController@transaksi');
Route::get('lihattransaksi/{id}','TransaksiController@LihatTransaksi');
// Route::post('t','TransaksiController@tambah');

Route::post('datasensor', 'WebSampahController@datasensor');