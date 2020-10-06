<?php
    /* Template Name: Message Board */
    session_start();
        $retailer = $_SESSION["retailer"];
    if ($retailer == null && $retailer != "override"){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <title>Message Board</title>
    <script src="https://kit.fontawesome.com/ee654fe705.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            font-family: Nunito;
        }

        .sidebar {
            margin: 0;
            padding: 0;
            width: 300px;
            background-color: #000d1a;
            position: fixed;
            height: 100%;
            overflow: auto;
            border-right: 1px solid #c3c3c3;
        }

        .sidebar h1{
            font-weight: 900;
            color: red;
            margin: 10px 15px 30px 10px;
            padding: 10px 5px 15px 0;
            border-bottom: 6px solid #c3c3c3;
            width: 40%;
        }

        .hands{
            color: #fff;
        }

        .sidebar h3{
            font-weight: bold;
            font-size: 25px;
            padding: 25px 15px;
            color: #f2f2f2;
            text-align: center;
        }

        .sidebar .user {
            padding: 16px;
            margin-left: 10%;
        }

        .sidebar .user .name {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
        }

        .indicator {
            width: 8px;
            height: 8px;
            display: inline-block;
            border-radius: 50%;
        }

        .presence {
            opacity: 0.7;
            color: #f2f2f2;
        }

        div.chat {
            margin-left: 300px;
            padding: 0 16px;
            height: 88vh;
            overflow: auto;
            background-color: #c3c3c3;
        }

        #messages{
            width: 100%;
            height: 88vh;
            overflow-x: hidden;
        }

        .incoming{
            width: 46%;
        }

        .outgoing{
            float: right;
            width: 46%;
        }

        form {
            display: flex;
            position: fixed;
            bottom: 0;
            width: 74%;
            overflow-x: hidden;
        }

        input{
            font-size: 1.2rem;
            padding: 10px;
            margin: 10px 5px;
            appearance: none;
            -webkit-appearance: none;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #message{
            flex: 2;
        }

        #message:focus{
            border: 3px solid #3399ff;
        }

        .time_date {
            color: #800000;
            display: block;
            font-size: 12px;
            margin: 8px 0 0;
            float: right;
        }

        .sent_msg, .recieved_msg {
            width: 55%;
            overflow:hidden;
            margin:10px 0 5px;
        }

        .sent_msg p{
            background: rgba(0, 13, 26, 0.7) none repeat scroll 0 0;
            border-radius: 3px;
            font-size: 14px;
            margin: 0; color:#fffef7;
            padding: 5px 10px 5px 12px;
            width:100%;
        }

        .recieved_msg p {
            background: #f3f3f3 none repeat scroll 0 0;
            border-radius: 3px;
            font-size: 14px;
            margin: 0; color:#000000;
            padding: 5px 10px 5px 12px;
            width:95%;
            border: 1px solid #c3c3c3;
        }

        .fa-paper-plane{
            color: #fffef7;
            font-size: 20px;
        }

        .send{
            background-color: #000000;
            color: #fffef7;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
        }

        .fa-expand{
            color: #000d1a;
            font-size: 25px;
        }

        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .inputfile + label .fa-paperclip{
            font-size: 35px;
            color: #800000;
            display: inline-block;
            padding: 15px 10px;
        }

        .inputfile:focus + label .fa-paperclip,
        .inputfile + label .fa-upload:hover {
            color: #000d1a;
        }

        .inputfile + label {
            cursor: pointer; /* "hand" cursor */
        }

        .inputfile:focus + label {
            outline: 1px dotted #000;
            outline: -webkit-focus-ring-color auto 5px;
        }

        .inputfile + label * {
            pointer-events: none;
        }

        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar {
                border-bottom: 1px solid #c3c3c3;
            }

            .sidebar h1{width: 18%;}
            .sidebar h3{display: none;}
            .sidebar .user {float: left; margin: auto;}
            div.chat {margin-left: 0; height: 60vh;}
            form{width: 95%;}
        }

    </style>
</head>
<body>
<?php
if ($_SESSION["retailer"] != null && $_SESSION["retailer"] != "override") {
    $sender = $_SESSION["retailer"];
}

if ($_SESSION["seller"] != null) {
    $sender = $_SESSION["seller"];
}


?>

<div class="sidebar">
    <h1>oz<span class="hands">Hands</span></h1>

    <h3>PEOPLE</h3>

    <div class="user">
        <div class="name"><?php echo $wholesaler; ?> <span class="indicator" id="seller-indicator"></span></div>
        <div id="seller-presence" class="presence"></div>
    </div>

    <div class="user">
        <div class="name"><?php echo $buyer; ?> <span class="indicator" id="buyer-indicator"></span></div>
        <div id="buyer-presence" class="presence"></div>
    </div>

</div>

<div id="order" style="display: none;"><?php echo $_SESSION["order"]?></div>
<div id="sender" style="display: none;"><?php echo $sender?></div>
<div class="chat">
    <div id="messages">

    </div>

    <form>
        <input type="file" name="file" id="file" class="inputfile">
        <label for="file"><i class="fas fa-paperclip"></i></label>
        <input type="text" name="message" id="message" autocomplete="off" autofocus placeholder="Type a message...">
        <button type="submit" class="send"><i class="fas fa-paper-plane"></i></button>
    </form>

</div>
</div>
<script>
    var start = 0, url = 'http://localhost/message.php', sender = $('#sender').text(), data, input;


    $(document).ready(function () {
        setInterval(checkPresence, 1000);

        if (performance.navigation.type == performance.navigation.TYPE_RELOAD){
            console.log("Reloaded");
        }else {
            if($('#order').text() != null) {

                $.post(url, {
                    message: $('#order').text(),
                    from: sender,
                });
            }
        }


        load();

        $('#file').change(function () {
            input = $('#file')[0].files[0];
            data = new FormData();
            data.append('file', input);

            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                data: data,
            });

        });

        $('form').submit(function (e) {
            $.post(url, {
                message: $('#message').val(),
                from: sender,
            });

            $('#message').val('');
            return false;
        })
    });

    function load() {
        $.get(url + '?start=' + start, function (result) {
            if(result.items) {
                result.items.forEach(item => {
                    start = item.id;
                    if(item.seller == 0) {
                        $('#messages').append(renderOutgoingMessage(item));
                    }

                    if (item.seller == 1){
                        $('#messages').append(renderIncomingMessage(item));
                    }
                })
                $('#messages').animate({scrollTop: $('#messages')[0].scrollHeight});
            };
            load();
        });
    }

    function renderOutgoingMessage(item) {
        let time = new Date(item.created);
        time = `${time.getHours()}:${time.getMinutes() < 10 ? '0' : ''}${time.getMinutes()}`;
        var file = item.file;
        var ext = file.substr((file.lastIndexOf('.') +1));


        if(item.message == "") {
            if(ext == 'jpg' || ext == 'png' || ext == 'jpeg') {
                return `<div class="outgoing sent_msg enlarge" >
                    <img data-enlargable src="/files/${item.file}" style="width: 100%; height: 450px; cursor: zoom-in;"><span class="time_date">${time}</span>
                    <a href="/files/${item.file}"><i class="fas fa-expand"></i></a>
                    </div>`
            }

            if (ext == 'pdf' || ext == 'txt' || ext == 'doc' || ext == 'docx' || ext == 'xlsx') {
                return `<div class="outgoing sent_msg"><a href="/files/${item.file}" style="color: #000d1a;">${item.file}</a><span class="time_date">${time}</span></div>`
            }

            if (ext == 'mp4') {
                return `<div class="outgoing sent_msg">
                    <video height="250px" width="250px" controls>
                    <source src="/files/${item.file}" type="video/mp4">
                    </video><span class="time_date">${time}</span>
            </div>`
            }

            if (ext == 'mp3') {
                return `<div class="outgoing sent_msg">
                        <audio height="400px" width="900px" controls style="margin: 10px 0 20px 5px;">
                    <source src="/files/${item.file}" type="audio/mpeg">
                    </audio><span class="time_date">${time}</span>
                </div>`
            }
        }else {
            return `<div class="outgoing sent_msg"><p>${item.message}</p><span class="time_date">${time}</span></div>`;
        }

    }


    function renderIncomingMessage(item) {
        let time = new Date(item.created);
        time = `${time.getHours()}:${time.getMinutes() < 10 ? '0' : ''}${time.getMinutes()}`;
        var file = item.file;
        var ext = file.substr((file.lastIndexOf('.') +1));


        if(item.message == "") {
            if(ext == 'jpg' || ext == 'png' || ext == 'jpeg') {
                return `<div class="incoming recieved_msg" >
            <img data-enlargable style="width: 100%; height: 450px; cursor: zoom-in;" src="/files/${item.file}"><span class="time_date">${time}</span>
             <a href="/files/${item.file}"><i class="fas fa-expand"></i></a>
            </div>`
            }

            if (ext == 'pdf' || ext == 'txt' || ext == 'doc' || ext == 'docx' || ext == 'xlsx') {
                return `<div  class="incoming recieved_msg" style="margin: 10px 0 20px 5px;"><a href="/files/${item.file}" style="color: #000d1a;">${item.file}</a></div><span class="time_date">${time}</span>`
            }

            if (ext == 'mp4') {
                return `<div class="incoming recieved_msg">
                    <video height="250px" width="250px" controls style="margin: 10px 0 20px 5px;">
                    <source src="/files/${item.file}" type="video/mp4">
                    </video><span class="time_date">${time}</span>
            </div>`
            }

            if (ext == 'mp3') {
                return `<div class="incoming recieved_msg">
                        <audio height="400px" width="400px" controls style="margin: 10px 0 20px 5px;">
                    <source src="/files/${item.file}" type="audio/mpeg">
                    </audio><span class="time_date">${time}</span>
                </div>`
            }
        }else {
            return `<div class="incoming recieved_msg"><p>${item.message}</p><span class="time_date">${time}</span></div>`;
        }

    }

    function checkPresence() {
        $('#seller-presence').remove();
        $('#buyer-presence').remove();

        $.get(url, function (result) {
            var seller_last_seen = result.seller_time;
            var buyer_last_seen = result.buyer_time;

            if (seller_last_seen > 15){
                $('#seller-presence').append("Offline");
                $('#seller-indicator').css('background-color', '#c3c3c3');
            }else{
                $('#seller-presence').append("Online");
                $('#seller-indicator').css('background-color', 'green');
            }

            if (buyer_last_seen > 15){
                $('#buyer-presence').append("Offline");
                $('#buyer-indicator').css('background-color', '#c3c3c3');
            }else{
                $('#buyer-presence').append("Online");
                $('#buyer-indicator').css('background-color', 'green');
            }
        })

    }




</script>

</body>
</html>
