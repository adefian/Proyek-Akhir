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
Route::get('daftarwilayah','AuthController@daftarwilayah')->middleware('guest')->name('daftarwilayah');

Route::group(['middleware' => ['auth','pimpinanecoranger']],function(){
    
    Route::resource('pimpinan', 'PimpinanController');
    Route::resource('/indikasi', 'MonitoringsampahController');
    Route::get('/lokasisampah', 'MonitoringsampahController@lokasi')->name('lokasisampah');
    Route::resource('/kelolaagenda', 'AgendaController');
    Route::get('/lokasiagenda', 'MonitoringkomunitasController@lokasi')->name('lokasikomunitas');
    Route::resource('/daftarkomunitas', 'MonitoringkomunitasController');
    Route::get('/validasi', 'MonitoringkomunitasController@lokasi')->name('validasi');
    Route::resource('/datapetugaslapangan', 'DatapetugaslapanganController');
    Route::resource('/reviewsaranecobrick', 'EcobrickController');
    Route::get('logout-pimpinan','AuthController@logout')->name('logout-pimpinan'); 
});

Route::group(['middleware' => ['auth','petugaslapangan']],function(){
    
    Route::resource('petugaslapangan', 'PetugaslapanganController');
    Route::get('logout-petugaslapangan','AuthController@logout')->name('logout-petugaslapangan'); 
});

Route::group(['middleware' => ['auth','komunitas']],function(){
    
    Route::resource('komunitas', 'KomunitasController');
    Route::get('logout-komunitas','AuthController@logout')->name('logout-komunitas'); 
});



// Auth::routes();
