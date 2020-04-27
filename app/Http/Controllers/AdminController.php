<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function deleteFilm(){
        if (Auth::id()==4)
            DB::delete('DELETE FROM films_genres WHERE film_id=' . request()->film_id);
            DB::delete('DELETE FROM films WHERE id=' . request()->film_id);
        return back();
    }
}
