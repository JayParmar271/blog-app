<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->postId,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json(['comment' => $comment], 200);
    }
}
