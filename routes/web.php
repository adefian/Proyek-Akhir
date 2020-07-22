<?php

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

Route::get('/', 'WebHomeController@index')->name('home');

Route::get('login','WebAuthController@login')->middleware('guest')->name('login');
Route::post('postlogin','WebAuthController@postlogin')->middleware('guest')->name('postlogin');

Route::get('register','WebAuthController@register')->middleware('guest')->name('register');
Route::post('postregister','WebAuthController@postregister')->middleware('guest')->name('postregister');

Route::get('daftardaerah','WebAuthController@daftardaerah')->name('daftardaerah');
Route::post('postdaftardaerah','WebAuthController@postdaftardaerah')->name('postdaftardaerah');

Route::get('ecobrick', 'WebEcobrickController@ecobrick')->name('ecobrick');
Route::post('kirimsaranecobrick', 'WebEcobrickController@TambahSaran')->name('kirimsaranecobrick');

Route::post('kirimfeedback', 'WebHomeController@feedback')->name('kirimfeedback');

Route::group(['middleware' => ['auth','pimpinanecoranger']],function(){
    
    Route::resource('pimpinan', 'WebPimpinanController');
    Route::resource('indikasi', 'WebMonitoringsampahController');
        Route::post('ubahstatussampah/{id}', 'WebMonitoringsampahController@ubahstatus')->name('ubahstatussampah');
        Route::get('lokasisampah', 'WebMonitoringsampahController@lokasi')->name('lokasisampah');
    Route::resource('kelolaagenda', 'WebAgendaController');
    Route::resource('daftarkomunitas', 'WebMonitoringkomunitasController');
    Route::resource('validasi', 'WebValidasiController');
    Route::resource('datapimpinan', 'WebDatapimpinanController');
    Route::resource('datapimpinankomunitas', 'WebDatapimpinankomunitasController');
    Route::resource('datapetugaslapangan', 'WebDatapetugaslapanganController');
    Route::resource('dataanggotakomunitas', 'WebDatakomunitasController');
    Route::resource('datapetugaskontenreward', 'WebDatapetugaskontenController');
    Route::resource('reviewsaranecobrick', 'WebEcobrickController');
    Route::resource('riwayatpembuangan', 'WebSampahController');
    Route::resource('laporan', 'WebLaporanController');
    Route::get('poin', 'WebSampahController@poin')->name('poin');
    Route::get('feedbacks', 'WebHomeController@feedbacks')->name('feedbacks');
    Route::post('hapusfeedback/{id}', 'WebHomeController@hapusfeedback')->name('hapusfeedback');
    Route::get('logout-pimpinan','WebAuthController@logout')->name('logout-pimpinan'); 
});

Route::group(['middleware' => ['auth','petugaslapangan']],function(){
    
    Route::resource('petugaslapangan', 'WebPetugaslapanganController');
    Route::resource('indikasi-petugaslap', 'WebMonitoringsampahController');
    Route::post('ubahstatussampah-petugaslap/{id}', 'WebMonitoringsampahController@ubahstatus')->name('ubahstatussampah-petugaslap');
    Route::get('lokasisampah-petugaslap', 'WebMonitoringsampahController@lokasi')->name('lokasisampah-petugaslap');
    Route::resource('kelolaagenda-petugaslap', 'WebAgendaController');
    Route::resource('daftarkomunitas-petugaslap', 'WebMonitoringkomunitasController');
    Route::resource('validasi-petugaslap', 'WebValidasiController');
    Route::resource('datapetugaslapangan-petugaslap', 'WebDatapetugaslapanganController');
    Route::resource('dataanggotakomunitas-petugaslap', 'WebDatakomunitasController');
    Route::resource('reviewsaranecobrick-petugaslap', 'WebEcobrickController');
    Route::resource('riwayatpembuangan-petugaslap', 'WebSampahController');
    Route::get('poin-petugaslap', 'WebSampahController@poin')->name('poin-petugaslap');
    Route::get('feedbacks-petugaslap', 'WebHomeController@feedbacks')->name('feedbacks-petugaslap');
    Route::post('hapusfeedback-petugaslap/{id}', 'WebHomeController@hapusfeedback')->name('hapusfeedback-petugaslap');
    Route::get('logout-petugaslap','WebAuthController@logout')->name('logout-petugaslap'); 
});

Route::group(['middleware' => ['auth','komunitas']],function(){
    
    Route::resource('komunitas', 'WebKomunitasController');
    Route::resource('indikasi-komunitas', 'WebMonitoringsampahController');
        Route::post('ubahstatussampah-komunitas/{id}', 'WebMonitoringsampahController@ubahstatus')->name('ubahstatussampah-komunitas');
        Route::get('lokasisampah-komunitas', 'WebMonitoringsampahController@lokasi')->name('lokasisampah-komunitas');
    Route::resource('kelolaagenda-komunitas', 'WebAgendaController');
    Route::resource('daftarkomunitas-komunitas', 'WebMonitoringkomunitasController');
    Route::resource('validasi-komunitas', 'WebValidasiController');
    Route::resource('datapetugaslapangan-komunitas', 'WebDatapetugaslapanganController');
    Route::resource('dataanggotakomunitas-komunitas', 'WebDatakomunitasController');
    Route::resource('reviewsaranecobrick-komunitas', 'WebEcobrickController');
    Route::resource('riwayatpembuangan-komunitas', 'WebSampahController');
    Route::get('feedbacks-komunitas', 'WebHomeController@feedbacks')->name('feedbacks-komunitas');
    Route::post('hapusfeedback-komunitas/{id}', 'WebHomeController@hapusfeedback')->name('hapusfeedback-komunitas');
    Route::get('logout-komunitas','WebAuthController@logout')->name('logout-komunitas'); 
});

Route::group(['middleware' => ['auth','pimpinankomunitas']],function(){
    
    Route::resource('pimpinan-komunitas', 'WebPimpinanKomunitasController');
    Route::resource('indikasi-pimpinankom', 'WebMonitoringsampahController');
        Route::post('ubahstatussampah-pimpinankom/{id}', 'WebMonitoringsampahController@ubahstatus')->name('ubahstatussampah-pimpinankom');
        Route::get('lokasisampah-pimpinankom', 'WebMonitoringsampahController@lokasi')->name('lokasisampah-pimpinankom');
    Route::resource('kelolaagenda-pimpinankom', 'WebAgendaController');
    Route::resource('daftarkomunitas-pimpinankom', 'WebMonitoringkomunitasController');
    Route::resource('validasi-pimpinankom', 'WebValidasiController');
    Route::resource('datapetugaslapangan-pimpinankom', 'WebDatapetugaslapanganController');
    Route::resource('dataanggotakomunitas-pimpinankom', 'WebDatakomunitasController');
    Route::resource('reviewsaranecobrick-pimpinankom', 'WebEcobrickController');
    Route::resource('laporan-pimpinankom', 'WebLaporanController');
    Route::get('feedbacks-pimpinankom', 'WebHomeController@feedbacks')->name('feedbacks-pimpinankom');
    Route::post('hapusfeedback-pimpinankom/{id}', 'WebHomeController@hapusfeedback')->name('hapusfeedback-pimpinankom');
    Route::get('logout-pimpinankom','WebAuthController@logout')->name('logout-pimpinankom'); 
});

Route::get('code_reward', 'WebSampahController@data')->name('code_reward'); 

Route::get('datasensor', 'WebSampahController@datasensor')->name('datasensor');

// Route::get('tukarcode','WebSampahController@tukarcode');
// Route::post('pushtukarcode/{id}','WebSampahController@pushtukarcode');
// Route::get('/api','WebMonitoringsampahController@PushNotifSampah');
// Route::get('/webview','WebHomeController@webview');

// Route::get('crop-image', 'WebHomeController@crop');

// Route::post('crop-image', ['as'=>'upload.image','uses'=>'WebHomeController@uploadImage']);



// Auth::routes();
