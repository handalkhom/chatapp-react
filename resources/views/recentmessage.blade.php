
@foreach($recent_message as $key => $rm)
<li class="clearfix" data-room_id="{{ $rm->room_id }}">
    <img src="{{ $rm->profile_img }}" alt="avatar">
    <div class="about">
        <div class="name">{{ $rm->nama_kontak }}</div>
        <div class="status"> {{ $rm->last_chat }} </div>
    </div>
</li>
@endforeach