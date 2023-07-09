<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>chat app - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0" id="recent_message">
                            <!-- recent message -->

                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
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
                                    <a href="javascript:void(0);" class="btn btn-outline-secondary"><i
                                            class="fa fa-camera"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i
                                            class="fa fa-image"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-info"><i
                                            class="fa fa-cogs"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-warning"><i
                                            class="fa fa-question"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0" id="chat_history">

                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-send"></i></span>
                                </div>
                                <input type="text" id="input_chat" class="form-control" placeholder="Enter text here...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        $(function(){
            function getRecentMessage(){
                $.ajax({
                    url:"/recentmessage",
                    success:function(result){
                        $("#recent_message").append(result);
                        getChatHistory();
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
            $("body").on("click","#recent_message .clearfix",function(e){
                e.preventDefault();

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
        })
    </script>
</body>

</html>