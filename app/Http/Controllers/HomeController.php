<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        return view("index");
    }
    public function recentmessage(){
        // SELECT 
        // (
        // IF(
        // room_chat.isGroup = 1,
        // room_chat.nama_room_chat, 
        // (SELECT nama_user FROM user as user_tujuan 
        // INNER JOIN room_users as room_users_tujuan 
        // ON user_tujuan .id_user = room_users_tujuan.id_user
        // WHERE user_tujuan.id_user != user_sql.id_user 
        // AND room_users_tujuan.id_room_chat = room_chat.id_room_chat
        // LIMIT 1) 
        // )
        // ) as nama_kontak,
        // (
        // SELECT isi_chat FROM chats 
        // INNER JOIN status_chat ON chats.id_chat = status_chat.id_chat
        // WHERE chats.id_room_chat = room_chat.id_room_chat
        // ORDER BY sent_at DESC 
        // LIMIT 1
        // ) as pesan_terakhir
        // FROM user as user_sql
        // INNER JOIN room_users room_users_sql ON user_sql.id_user = room_users_sql.id_user
        // INNER JOIN room_chat ON room_chat.id_room_chat = room_users_sql.id_room_chat
        // WHERE user_sql.nama_user = "JAMAL";

        $recent_message     = \DB::table("room")
        ->select(
            "room.room_id",
            \DB::raw(" (SELECT username FROM user as user_tujuan 
                INNER JOIN user_room as user_room_tujuan 
                ON user_tujuan.user_id = user_room_tujuan.user_id
                WHERE user_tujuan.user_id != user_sql.user_id 
                AND user_room_tujuan.room_id = room.room_id
                LIMIT 1) as nama_kontak "),
            \DB::raw(" (SELECT isi FROM chat WHERE chat.room_id = room.room_id ORDER BY chat_id DESC LIMIT 1) as last_chat "),
            \DB::raw(" (SELECT date_created FROM chat WHERE chat.room_id = room.room_id ORDER BY chat_id DESC LIMIT 1) as last_date_created ")
        )
        ->join("user_room as room_users_sql","room_users_sql.room_id","=","room.room_id")
        ->join("user as user_sql","room_users_sql.user_id","=","user_sql.user_id")
        ->where("room_users_sql.user_id",\Auth::user()->user_id)
        ->orderBy("last_date_created","DESC")
        ->get();
        $data   = [
            "recent_message"    => $recent_message
        ];
        return view("recentmessage",$data);
    }
    public function chathistory(Request $request){
        $room_id    = $request->room_id;

        $chats  = \DB::table("chat")->where("room_id",$room_id)->get();
        $user_id    = \Auth::user()->user_id;

        $data   = [
            "chats"     => $chats,
            "user_id"     => $user_id,
        ];
        return view("chathistory",$data);
    }
}
