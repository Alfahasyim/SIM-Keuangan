<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'guest'], function(){
  Route::get('/', function () { return view('login');})->name('login');
  Route::post('/loginProses','LoginController@loginProses')->name('prosesLogin');
  Route::get('/gagal', function() {
    return view('empty_page');
  })->name('gagal');
});

Route::group(['middleware' => 'auth'], function(){
  Route::get('/logout','LoginController@logoutProses')->name('logout');
  //Route untuk views
  Route::group(['middleware' => 'admin'], function(){
    Route::get('admin/dashboard','AdminController@Dashboard')->name('admin.dashboard');
    Route::get('admin/Barang','AdminController@MbarangView')->name('admin.Mbarang');
    Route::get('admin/Pelanggan','AdminController@MpelangganView')->name('admin.Mpelanggan');
    Route::get('admin/Akun','AdminController@SakunView')->name('admin.Sakun');
    
    Route::get('admin/OrderMasuk','AdminController@OrderMasuk')->name('admin.OrderMasuk');
    Route::get('admin/ListOrderMasuk','AdminController@ListOrderMasuk')->name('admin.ListOrderMasuk');
    Route::get('admin/ListOrderMasuk/{id}/LM','AdminController@LaporanMasuk')->name('admin.LaporanMasuk');
    Route::get('admin/ListOrderMasuk/{id}/LM/Print','AdminController@LaporanMasukPrint')->name('admin.LaporanMasukPrint');
    Route::get('admin/ListOrderMasuk/{id}/LK','AdminController@LaporanKeluar')->name('admin.LaporanKeluar');
    Route::get('admin/ListOrderMasuk/{id}/LK/Print','AdminController@LaporanKeluarPrint')->name('admin.LaporanKeluarPrint');

    //Pelanggan
    Route::get('admin/editPelanggan/{id}','MpelangganController@editPelanggan');
    Route::get('admin/deletePelanggan/{id}','MpelangganController@deletePelanggan');
    Route::post('admin/storePelanggan','MpelangganController@storePelanggan')->name('admin.storePelanggan');
    Route::post('admin/updatePelanggan/{id}','MpelangganController@updatePelanggan')->name('admin.updatePelanggan'); 

    // Barang
    Route::get('admin/editBarang/{id}','MbarangController@editBarang')->name('admin.editBarang');
    Route::get('admin/deleteBarang/{id}','MbarangController@deleteBarang');
    Route::post('admin/storeBarang','MbarangController@storeBarang')->name('admin.storeBarang');
    Route::post('admin/updateBarang/{id}','MbarangController@updateBarang')->name('admin.updateBarang'); 

    //Akun
    Route::get('admin/editAkun/{id}','AdminController@editAkun');
    Route::get('admin/deleteAkun/{id}','AdminController@deleteAkun');
    Route::post('admin/storeAkun','AdminController@storeAkun')->name('admin.storeAkun');
    Route::post('admin/updateAkun/{id}','AdminController@updateAkun')->name('admin.updateAkun'); 

    // Transaksi Order Masuk 
    Route::post('admin/storeOrderMasuk','OrderMasukController@storeOrderMasuk')->name('admin.storeOrderMasuk');
    Route::get('admin/storeOrderMasuk/{kode_barang}','OrderMasukController@cekHarga'); 
  });

  // Route untuk Keuangan
  Route::group(['middleware' => 'keuangan'], function(){ 
    Route::get('keuangan/dashboard','KeuanganController@Dashboard')->name('keuangan.dashboard');
    Route::get('keuangan/OrderMasuk','KeuanganController@OrderMasuk')->name('keuangan.OrderMasuk');
    Route::get('keuangan/ListOrderMasuk','KeuanganController@ListOrderMasuk')->name('keuangan.ListOrderMasuk');
    Route::get('keuangan/ListOrderMasuk/{id}/LM','KeuanganController@LaporanMasuk')->name('keuangan.LaporanMasuk');
    Route::get('keuangan/ListOrderMasuk/{id}/LM/Print','KeuanganController@LaporanMasukPrint')->name('keuangan.LaporanMasukPrint');
    Route::get('keuangan/ListOrderMasuk/{id}/LK','KeuanganController@LaporanKeluar')->name('keuangan.LaporanKeluar');
    Route::get('keuangan/ListOrderMasuk/{id}/LK/Print','KeuanganController@LaporanKeluarPrint')->name('keuangan.LaporanKeluarPrint');

    // Transaksi Order Masuk 
    Route::post('keuangan/storeOrderMasuk','OrderMasukController@storeOrderMasuk')->name('keuangan.storeOrderMasuk');
    Route::get('keuangan/storeOrderMasuk/{kode_barang}','OrderMasukController@cekHarga'); 
  });

 });
 
