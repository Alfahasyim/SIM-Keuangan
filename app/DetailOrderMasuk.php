<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrderMasuk extends Model
{
  protected $table = 'detail_order_masuk';
  protected $guarded = [];
  protected $appends = ['sub_total_harga_jual_pcs','sub_total_harga_modal_pcs','sub_total_laba_kotor_pcs'];

  public function order_masuk()
  {
    return $this->belongsTo(OrderMasuk::class,'order_id','id');
  }

  public function barang()
  {
    return $this->belongsTo(Mbarang::class,'kode_barang','kode_barang');
  }

  public function getSubTotalHargaJualPcsAttribute()
  {
    $sub_total_harga_jual_pcs = 0;
    $sub_total_harga_jual_pcs = $this->qty * $this->harga_jual_pcs; 

    return $sub_total_harga_jual_pcs;
  }

  public function getSubTotalHargaModalPcsAttribute()
  {
    $sub_total_harga_modal_pcs = 0;
    $sub_total_harga_modal_pcs = $this->qty * $this->harga_modal_pcs; 

    return $sub_total_harga_modal_pcs;
  }

  public function getSubTotalLabaKotorPcsAttribute()
  {
    $sub_total_laba_kotor_pcs = 0;
    $sub_total_laba_kotor_pcs = $this->qty * $this->laba_pcs; 

    return $sub_total_laba_kotor_pcs;
  }  

}
