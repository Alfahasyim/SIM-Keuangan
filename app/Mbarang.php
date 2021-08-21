<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mbarang extends Model
{
  protected $table = "barang";
  protected $primaryKey = 'kode_barang';
  
  public $incrementing = false; 
  protected $guarded = [];

  public function order_masuk()
  {
    return $this->hasMany(DetailOrderMasuk::class, 'kode_barang', 'kode_barang');
  }
  public function user()
  {
      return $this->belongsTo(User::class, 'edited_by', 'id');
  }
}
