Amplitude.init({
        songs: [
            {
            url: "/song/find/1",
        }
        ]
});
var playlists = [], run_count = 0;

$(document).ready(function () {
    $('.song').remove();

   loadSongs();

    $(document).on("click", ".play-song", function () {
            var index =  $(".play-song").index(this);
                Amplitude.playSongAtIndex(index + 1);
    });

    $(document).on("click", ".song-title", function () {
        var song_title = $(this).text().toLowerCase().replace(/\s/g, "-");
        var song_index =  $(".song-title").index(this) + 1;
        $('#content-holder').text('');

        $.ajax({
            type: "GET",
            url: "/song/" +song_title,
            data: {
                song_index: song_index,
            },
            success: function (response) {
                console.log(response)
                Amplitude.playSongAtIndex(response.index);

                $('#content-holder').append(`
            <button class="skip-back amplitude-skip-to" data-amplitude-song-index="${response.index}">10</button>
            <button class="amplitude-play-pause">Play Song</button>
            <input type="range" class="amplitude-song-slider" data-amplitude-song-index="${response.index}" />
            <button class="skip-to amplitude-skip-to" data-amplitude-song-index="${response.index}">30</button>
        `)

                $(document).on("click", '.skip-back',  function () {
                    Amplitude.skipTo(Amplitude.getSongPlayedSeconds() - 10,  response.index);
                });

                $(document).on("click", '.skip-to',  function () {
                    Amplitude.skipTo(Amplitude.getSongPlayedSeconds() + 30,  response.index);
                });

                Amplitude.bindNewElements();
            }
        })

    });




    $(document).on("click", ".pause-song", function () {
        Amplitude.pause();
    })

    $(document).on("click", ".create-playlist", function () {
        $('#content-holder').text('');

        $('#content-holder').append(`
        <form method="post" id="create-playlist" data-route="/create/playlist">
            <div class="form-group">
            <label for="playlist-name" class="col-md-3 col-form-label">Playlist name</label>
                <div class="col-md-9">
                       <input type="text" id="playlist-name" name="playlist-name" class="form-control">
                </div>
            </div>

                <div class="form-group">
            <label for="add-new-song" class="col-md-3 col-form-label">Add Song</label>
                <div class="col-md-9 d-flex">
                       <input type="text" id="add-new-song" name="add_new_song" class="form-control w-85">
                       <button id="add-song" class="btn btn-secondary ml-1">Add</button>
                </div>
                <div class="show-songs"></div>
            </div>
            <div class="songs-added ml-2 mb-3 col-md-12 d-flex"></div>

            <button type="submit" id="playlist-submit-button" class="btn btn-primary ml-3">Create Playlist</button>
        </form>
        `)
    })

    $(document).on("keyup", "#add-new-song", function () {
        if ($(this).val().length >= 3){
            $('.song-results').remove();
            $('.danger-class').remove();
            $.ajax({
                type: "GET",
                url: "/find/song",
                data: {
                    add_new_song: $(this).val(),
                },
                success: function (response) {
                    console.log(response.songs.length);
                    if (response.songs.length == 0){
                        $('.show-songs').append(`
                             <div class="alert alert-danger danger-class">
                                <p>Song not found</p>
                            </div>
                             `);
                    }else{
                        for (var i = 0; i < response.songs.length; i++){
                                $('.show-songs').append(`
                                <div class="song-results">
                                   <p><span class="search-title"><b>${response.songs[i].name}</b></span> by <b>${response.songs[i].artist}</b></p>
                                </div>
                                `);
                             }
                    }
                        // //
                }
            })


        }
    })

    $(document).on("click", ".song-results", function () {
        var index = $(this).find("span").text();


        $('#add-new-song').val(index);
        $('.song-results').remove();
    });

    $(document).on("click", "#add-song", function (e) {
        e.preventDefault();

        if($('#add-new-song').val() == "" || $('#add-new-song').val().length < 3 || $('.show-songs').text() == "Song not found"){
            return false;
        }else{
            $('.songs-added').append(`
            <div class="appended-song mr-2 d-flex"><span class="appended-song-name">${$('#add-new-song').val()}</span>
             <span class="delete-selection">X</span></div>
            `)


            $('#add-new-song').val("");
        }
    })

    $(document).on("click", ".delete-selection", function () {
        var delete_selection = $('.delete-selection').index(this);
        $('.appended-song').eq(delete_selection).remove();
    })

    $(document).on("click", "#playlist-submit-button", function (e) {
        e.preventDefault();

        if ($('#playlist-name').val() == "" || $('#playlist-name').val().length < 3
            || $('.songs-added').text() == "" ||  $('.show-songs').text() == "Song not found") {
            return false;
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/playlist/create",
                data: {
                    playlist_name: $('#playlist-name').val(),
                },
            })

            for (var i  = 0; i < $('.appended-song-name').length; i++) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/playlist/add",
                    data: {
                        playlist_name: $('#playlist-name').val(),
                        song_name: $('.appended-song-name').eq(i).text(),
                    }
                })
            }

        $('.songs-added').text("");
        $('.songs-added').append(`
                <div class="alert alert-success">Playlist Created</div>
        `);

            setTimeout(function () {
                    $('#content-holder').text('');
                    loadSongs()
                    }, 1500)
        }
    })

    $(document).on("click", ".view-playlist", function () {
        $('#content-holder').text("");

        viewPlaylist();
    })

    $(document).on("click", ".playlist-name", function () {
       var playlist = $(this).text();
       var playlist_object = playlist.toLowerCase().replace(/\s/g, "_");
       $('#content-holder').text("");


       $.ajax({
           url: "/playlist/" + playlist,
           method:  "GET",
           success:  function (response) {
               Amplitude.addPlaylist(playlist_object, { "playlist_key" : playlist}, [{
                   "name": response[0].name,
                   "artist": response[0].artist,
                   "album": response[0].album,
                   "url":  "/song/find/" + response[0].id,
                   "cover_art_url": "/storage/cover_art/" + response[0].cover_art
               }]);

                var playlist_index = playlists.indexOf(playlist);
                console.log(playlist_index);

               $('#content-holder').append(`
                            <div class="mb-3 d-flex" align="center"><button id="go-back" class="go-back btn btn-dark mb-3 float-left">Back</button>
                             <div class="control-buttons ml-1">
                                <button class="btn btn-primary mr-2 amplitude-play" data-amplitude-playlist="${playlist_index}">Play All</button>
                                <button class="btn btn-secondary mr-2 amplitude-pause" data-amplitude-playlist="${playlist_object}">Pause</button>
                                <button class="btn btn-dark mr-2 amplitude-shuffle" data-amplitude-playlist="${playlist_object}">Shuffle</button>
                        </div>
                        </div>

                        `);

               Amplitude.bindNewElements();

               for (var i = 0;  i < response.length; i++)  {
                   var  index = i+1;
                   if (index != response.length){
                       Amplitude.addSongToPlaylist({
                           "name": response[index].name,
                           "artist": response[index].artist,
                           "album": response[index].album,
                           "url":  "/song/find/" + response[index].id,
                           "cover_art_url": "/storage/cover_art/" + response[index].cover_art
                       }, playlist_object)
                   }

                   $('#content-holder').append(`
                        <div class="col-md-12 p-4 song mt-3">
                            <h3 class="song-title">${response[i].name}</h3>
                            <h5>${response[i].artist}</h5>
                            <div style="display: flex;">
                            <button class="btn btn-primary mr-2">Play</button>
                            <button class="btn btn-secondary mr-2">Stop</button>
                            </div>
                        </div>
                    `);
               }
           }
       })
    })

    $(document).on("click", "#go-back", function () {
        $('#content-holder').text("");
        viewPlaylist();
    });

    /*

    $(document).on("click", ".solo-play", function () {
        $(this).toggleClass("is-playing");

        if ($(".solo-play").hasClass("is-playing")){
            Amplitude.pause();

        }else{
            if(Amplitude.getSongPlayedPercentage() == 100)   {
                Amplitude.playSongAtIndex(0);
            }else {
                Amplitude.play();
            }

        }
    })*/
})

function loadSongs() {
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/songs",
        success: function (response) {
            for (var i = 0; i < response.songs.length; i++){
                var song_name = response.songs[i].name;
                var song_index = response.songs[i].id + 1;
                $('#content-holder').append(`
                        <div class="col-md-12 p-4 song">
                            <h3 class="song-title">${song_name}</h3>
                            <h5>${response.songs[i].artist}</h5>
                            <div style="display: flex;">
                            <button class="play-song btn btn-primary mr-2">Play</button>
                            <button class="pause-song btn btn-secondary mr-2">Stop</button>
                            <button class="btn btn-dark">Download</button>
                            </div>
                        </div>
                    `)

                Amplitude.addSong({
                    "name": song_name,
                    "artist": response.songs[i].artist,
                    "album": response.songs[i].album,
                    "url":  "/song/find/" + response.songs[i].id,
                    "cover_art_url": "/storage/cover_art/" + response.songs[i].cover_art,
                })

                Amplitude.bindNewElements();
            }

            $('#content-holder').append(`
                    <div class="col-md-8 mt-5 ml-3">
                                <button class="btn btn-dark create-playlist">Create Playlist</button>
                                 <button class="btn btn-secondary view-playlist ml-2">View Playlists</button>
                         </div>
                `)
        }
    })
}

function viewPlaylist() {
    $.ajax({
        url: "/view/playlist",
        type: "GET",
        success: function (response) {
            console.log(response);
            $('#content-holder').append(`
                    <h2>Playlists</h2>
                    `)

            for (var i = 0; i  < response.length; i++){
                if (run_count  == 0)  {
                    playlists[i] = response[i].playlist_name;
                }
                $('#content-holder').append(`
                    <div class="playlist-name col-md-10 mb-4 mt-1"><h4>${response[i].playlist_name}</h4></div>
                    `)
            }
            run_count = 1;
        }
    })

}




