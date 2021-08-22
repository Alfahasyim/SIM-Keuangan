<?php

namespace App\Http\Controllers;

Use Hash;
Use Auth;
use Session;
use Validator;
Use App\User;
Use App\Mpelanggan;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class MpelangganController extends Controller
{
  public function storePelanggan(Request $request){
  $validator = Validator::make($request->all(),[
    'nama_pelanggan'  => 'required',
    'status'          => 'required'
  ]);
  if ($validator->fails()) {
    return redirect()->back()->withErrors($validator->errors());
  }

  $data = array(
      'nama_pelanggan'  => $request->nama_pelanggan, 
      'alamat'          => $request->alamat,
      'status'          => $request->status,
      'edited_by'       => Auth::user()->id,
      );
  // dd($data);
  Mpelanggan::updateOrCreate($data);
  return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $data], 200);
  }

  public function editPelanggan($id){
    $pelanggan = Mpelanggan::find($id);
    // dd($pelanggan);
    return response()->json($pelanggan);
  }

  public function updatePelanggan($id, Request $request){
    $data = Mpelanggan::find($id);
    $data->nama_pelanggan = $request->nama_pelanggan;
    $data->alamat         = $request->alamat; 
    $data->status         = $request->status;
    $data->edited_by      = Auth::user()->id;
    $data->save();
    return response()->json(['code'=>200, 'message'=>'Update successfully','data' => $data], 200);
  }

  public function deletePelanggan($id){
    $data = Mpelanggan::find($id)->delete();

    return response()->json(['success'=>'Post Deleted successfully']);
    }
}
