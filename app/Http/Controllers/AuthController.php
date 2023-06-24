<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function index () {
        return view('auth.login');
    }

    public function authentication(request $request)
    {
         //pasang rules
         $rules = [
            'username' => 'required',
            'password'=> 'required'
        ];

        //pasang pesan kesalahan
        $messages = [
            'username.required'     => 'Form username wajib diisi',
            'password.required'     => 'Form password wajib diisi',
        ];

        //ambil semua request dan pasang rules dan isi pesanya
        $validator = Validator::make($request->all(), $rules, $messages);
        //jika rules tidak sesuai kembalikan ke login bawak pesan error dan bawak request nya agar bisa dipakai denga old di view
        if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        //jika berhasil jalankan script berrikut
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            if (Auth::check()) {
                    Session::put('id_user', auth()->user()->id);
                    if (auth()->user()->roles == '1') {
                        $request->session()->regenerate();
                        return \redirect()->intended('/admin')->with('success', 'Selamat datang '. auth()->user()->name.' Admin ' );
                    }else{
                        $request->session()->regenerate();
                        return \redirect()->intended('/user')->with('success', 'Selamat datang '. auth()->user()->name  );
                    }
            }
        }else{
            return back()->with('loginerror', 'Username dan password salah');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        //invalid session supaya tidak bisa dipakai
        $request->session()->flush();
        $request->session()->invalidate();
        //bikin token baru supaya tidak dibajak
        $request->session()->regenerateToken();
        //redirect ke halaman mana
        return \redirect()->route('login');
    }

   
}
