<?php

namespace App\Http\Controllers;

Use Hash;  
Use App\User; 
use Validator;
use App\Mbarang;
Use App\OrderMasuk;
Use App\DetailOrderMasuk;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class OrderMasukController extends Controller
{
    public function storeOrderMasuk(Request $request)
    { 

      // dd($request);
      $jumlah_laba_bersih = 0;
      $jumlah_total_laba_kotor=$request->grandtotallaba;
      $jumlah_biaya_operasional=$request->biaya_operasional;

      $jumlah_laba_bersih = $jumlah_total_laba_kotor - $jumlah_biaya_operasional;

       $validator = Validator::make($request->all(),[  
        // 'cust_po_number' => ['required'],
        'jenis_bayar' => ['required'],
        'tanggal_order' => ['required'],
        'kode_barang' => ['required'],
        'nama_barang' => ['required'],
        'qty' => ['required'],
        'harga_jual_pcs' => ['required'],
        'harga_modal_pcs' => ['required'],
        'laba_pcs' => ['required'],
        ]);
        if ($validator->fails()) {
          // dd($validator->errors());
          return redirect()->back()->withErrors($validator->errors());  
        }
      $size = count(collect($request)->get('kode_barang'));


      $getNoOrder     = OrderMasuk::select('no_order')->orderByDesc('id')->pluck('no_order')->first();
      $urutNoOrder    = $getNoOrder ? number_format(substr($getNoOrder,15)+1) : 1;
      $no_order       = date('Y.m.d') . '/NOM/' . str_pad($urutNoOrder,8,"0",STR_PAD_LEFT);

      $transaksi = [];
      $transaksi['no_order']              = $no_order; 
      $transaksi['cust_po_number']        = $request->cust_po_number;
      $transaksi['pelanggan_id']          = $request->id_pelanggan;
      $transaksi['jenis_bayar']           = $request->jenis_bayar;  
      $transaksi['tanggal_order']         = $request->tanggal_order;  
      $transaksi['subtot_harga_jual']     = $request->grand_total;  
      $transaksi['subtot_harga_modal']    = $request->grandtotalmodal;  
      $transaksi['subtot_laba_kotor']     = $request->grandtotallaba;  
      $transaksi['subtot_laba_bersih']    = $jumlah_laba_bersih;  
      $transaksi['biaya_operasional']     = $request->biaya_operasional;  
      $transaksi['keterangan']            = $request->keterangan;  
      $transaksi['sisa_kembali']          = $request->sisa_kembali;  
      $transaksi['edited_by']             = Auth::user()->id;
      $ordermasuk                         = OrderMasuk::create($transaksi);
      
      $detail_order_masuk = [];
      for ($i = 0; $i < $size ; $i++){
        $dump = [];  
        $dump['kode_barang']          = $request->kode_barang[$i];
        $dump['nama_barang']          = $request->nama_barang[$i]; 
        $dump['qty']                  = $request->qty[$i];
        $dump['harga_jual_pcs']       = $request->harga_jual_pcs[$i];
        $dump['harga_modal_pcs']      = $request->harga_modal_pcs[$i];
        $dump['laba_pcs']             = $request->laba_pcs[$i]; 

        $detail_order_masuk[] = $dump; 
      } 
      // dd($transaksi_detail_pembelian); 
      Session::flash('sukses','Berhasil Simpan Data.');
      $ordermasuk->detail_order_masuk()->createMany($detail_order_masuk); 

      
      if (Auth::user()->level == "admin") {
        return redirect()->route('admin.OrderMasuk');
      }else if(Auth::user()->level == "keuangan") {
        return redirect()->route('keuangan.OrderMasuk');
      }
    }

    public function deleteListOrderMasuk($id)
    {
    $data = OrderMasuk::find($id)->delete();
    $dataDetail = DetailOrderMasuk::where('order_id', $id)->delete();

    return response()->json(['success'=>'Post Deleted successfully']);
    }
}
