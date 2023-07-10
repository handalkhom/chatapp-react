<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials, $request->has("remember_me"))) {
            $request->session()->regenerate();
 
            return redirect("dashboard");
        }
 
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function login(){
        return view("login");
    }

    public function register(){
        return view("register");
    }

    function signup(Request $request) {

        $username          = $request->username;
        $password           = $request->password;
        $conf_password    = $request->conf_password;

        if($password != $conf_password){
            return back()->withErrors([
                'conf_password' => 'KOnfirmasi password salah.',
            ]);
        }

        $data_insert    = [
            "username"   => $username,
            "password"  => \Hash::make($password)
        ];

        $insert     = \DB::table("user")->insert($data_insert);
        return redirect("login");


    }

    public function logout(Request $request)
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
