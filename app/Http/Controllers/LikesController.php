<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
{
    public function deleteLike()
    {
        DB::delete('DELETE FROM likes WHERE comment_id=' . request()->comment_id . ' and user_id=' . Auth::id());
        return back();
    }

    public function addLike()
    {
        $query = 'INSERT INTO likes (comment_id, user_id) VALUES (' . request()->comment_id . ', ' . Auth::id() . ')';
        DB::insert($query);
        return back();
    }
}
