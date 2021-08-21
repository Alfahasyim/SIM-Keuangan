<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginProses(Request $request)
  {
    // $username = $request->username;
    // $password = $request->password;
    // dd($request);
    $input = $request->only('username','password');
    $this->validate($request,[
      'username' => 'required',
      'password' => 'required',
    ]);

    try {
      $data = Auth::attempt($input,false);
      // dd();
      if ($data) {
        if (Auth::user()->level == "admin") {
          return redirect('/admin/dashboard')->withSuccess('Login Sukses');
        }else if(Auth::user()->level == "keuangan") {
          return redirect('/keuangan/dashboard')->withSuccess('Login Sukses');
        }
      }else{
        return redirect()->back()->withErrors(['Login Gagal! Username atau Password Salah!', 'msg']);
      }
    } catch (Exception $e) {
        return redirect()->back()->withErrors(['Login Gagal! Username atau Password Salah!', 'msg']);
    }

  }

  public function logoutProses()
  {
    // $request->session()->flush('token');
    Auth::logout();
    return redirect()->route('login');
  }
}
