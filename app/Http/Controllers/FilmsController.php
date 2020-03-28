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
        $search = $request['search'];
        $films = array();
        if ($genre != null) {
            $films = DB::table('films')
                ->join('films_genres', 'films.id', '=', 'films_genres.film_id')
                ->join('genres', 'films_genres.genre_id', '=', 'genres.id')
                ->select('films.*')
                ->where('genres.value', '=', $genre);
            $films->withPath('/films?genre=' . $genre);
            if ($films->isEmpty())
                return view('error')->with('errorMessage', 'This genre doesn\'t exists or page doesn\'t contains any films');
        } else
            $films = Film::paginate(5);
        if ($search != null){
            $films = Film::whereRaw('LOWER(title) LIKE \'%'.strtolower($search).'%\'')->get();
        }
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
        $film->genres = DB::table('films_genres')
            ->join('genres', 'films_genres.genre_id', '=', 'id')
            ->where('films_genres.film_id', '=', $filmId)
            ->select('value')->get();
        $film->comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.film_id', '=', $filmId)
            ->select('text', 'rating','relevance','name', 'users.id')->get();
        if ($film == null)
            return view('error')->with('errorMessage', 'This film doesn\'t exists');
//        $film = DB::table('films')->where('film_id'==$filmId);
        return view('films.show')->with('film', $film);
    }
}
