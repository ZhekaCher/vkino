<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function deleteComment()
    {
        if (Auth::id() == request()->user_id)
            DB::delete('DELETE FROM comments WHERE id=' . request()->comment_id);
        return back();
    }
    public function addComment()
    {
        $query = 'INSERT INTO comments (film_id,user_id, text) VALUES ('.request()->film_id.', '.Auth::id().', \''.request()->text.'\')';
        DB::insert($query);
        return back();
    }
}
