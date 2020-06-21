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

Route::get('/', 'HomeController@index')->name('home');

Route::get('login','AuthController@login')->middleware('guest')->name('login');
Route::post('postlogin','AuthController@postlogin')->middleware('guest');

Route::get('register','AuthController@register')->middleware('guest')->name('register');
Route::post('postregister','AuthController@postregister')->middleware('guest');

Route::get('daftardaerah','AuthController@daftardaerah')->name('daftardaerah');
Route::post('postdaftardaerah','AuthController@postdaftardaerah');

Route::get('ecobrick', 'EcobrickController@ecobrick');
Route::post('kirimsaranecobrick', 'EcobrickController@TambahSaran');

Route::post('kirimfeedback', 'HomeController@feedback');

Route::group(['middleware' => ['auth','pimpinanecoranger']],function(){
    
    Route::resource('pimpinan', 'PimpinanController');
    Route::resource('indikasi', 'MonitoringsampahController');
        Route::post('ubahstatussampah/{id}', 'MonitoringsampahController@ubahstatus');
        Route::get('lokasisampah', 'MonitoringsampahController@lokasi')->name('lokasisampah');
    Route::resource('kelolaagenda', 'AgendaController');
    Route::resource('daftarkomunitas', 'MonitoringkomunitasController');
    Route::resource('validasi', 'ValidasiController');
    Route::resource('datapimpinankomunitas', 'DatapimpinankomunitasController');
    Route::resource('datapetugaslapangan', 'DatapetugaslapanganController');
    Route::resource('dataanggotakomunitas', 'DatakomunitasController');
    Route::resource('reviewsaranecobrick', 'EcobrickController');
    Route::resource('riwayatpembuangsampah', 'SampahController');
    Route::get('feedbacks', 'HomeController@feedbacks');
    Route::get('logout-pimpinan','AuthController@logout')->name('logout-pimpinan'); 
});

Route::group(['middleware' => ['auth','petugaslapangan']],function(){
    
    Route::resource('petugaslapangan', 'PetugaslapanganController');
    Route::resource('indikasi-petugaslap', 'MonitoringsampahController');
        Route::post('ubahstatussampah-petugaslap/{id}', 'MonitoringsampahController@ubahstatus');
        Route::get('lokasisampah-petugaslap', 'MonitoringsampahController@lokasi')->name('lokasisampah-petugaslapangan');
    Route::resource('kelolaagenda-petugaslap', 'AgendaController');
    Route::resource('daftarkomunitas-petugaslap', 'MonitoringkomunitasController');
    Route::resource('validasi-petugaslap', 'ValidasiController');
    Route::resource('datapetugaslapangan-petugaslap', 'DatapetugaslapanganController');
    Route::resource('dataanggotakomunitas-petugaslap', 'DatakomunitasController');
    Route::resource('reviewsaranecobrick-petugaslap', 'EcobrickController');
    Route::resource('daftarsampah-petugaslap', 'SampahController');
    Route::get('logout-petugaslap','AuthController@logout')->name('logout-petugaslapangan'); 
});

Route::group(['middleware' => ['auth','komunitas']],function(){
    
    Route::resource('komunitas', 'KomunitasController');
    Route::resource('indikasi-komunitas', 'MonitoringsampahController');
        Route::post('ubahstatussampah-komunitas/{id}', 'MonitoringsampahController@ubahstatus');
        Route::get('lokasisampah-komunitas', 'MonitoringsampahController@lokasi')->name('lokasisampah-komunitas');
    Route::resource('kelolaagenda-komunitas', 'AgendaController');
    Route::resource('daftarkomunitas-komunitas', 'MonitoringkomunitasController');
    Route::resource('validasi-komunitas', 'ValidasiController');
    Route::resource('datapetugaslapangan-komunitas', 'DatapetugaslapanganController');
    Route::resource('dataanggotakomunitas-komunitas', 'DatakomunitasController');
    Route::resource('reviewsaranecobrick-komunitas', 'EcobrickController');
    Route::resource('daftarsampah-komunitas', 'SampahController');
    Route::get('logout-komunitas','AuthController@logout')->name('logout-komunitas'); 
});

Route::group(['middleware' => ['auth','pimpinankomunitas']],function(){
    
    Route::resource('pimpinan-komunitas', 'PimpinanKomunitasController');
    Route::resource('indikasi-pimpinankom', 'MonitoringsampahController');
        Route::post('ubahstatussampah-pimpinankom/{id}', 'MonitoringsampahController@ubahstatus');
        Route::get('lokasisampah-pimpinankom', 'MonitoringsampahController@lokasi')->name('lokasisampah');
    Route::resource('kelolaagenda-pimpinankom', 'AgendaController');
    Route::resource('daftarkomunitas-pimpinankom', 'MonitoringkomunitasController');
    Route::resource('validasi-pimpinankom', 'ValidasiController');
    Route::resource('datapetugaslapangan-pimpinankom', 'DatapetugaslapanganController');
    Route::resource('dataanggotakomunitas-pimpinankom', 'DatakomunitasController');
    Route::resource('reviewsaranecobrick-pimpinankom', 'EcobrickController');
    Route::resource('daftarsampah-pimpinankom', 'SampahController');
    Route::get('feedbacks-pimpinankom', 'HomeController@feedbacks');
    Route::get('logout-pimpinankom','AuthController@logout')->name('logout-pimpinankom'); 
});

Route::get('tukarcode','SampahController@tukarcode');
Route::post('pushtukarcode/{id}','SampahController@pushtukarcode');
Route::get('/api','MonitoringsampahController@PushNotifSampah');


// Auth::routes();
