<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with(['comments.user'])->get();
        $userId = auth()->user()->id;

        return response()->json(['posts' => $posts, 'userId' => $userId], 200);
    }

    public function edit(Post $post)
    {
        $post = Post::findOrFail($post->id);

        return response()->json(['post' => $post], 200);
    }

    public function show(Post $post)
    {
        $post = Post::with(['comments.user'])->findOrFail($post->id);

        return response()->json(['post' => $post], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:25500',
            'category' => 'required',
            'image' => 'required',
        ]);

        $imageName = time() .'.' .$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        $slug = Str::slug($request->title);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $slug,
            'image' => env('APP_URL') . '/images/' . $imageName,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json(['post' => $post], 200);
    }

    public function update(Request $request, Post $post)
    {
        if (! Gate::allows('update-post', $post)) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:25500',
            'category' => 'required',
        ]);

        $post = Post::find($post->id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category;

        if (! empty($request->image)) {
            $imageName = time() .'.' .$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = env('APP_URL') . '/images/' . $imageName;
        }

        $post->save();

        return response()->json(['post' => $post]);
    }
}
