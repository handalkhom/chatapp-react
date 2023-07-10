<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $status     = "";
        $message    = "";

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $token  = \Str::random(30);
            \DB::table("user")->where("user_id",\Auth::user()->user_id)->update(["remember_token" => $token]);

            $status     = "success";
            $message    = "Login Sukses";
        }else{
            $status     = "error";
            $message    = "Username / Password Salah";
        }
 
        $return_arr = [
            "status"    => $status,
            "message"    => $message,
            "token"    => !empty($token) ? $token : "",
        ];

        return response()->json($return_arr);
    }

    function signup(Request $request) {

        $status     = "";
        $message    = "";
        $validation_error = false;

        $username         = $request->username;
        $password         = $request->password;
        $conf_password    = $request->conf_password;

        if($password != $conf_password){
            $status     = "error";
            $message    = "Konfirmasi Password Salah";
            $validation_error   = true;
        }

        if(!$validation_error){

            $data_insert    = [
                "username"   => $username,
                "password"  => \Hash::make($password)
            ];
    
            $insert     = \DB::table("user")->insert($data_insert);
            if($insert){
                $status     = "success";
                $message    = "Registrasi Sukses";
            }else{
                $status     = "error";
                $message    = "Registrasi Gagal";
            }
        }

        $return_arr = [
            "status"    => $status,
            "message"    => $message,
        ];

        return response()->json($return_arr);
        
    }

}
