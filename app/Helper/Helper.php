<?php

namespace App\Helper;

class Helper{
    public static function getUserLogin($token){
        return \DB::table("user")->where("remember_token",$token)->first();
    }
}