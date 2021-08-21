<?php

namespace App\Http\Controllers;

Use Hash;
Use Auth;
use Session;
use Response;
use Validator;
Use App\User;
Use App\Mbarang;
use Illuminate\Http\Request;

class MbarangController extends Controller
{
  public function storeBarang(Request $request){
  $validator = Validator::make($request->all(),[
    // 'kode_barang'   => 'required',
    'nama_barang'   => 'required',
    'status'        => 'required'
  ]);
  if ($validator->fails()) {
    return redirect()->back()->withErrors($validator->errors());
  }

  $data = array(
      // 'kode_barang'  => $request->kode_barang,
      'nama_barang'  => $request->nama_barang,
      'status'       => $request->status,
      'edited_by'    => Auth::user()->id,
      );
  // dd($data);
  Mbarang::updateOrCreate($data);
  return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $data], 200);
  }

  public function editBarang($id){
    $barang = Mbarang::find($id);
    // dd($pelanggan);
    return response()->json($barang);
  }

  public function updateBarang($id, Request $request){
    $data = Mbarang::find($id);
    // $data->kode_barang    = $request->kode_barang;
    $data->nama_barang    = $request->nama_barang;
    $data->status         = $request->status;
    $data->edited_by      = Auth::user()->id;
    $data->save();
    return response()->json(['code'=>200, 'message'=>'Update successfully','data' => $data], 200);
  }

  public function deleteBarang($id){
    $data = Mbarang::find($id)->delete();

    return response()->json(['success'=>'Post Deleted successfully']);
    }
}
