@foreach($chats as $chat)
@if($chat->pengirim_id == $user_id)
<li class="clearfix">
    <div class="message-data text-right">
        <span class="message-data-time">{{ date("h:m A, D") }}</span>
        <!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"> -->
    </div>
    <div class="message other-message float-right"> {{ $chat->isi }} </div>
</li>
@else
<li class="clearfix">
    <div class="message-data">
        <span class="message-data-time">{{ date("h:m A, D") }}</span>
    </div>
    <div class="message my-message">{{ $chat->isi }}</div>
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