<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentsController extends Controller
{
    public function deleteComment()
    {
        if (Auth::id() == request()->user_id or Auth::id()==4) {
            DB::delete('DELETE FROM likes WHERE comment_id=' . request()->comment_id);
            DB::delete('DELETE FROM comments WHERE id=' . request()->comment_id);
        }
        return back();
    }
    public function addComment()
    {
        $unavaliableWords = ['bad', 'error'];
        foreach($unavaliableWords    as $word){
            if (Str::contains(request()->text, $word)){
                return view('error')->with('errorMessage', 'You can not post such messages');
            }
        }
        $query = 'INSERT INTO comments (film_id,user_id, text) VALUES ('.request()->film_id.', '.Auth::id().', \''.request()->text.'\')';
        DB::insert($query);
        return back();
    }
}
