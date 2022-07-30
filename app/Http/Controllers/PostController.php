<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return response()->json(['posts' => $posts], 200);
    }

    public function update(Request $request, Post $post)
    {
        if (! Gate::allows('update-post', $post)) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $post = Post::find($post->id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->save();

        return response()->json(['post' => $post]);
    }
}
