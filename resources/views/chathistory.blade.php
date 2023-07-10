<style>
    .msg_image{
        max-width : 300px;
    }
</style>
@foreach($chats as $chat)
@if($chat->pengirim_id == $user_id)
<li class="clearfix">
    <div class="message-data text-right">
        <span class="message-data-time">{{ date("h:m A, D",strtotime($chat->date_created)) }}</span>
        <!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"> -->
    </div>
    <div class=" float-right"> 
        <i class="fa fa-fw fa-trash btn_delete_message" data-chat_id="{{ $chat->chat_id }}"></i>
    </div>
    <div class="message other-message float-right"> 
        @if(!empty($chat->file))
            <img src="/uploads/{{$chat->file}}" alt="" class="msg_image">
        @endif
        @if(!empty($chat->isi))
            {{ $chat->isi }}
        @endif
    </div>
</li>
@else
<li class="clearfix">
    <div class="message-data">
        <span class="message-data-time">{{ date("h:m A, D",strtotime($chat->date_created)) }}</span>
    </div>
    <div class="message my-message">
        @if(!empty($chat->file))
            <img src="/uploads/{{$chat->file}}" alt="" class="msg_image">
        @endif
        @if(!empty($chat->isi))
            {{ $chat->isi }}
        @endif
    </div>
</li>
@endif
@endforeach
<!-- <li class="clearfix">
    <div class="message-data">
        <span class="message-data-time">10:15 AM, Today</span>
    </div>
    <div class="message my-message">Project has been already finished and I have results
        to show you.</div>
</li> -->