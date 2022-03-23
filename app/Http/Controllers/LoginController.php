<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    // Request diambil sebagai variabel $request
    {
        // memvalidasi standar inputan utk log in
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // jika benar syarat log in nya, lakukan dibawah ini
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user_dkm = Auth::user()->loc_dkm;
            return redirect()->intended(
                '/'
            );
        }
        // mengirimkan pesan eror yg berupa key-value array
        return back()->with('loginError', 'Login Failed');
    }

    public function logout()
    {
        Auth::logout();
        // jika ingin pake $request definisikan dulu di function, bila pake request() tidak perlu definisi
        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
