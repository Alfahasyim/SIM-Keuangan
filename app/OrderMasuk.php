<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMasuk extends Model
{
  protected $table = "order_masuk";
  protected $guarded = [];
  protected $appends = ['jumlah_total_harga_jual','jumlah_total_harga_modal','jumlah_total_laba_kotor','jumlah_total_laba_bersih'];

  public function detail_order_masuk()
  {
    return $this->hasMany(DetailOrderMasuk::class, 'order_id', 'id');
  }

  public function pelanggan()
  {
    return $this->belongsTo(Mpelanggan::class, 'pelanggan_id', 'id_pelanggan');
  }

  public function getJumlahTotalHargaJualAttribute()
  {
    $jumlah_total_harga_jual = 0;
    foreach ($this->detail_order_masuk()->get() as $value) {
      $jumlah_total_harga_jual+= $value->qty*$value->harga_jual_pcs;
    }

    return $jumlah_total_harga_jual;
  }

  public function getJumlahTotalHargaModalAttribute()
  {
    $jumlah_total_harga_modal = 0;
    foreach ($this->detail_order_masuk()->get() as $value) {
      $jumlah_total_harga_modal+= $value->qty*$value->harga_modal_pcs;
    }

    return $jumlah_total_harga_modal;
  }

  public function getJumlahTotalLabaKotorAttribute()
  {
    $jumlah_total_laba_kotor = 0;
    foreach ($this->detail_order_masuk()->get() as $value) {
      $jumlah_total_laba_kotor+= $value->qty*$value->laba_pcs;
    }

    return $jumlah_total_laba_kotor;
  }

  public function getJumlahTotalLabaBersihAttribute()
  {
    $jumlah_total_laba_bersih = 0;
    $jumlah_total_laba_kotor = 0;
    foreach ($this->detail_order_masuk()->get() as $value) {
      $jumlah_total_laba_kotor+= $value->qty*$value->laba_pcs;
    } 
    
    $jumlah_total_laba_bersih+= $jumlah_total_laba_kotor - $this->biaya_operasional;

    return $jumlah_total_laba_bersih;
  }
 
}
