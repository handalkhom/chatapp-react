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

    function kirim_file(Request $request) {
        $status     = "";
        $message     = "";

        $file = $request->file('file');
        $room_id    = $request->room_id;
        $pengirim_id    = \Auth::user()->user_id;

        $new_name   = "file_".$room_id."_".$pengirim_id."_".time().".".$file->getClientOriginalExtension();
        $file->move("uploads",$new_name);

        $data_insert    = [
            "file"   => $new_name,
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

    function new_chat(Request $request) {
        $status     = "";
        $message     = "";

        $chat           = $request->chat;
        $file           = $request->file('file');
        $penerima_id    = $request->penerima_id;
        $pengirim_id    = \Auth::user()->user_id;


        // check user room apa sudah pernah chat
        $room_penerima  = \DB::table("user_room")->where("user_id",$penerima_id)->get();
        $room_pengirim  = \DB::table("user_room")->where("user_id",$pengirim_id)->get();
        $sudah_pernah_chat = false;
        $room_id        = 0;
        
        if(count($room_penerima) > 0 && count($room_pengirim) > 0){
            foreach ($room_penerima as $room1) {
                foreach ($room_penerima as $room2) {
                    if($room1->room_id == $room2->room_id){
                        $sudah_pernah_chat  = true;
                        $room_id    = $room1->room_id;
                        break;
                    }
                }
            }
        }


        if(empty($room_id)){
            $room_id   = \DB::table("room")->insertGetId(["name" => ""]);
            
            \DB::table("user_room")->insert(["user_id" => $penerima_id,"room_id" => $room_id]);
            \DB::table("user_room")->insert(["user_id" => $pengirim_id,"room_id" => $room_id]);
        }

        $data_insert    = [
            "isi"   => $chat,
            "room_id"   => $room_id,
            "pengirim_id"  => $pengirim_id
        ];

        if(!empty($file)){
            $new_name   = "file_".$room_id."_".$pengirim_id."_".time().".".$file->getClientOriginalExtension();
            $file->move("uploads",$new_name);

            $data_insert["file"] = $new_name;
        }

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
            "room_id"    => $room_id,
        ];

        return response()->json($return_arr);
    }

    function hapus_pesan(Request $request) {
        $status     = "";
        $message     = "";

        $chat_id    = $request->chat_id;
        $pengirim_id    = \Auth::user()->user_id;

        $delete     = \DB::table("chat")->where("chat_id",$chat_id)->delete();
        if($delete){
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
