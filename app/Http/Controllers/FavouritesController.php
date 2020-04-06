<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavouritesController extends Controller
{
    public function addFavourite(){
        $query = 'INSERT INTO favourites (film_id,user_id) VALUES ('.request()->film_id.', '.Auth::id().')';
        DB::insert($query);
        return back();
    }

    public function deleteFavourite(){
        DB::delete('DELETE FROM favourites WHERE film_id=' . request()->film_id. ' AND user_id='.Auth::id());
        return back();
    }
}
