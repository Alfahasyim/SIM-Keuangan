<?php

namespace App\Http\Controllers;

Use Auth;
use Session;
Use App\User;
use Validator;
Use App\Mbarang;
Use App\Mpelanggan;
Use App\OrderMasuk;
Use App\DetailOrderMasuk;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;;

class KeuanganController extends Controller
{
    public function Dashboard()
  {
    $total_order = 0;
    $total_order = OrderMasuk::count(); 
    $order = OrderMasuk::get();
    // foreach($order as $value){
    //   $pendapatan = $value->sum('biaya_operasional');
    // dd($pendapatan);
    // }
    
    return view('keuangan.dashboard', compact('total_order','order'));
  }

  public function OrderMasuk()
  { 
    $getNoOrder     = OrderMasuk::select('no_order')->orderByDesc('id')->pluck('no_order')->first();
    $urutNoOrder    = $getNoOrder ? number_format(substr($getNoOrder,15)+1) : 1;
    $no_order       = date('Y.m.d') . '/NOM/' . str_pad($urutNoOrder,8,"0",STR_PAD_LEFT);

    $pelanggan      = Mpelanggan::where('status', '1')->get();
    $barang         = Mbarang::where('status', '1')->get();

    return view('keuangan.OrderMasuk', compact('pelanggan', 'barang', 'no_order'));
  }

  public function ListOrderMasuk()
  {
    $listordermasuk = OrderMasuk::all();
    $barang = Mbarang::all();
    
    return view('keuangan.ListOrderMasuk', compact('listordermasuk','barang'));
  }

  public function LaporanMasuk($id)
  {
    $data_detail_order = DetailOrderMasuk::where('order_id',$id)->get();
    $data_order = OrderMasuk::where('id',$id)->first();

    return view('keuangan.LaporanMasuk', compact('data_detail_order','data_order'));
  }
  
  public function LaporanMasukPrint($id)
  {
    $data_detail_order = DetailOrderMasuk::where('order_id',$id)->get();
    $data_order = OrderMasuk::where('id',$id)->first();

    return view('keuangan.LaporanMasukPrint', compact('data_detail_order','data_order'));
  }

  public function LaporanKeluar($id)
  {
    $data_detail_order = DetailOrderMasuk::where('order_id',$id)->get();
    $data_order = OrderMasuk::where('id',$id)->first();

    return view('keuangan.LaporanKeluar', compact('data_detail_order','data_order'));
  }

  public function LaporanKeluarPrint($id)
  {
    $data_detail_order = DetailOrderMasuk::where('order_id',$id)->get();
    $data_order = OrderMasuk::where('id',$id)->first();

    return view('keuangan.LaporanKeluarPrint', compact('data_detail_order','data_order'));
  }
}
