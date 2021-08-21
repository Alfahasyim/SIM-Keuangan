<?php

namespace App\Http\Controllers;

Use Hash;
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
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
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
    
    return view('admin.dashboard', compact('total_order','order'));
  }

  public function MpelangganView()
  {
    
    $data = Mpelanggan::where('status','=','1')->get();
    // dd($data);
    return view('admin.Mpelanggan',['data' => $data]);
  }

  public function MbarangView()
  {
    $data = Mbarang::where('status','=','1')->get();
    return view('admin.Mbarang',compact('data'));
  }

  public function OrderMasuk()
  { 
    $getNoOrder     = OrderMasuk::select('no_order')->orderByDesc('id')->pluck('no_order')->first();
    $urutNoOrder    = $getNoOrder ? number_format(substr($getNoOrder,15)+1) : 1;
    $no_order       = date('Y.m.d') . '/NOM/' . str_pad($urutNoOrder,8,"0",STR_PAD_LEFT);

    $pelanggan      = Mpelanggan::where('status', '1')->get();
    $barang         = Mbarang::where('status', '1')->get();

    return view('admin.OrderMasuk', compact('pelanggan', 'barang', 'no_order'));
  }

  public function ListOrderMasuk()
  {
    $listordermasuk = OrderMasuk::all();
    $barang = Mbarang::all();
    
    return view('admin.ListOrderMasuk', compact('listordermasuk','barang'));
  }

  public function LaporanMasuk($id)
  {
    $data_detail_order = DetailOrderMasuk::where('order_id',$id)->get();
    $data_order = OrderMasuk::where('id',$id)->first();

    return view('admin.LaporanMasuk', compact('data_detail_order','data_order'));
  }

  public function LaporanMasukPrint($id)
  {
    $data_detail_order = DetailOrderMasuk::where('order_id',$id)->get();
    $data_order = OrderMasuk::where('id',$id)->first();

    return view('admin.LaporanMasukPrint', compact('data_detail_order','data_order'));
  }

  public function LaporanKeluar($id)
  {
    $data_detail_order = DetailOrderMasuk::where('order_id',$id)->get();
    $data_order = OrderMasuk::where('id',$id)->first();

    return view('admin.LaporanKeluar', compact('data_detail_order','data_order'));
  }

  public function LaporanKeluarPrint($id)
  {
    $data_detail_order = DetailOrderMasuk::where('order_id',$id)->get();
    $data_order = OrderMasuk::where('id',$id)->first();

    return view('admin.LaporanKeluarPrint', compact('data_detail_order','data_order'));
  }

  public function SakunView()
  {
    $data = User::where('status','=','1')->get();

    return view('admin.Sakun', compact('data'));
  }

  public function storeAkun(Request $request)
  {
    $validator = Validator::make($request->all(),[
          'nama_user' => 'required',
          'username' => 'required',
          'password' => 'required',
          'level' => 'required',
          'status' => 'required',
        ]);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }
    $data = array(
        'nama_user'     => $request->nama_user,
        'level'         => $request->level,
        'username'      => $request->username,
        'password'      => Hash::make($request->password),
        'view_password' => $request->password,
        'status'        => $request->status,
        );
    // dd($data);
    User::updateOrCreate($data);
    return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $data], 200);
  }

  public function editAkun($id)
  {
    $user = User::find($id); 

    return response()->json($user);
  }

  public function updateAkun($id, Request $request)
  {
    $data                 = User::find($id);
    $data->nama_user      = $request->nama_user;
    $data->level          = $request->level;
    $data->username       = $request->username;
    $data->password       = Hash::make($request->password);
    $data->view_password  = $request->password;
    $data->status         = $request->status; 
    $data->save();
    return response()->json(['code'=>200, 'message'=>'Update successfully','data' => $data], 200);
  }

   public function deleteAkun($id)
   {
    $data = User::find($id)->delete();

    return response()->json(['success'=>'Post Deleted successfully']);
    }


}