<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //

    function kirim_pesan(Request $request) {
        $status     = "";
        $message     = "";

        $chat = $request->chat;
        $room_id    = $request->room_id;
        $pengirim_id    = \Auth::user()->user_id;

        $data_insert    = [
            "isi"   => $chat,
            "room_id"   => $room_id,
            "pengirim_id"  => $pengirim_id
        ];

        $insert     = \DB::table("chat")->insert($data_insert);
        if($insert){
            $status = "success";
            $message    = "Sukses";
        }else{
            $status     = "error";
            $message    = "Error!";
        }

        $return_arr = [
            "status"    => $status,
            "message"    => $message,
        ];

        return response()->json($return_arr);
    }
}
