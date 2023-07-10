<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>chat app - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <style>
        .container-profile{
            text-align: center;
            display: block;
            padding: 10px 20px 0;
        }
        .container-profile .profile-img{
            width: 162px;
            height : 162px;
            object-fit : cover;
            object-position: center;
            margin-bottom: 10px;
        }

        .people-list .chat-list img{
            height : 45px;
            object-fit : cover;
            object-position: center;
        }

        #gambar_kontak{
            height : 40px;
            object-fit : cover;
            object-position: center;
        }
    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <input type="text" id="search" class="form-control" placeholder="Search...">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="container-profile">
                                        <img class="profile-img" src="{{ $profile_img }}" alt="">
                                    </div>
                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#newChatModal">Chat Baru</a>
                                    <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#profileImgModal">Update   Profile Picture</a>
                                    <a href="/logout" class="dropdown-item">Log Out</a>
                                </div>
                            </div>
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0" id="recent_message">
                            <!-- recent message -->
                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix" style="display:none">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img id="gambar_kontak" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0" id="nama_kontak">Aiden Chavez</h6>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-sm text-right">
                                    <!-- <a href="javascript:void(0);" class="btn btn-outline-secondary"><i
                                            class="fa fa-camera"></i></a> -->
                                    <a href="javascript:void(0);" id="btn_upload_file" class="btn btn-outline-primary"><i
                                            class="fa fa-image"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0" id="chat_history" style="min-height:50vh;">

                            </ul>
                        </div>
                        <div class="chat-message clearfix" style="display:none;">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-send"></i></span>
                                </div>
                                <input type="text" id="input_chat" class="form-control" placeholder="Enter text here...">
                                <form action="" id="form_upload" method="post" enctype="multipart/form-data">
                                    <input type="file" name="file" id="input_file" class="d-none">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newChatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data" id="formNewChat">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Chat Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Penerima</label>
                            <select name="penerima_id" id="penerima_id" class="form-control">
                                <option value="">Pilih</option>
                                @foreach($users as $user)
                                <option value="{{ $user->user_id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Pesan</label>
                            <input type="text" name="chat" id="chat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">File</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="profileImgModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data" id="formProfileImg">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Profile Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        $(function(){
            function getRecentMessage(room_id = 0){
                $.ajax({
                    url:"/recentmessage",
                    data : {
                        search : $("#search").val()
                    },
                    success:function(result){
                        $("#recent_message").html(result);
                        if(room_id != 0){
                            $(`#recent_message [data-room_id=${room_id}]`).click();
                        }
                        // getChatHistory();
                    }
                })
            }
            getRecentMessage();
            function getChatHistory(){
                let room_id = $("#recent_message .clearfix.active").data("room_id");
                $("#chat_history").html("");
                $.ajax({
                    url:"/chathistory",
                    data : {
                        room_id : room_id
                    },
                    success:function(result){
                        $("#chat_history").append(result);
                    }
                })
            }
            $("body").on("click",".btn_delete_message",function(e){
                if(confirm("Delete chat ini?")){
                    let chat_id = $(this).data("chat_id");
                    $.ajax({
                        url     : "/hapus_pesan",
                        data    : {
                            chat_id    : chat_id,
                            _token  : $(`{{ csrf_field() }}`).val()
                        },
                        method  : "POST",
                        dataType : "JSON",
                        success : function(data) {
                            if(data.status == "success"){
                                getChatHistory();
                            }else{
                                alert(data.message);
                            }
                        }
                    })
                }
            })
            $("body").on("click","#btn_upload_file",function(e){
                e.preventDefault();
                $("#input_file").click();
            })

            $("body").on("click","#recent_message .clearfix",function(e){
                e.preventDefault();

                $(".chat-header").show();
                $(".chat-message").show();

                $("#recent_message .clearfix").removeClass("active");
                $(this).addClass("active");

                let nama_kontak     = $("#recent_message .clearfix.active .about .name").html();
                $("#nama_kontak").html(nama_kontak);

                let gambar_kontak     = $("#recent_message .clearfix.active img").attr("src");
                $("#gambar_kontak").attr("src",gambar_kontak);

                getChatHistory();
            })

            $("body").on("keyup","#input_chat",function(e){
                if(e.keyCode == 13){
                    let input_chat = $("#input_chat").val();
                    let room_id = $("#recent_message .clearfix.active").data("room_id");
                    $.ajax({
                        url     : "/kirim_pesan",
                        data    : {
                            chat    : input_chat,
                            room_id    : room_id,
                            _token  : $(`{{ csrf_field() }}`).val()
                        },
                        method  : "POST",
                        dataType : "JSON",
                        success : function(data) {
                            if(data.status == "success"){
                                getChatHistory();
                                $("#input_chat").val("");
                            }else{
                                alert(data.message);
                            }
                        }
                    })
                }
            })
            $("body").on("keyup","#search",function(e){
                if(e.keyCode == 13){
                    getRecentMessage();
                }
            })

            $("body").on("change","#input_file",function(e){
                let input_file = $("#input_file").val();
                let room_id = $("#recent_message .clearfix.active").data("room_id");
                let formData = new FormData($("#form_upload")[0]);
                formData.append("room_id",room_id);
                formData.append("_token",$(`{{ csrf_field() }}`).val());
                $.ajax({
                    url     : "/kirim_file",
                    processData : false,
                    contentType : false,
                    data    : formData,
                    method  : "POST",
                    dataType : "JSON",
                    success : function(data) {
                        if(data.status == "success"){
                            getChatHistory();
                            $("#input_file").val("");
                        }else{
                            alert(data.message);
                        }
                    },
                    error: function (){
                        $("#input_file").val("");
                    }
                })
            })

            $("body").on("submit","#formNewChat",function(e){
                e.preventDefault();
                let formData    = new FormData(this);
                $.ajax({
                    url     : "/new_chat",
                    data    : formData,
                    processData : false,
                    contentType : false,
                    method  : "POST",
                    dataType : "JSON",
                    success : function(data) {
                        if(data.status == "success"){
                            getRecentMessage(data.room_id);
                            $("#formNewChat")[0].reset();
                            $("#newChatModal").modal("hide");
                        }else{
                            alert(data.message);
                        }
                    }
                })
            })

            $("body").on("submit","#formProfileImg",function(e){
                e.preventDefault();
                let formData    = new FormData(this);
                $.ajax({
                    url     : "/update_profile_img",
                    data    : formData,
                    processData : false,
                    contentType : false,
                    method  : "POST",
                    dataType : "JSON",
                    success : function(data) {
                        if(data.status == "success"){
                            $("#formProfileImg")[0].reset();
                            $("#profileImgModal").modal("hide");
                            $(".profile-img").attr("src",data.profile_img);
                        }else{
                            alert(data.message);
                        }
                    }
                })
            })

            
        })
    </script>
</body>

</html>