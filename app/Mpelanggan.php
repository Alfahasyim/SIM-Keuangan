<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mpelanggan extends Model
{
  protected $table = "pelanggan";
  protected $primaryKey = 'id_pelanggan';
  protected $guarded = [];
    
  public function user()
  {
    return $this->belongsTo(User::class, 'edited_by', 'id');
  }
}
