<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SongController extends Controller
{
    public function relate()
    {
            $user = User::find(1);
          $playlist = Song::create([
                'name' => 'Will (Remix)',
                'artist' => 'Joyner Lucas ft Will Smith',
                'album' => 'Single',
                'release_year' => '2020',
                'genre' => 'Pop',
                'cover_art' => '2020-05-21-22-25-13--1078945905.jpg',
                'song_file' => 'joyner_lucas_will_smith_will_remix_mp3_31130.mp3'
            ]);

       /* $song_file = $user->playlist()->where('name', 'TestPlaylist')->get();

            for ($i = 0; $i < count($song_file); $i++){
               echo $song_file[$i]['song_id'];
            }*/

       dd($playlist);
    }

    public function get()
    {
        $songs = Song::all();

        return response()->json(['songs' =>  $songs], 200)->withHeaders([
            "Content-Type" => "application/json",
            "Access-Control-Allow-Origin" => "*",
        ]);
    }

    public function show(Request $request)
    {
        $song_name = Str::of($request->route('name'))->replace('-', ' ');
        $song = Song::where('name', $song_name)->get();
        $type = "application/json";
        $range = "bytes 100-1000/*";

        return response()->json(['song' =>  $song, 'index'  => $request->song_index], 200)->withHeaders([
            "Content-Type" => $type,
            "Content-Range" => $range,
            "Access-Control-Allow-Origin" => "*",
        ]);
    }

    public function index()
    {
        return view('songs.index');
    }

    public function find(Request $request)
    {
        $song_id = $request->route('song_id');
        $song_name = \App\Models\Song::where('id', $song_id)->value('song_file');
        $path = "storage/songs/".$song_name;
        $headers = [
            "Content-Range"=> "bytes 100-10000/*",
        ];
        return response()->file($path, $headers);
    }

    public function check(Request $request)
    {
        $search_value = $request->add_new_song;
        $songs = Song::where("name", "like", "{$search_value}%")->get();

        return response()->json(['songs' => $songs], 200);
    }

    public function create(Request $request)
    {
        $playlist_name = $request->playlist_name;
        DB::table('playlist_user')->insert([
            "user_id" => 1,
            "playlist_name" => $playlist_name
        ]);
    }

    public function add(Request $request)
    {
        $song_name = $request->song_name;
        $playlist_name = $request->playlist_name;
        $user = User::find(1);

      $song_id = Song::where("name", $song_name)->value("id");

      $user->playlist()->create([
                "song_id" => $song_id,
                "name" => $playlist_name
      ]);
    }

    public function view()
    {
        $playlists = DB::table('playlist_user')->where('user_id', 1)->get();

        return response()->json($playlists, 200);
    }

    public function playlist(Request $request)
    {
        $playlist = $request->route('playlist');
        $values = Playlist::where('name', $playlist)->get();
        $songarray = [];
        $i = 0;

        foreach ($values as $value) {
            $id = $value->song_id;
            $songs = Song::where('id', $id)->get();

            foreach ($songs as $song){
                $songarray[$i] = $song;
                $i++;
            }
        }

        return response()->json($songarray, 200);
    }
}
