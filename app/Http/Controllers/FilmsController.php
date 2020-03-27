<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use Illuminate\Support\Facades\DB;

class FilmsController extends Controller
{
    public function index(Request $request)
    {
        $genre = $request['genre'];
        $films = array();
        if ($genre != null) {
            $films = DB::table('films')
                ->join('films_genres', 'films.id', '=', 'films_genres.film_id')
                ->join('genres', 'films_genres.genre_id', '=', 'genres.id')
                ->select('films.*')
                ->where('genres.value', '=', $genre)->paginate(5);
            $films->withPath('/films?genre='.$genre);
        }

        else
            $films = Film::paginate(5);
        return view('films.index', compact('films'));
    }

    public
    function indexByGenre($genre)
    {
        $films = Film::all();
        return $genre;

//        return view('films.index', compact('films'));
    }


    public
    function show(Request $request, $filmId)
    {
        $film = DB::table('films')->find($filmId);
        if ($film == null)
            return view('error')->with('errorMessage', 'This film doesn\'t exists');
//        $film = DB::table('films')->where('film_id'==$filmId);
        return view('films.show')->with('film', $film);
    }
}
