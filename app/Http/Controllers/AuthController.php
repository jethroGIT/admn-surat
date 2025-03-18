<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index(){
        return view('auth.index');
    }

    function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        $infoLogin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($infoLogin)) {
            return redirect('/dashboard');
        } else {
            return redirect('/login')->withErrors('Username atau Password salah')->withInput();
        }

        // if (Auth::attempt($request->only('username', 'password'))) {
        //     return redirect('/dashboard');
        // }
        // return redirect('/login');
    }
}
