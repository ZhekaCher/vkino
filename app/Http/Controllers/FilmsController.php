<?php

namespace App\Http\Controllers;

use foo\bar;
use Illuminate\Http\Request;
use App\Film;
use Illuminate\Support\Facades\Auth;
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
                ->orderBy('title')
                ->where('genres.value', '=', $genre)->paginate(5);
            $films->withPath('/films?genre=' . $genre);
            if ($films->isEmpty())
                return view('error')->with('errorMessage', 'This genre doesn\'t exists or page doesn\'t contains any films');
        } else
            $films = Film::paginate(5);
        if ($search != null) {
            $films = Film::whereRaw('LOWER(title) LIKE \'%' . strtolower($search) . '%\'')->get();
        }
        for ($i = 0; $i < count($films); ++$i) {
            $films[$i]->genres = DB::table('films_genres')
                ->join('genres', 'films_genres.genre_id', '=', 'id')
                ->where('films_genres.film_id', '=', $films[$i]->id)
                ->select('id', 'value')->get();
        }
        return view('films.index', compact('films'));
    }

    public function favourites(Request $request)
    {
        if (Auth::guest())
            return redirect('/films');
        $films = DB::table('films')
            ->join('favourites', 'films.id', '=', 'favourites.film_id')
            ->select('films.*')
            ->orderBy('title')
            ->where('favourites.user_id', '=', Auth::id())->paginate(5);
        if ($films->isEmpty())
            return view('error')->with('errorMessage', 'You have no favourites');

        for ($i = 0; $i < count($films); ++$i) {
            $films[$i]->genres = DB::table('films_genres')
                ->join('genres', 'films_genres.genre_id', '=', 'id')
                ->where('films_genres.film_id', '=', $films[$i]->id)
                ->select('id', 'value')->get();
        }
        return view('films.index', compact('films'));
    }


    public function show(Request $request, $filmId)
    {
        $film = DB::table('films')->find($filmId);
        if ($film == null)
            return view('error')->with('errorMessage', 'This film doesn\'t exists');
        $film->genres = DB::table('films_genres')
            ->join('genres', 'films_genres.genre_id', '=', 'id')
            ->where('films_genres.film_id', '=', $filmId)
            ->select('id', 'value')->get();
        $genresIds = array();
        foreach ($film->genres as $genre) {
            array_push($genresIds, $genre->id);
        }
        $film->favourite = false;
        if (!Auth::guest())
            if (!DB::table('favourites')->where('film_id', '=', $filmId)->where('user_id', '=', Auth::id())->get()->isEmpty())
                $film->favourite = true;
        $film->comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.film_id', '=', $filmId)
            ->select('text', 'rating', 'relevance', 'name', 'users.id as user_id', 'comments.id as comment_id')->get();
        $relatedFilms = DB::table('films')
            ->join('films_genres', 'id', '=', 'film_id')
            ->whereIn('films_genres.genre_id', $genresIds)
            ->where('films.id', '!=', $filmId)
            ->distinct('id')
            ->select('id', 'title', 'description')
            ->get();
        for ($i = 0; $i <count($film-> comments); ++$i){
            $film->comments[$i]->likes= DB::table('likes')->join('users','users.id','=','likes.user_id')->where('likes.comment_id', '=',$film->comments[$i]->comment_id)->select('likes.user_id', 'users.name')->orderByDesc('likes.relevance')->get();
            $film->comments[$i]->userLike= DB::table('likes')->where('likes.comment_id', '=',$film->comments[$i]->comment_id)->where('likes.user_id', '=',Auth::id())->select('likes.user_id')->get();
        }
        $film->relatedFilms = array();
        $relatedFilms = $relatedFilms->shuffle();
        for ($i = 0; $i < 5; ++$i) {
            $relatedFilms[$i]->genres = DB::table('films_genres')
                ->join('genres', 'films_genres.genre_id', '=', 'id')
                ->where('films_genres.film_id', '=', $relatedFilms[$i]->id)
                ->select('id', 'value')->get();
            array_push($film->relatedFilms, $relatedFilms[$i]);
        }
//        $film-> relatedFilms= $relatedFilms;
        return view('films.show')->with('film', $film);
    }
}
