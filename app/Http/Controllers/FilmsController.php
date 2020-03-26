<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use Illuminate\Support\Facades\DB;

class FilmsController extends Controller
{
    public function index(){
        $films = Film::all();
        return view('films.index', compact('films'));
    }


    public function show(Request $request, $filmId){
        $film = DB::table('films')->find($filmId);
        if ($film == null)
            return view('error')->with('errorMessage', 'This film doesn\'t exists');
//        $film = DB::table('films')->where('film_id'==$filmId);
        return view('films.show')->with('film', $film);
    }
}
