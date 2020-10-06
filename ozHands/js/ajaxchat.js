var start = 0, url = 'http://localhost/message.php', sender = $('#sender').text(), wholesaler = $('#wholesaler').text(),
    buyer = $('#buyer').text(), table = $('#table').text(),data, input;


$(document).ready(function () {
        setInterval(checkPresence, 1000);

   if (performance.navigation.type == performance.navigation.TYPE_RELOAD){
       console.log("Reloaded");
   }else {
       if($('#order').text() != null) {

           $.post(url, {
               message: $('#order').text(),
               from: sender,
               wholesaler: wholesaler,
               buyer: buyer,
               table: table,
           });
       }
   }


    load();

    $('#file').change(function () {
        input = $('#file')[0].files[0];
        data = new FormData();
        data.append('file', input);
        data.append('table', table);

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
                wholesaler: wholesaler,
                buyer: buyer,
                table: table,
            });

            $('#message').val('');
            return false;
    })
});

function load() {
    $.get(url + '?start=' + start +'&table=' +table, function (result) {
        if(result.items) {
            result.items.forEach(item => {
                start = item.id;
                    $('#messages').append(renderIncomingMessage(item));
            })
            $('#messages').animate({scrollTop: $('#messages')[0].scrollHeight});
        };
        load();
    });
}

function renderIncomingMessage(item) {
    let time = new Date(item.created);
    time = `${time.getHours()}:${time.getMinutes() < 10 ? '0' : ''}${time.getMinutes()}`;
    var file = item.file;
    var ext = file.substr((file.lastIndexOf('.') +1));


    if(item.message == "") {
       if(ext == 'jpg' || ext == 'png' || ext == 'jpeg') {
           return `<div class="incoming recieved_msg" >
        <h4>${item.from}</h4>
            <img data-enlargable style="width: 450px; height: 450px; cursor: zoom-in;" src="/files/${item.file}"><span class="time_date">${time}</span>
             <a href="/files/${item.file}"><i class="fas fa-expand"></i></a>
            </div>`
       }

       if (ext == 'pdf' || ext == 'txt' || ext == 'doc' || ext == 'docx' || ext == 'xlsx') {
           return `<div  class="incoming recieved_msg" style="margin: 10px 0 20px 5px;"><h4>${item.from}</h4><a href="/files/${item.file}" style="color: #000d1a;">${item.file}</a></div><span class="time_date">${time}</span>`
       }

       if (ext == 'mp4') {
           return `<div class="incoming recieved_msg">
                        <h4>${item.from}</h4>
                    <video height="250px" width="250px" controls style="margin: 10px 0 20px 5px;">
                    <source src="/files/${item.file}" type="video/mp4">
                    </video><span class="time_date">${time}</span>
            </div>`
       }

        if (ext == 'mp3') {
            return `<div class="incoming recieved_msg">
                    <h4>${item.from}</h4>
                        <audio height="400px" width="400px" controls style="margin: 10px 0 20px 5px;">
                    <source src="/files/${item.file}" type="audio/mpeg">
                    </audio><span class="time_date">${time}</span>
                </div>`
        }
    }else {
        return `<div class="incoming recieved_msg"><h4>${item.from}</h4><p>${item.message}</p><span class="time_date">${time}</span></div>`;
    }

}

function checkPresence() {
    $('#seller-presence').remove();
    $('#buyer-presence').remove();

    $.get(url + '?table=' +table, function (result) {
        var seller_last_seen = result.seller_time;
        var buyer_last_seen = result.buyer_time;

        if (seller_last_seen > 15 || seller_last_seen == 0){
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


