<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $blog_id)
    {
        $posts = Post::where('blog_id', $blog_id)->get();
        return response()->json(['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3',
            'body' => 'required|string|min:10',
            'blog_id' => 'required|integer'
        ]);

        $post = Post::create([
            'blog_id' => $request->blog_id,
            'body' => $request->body,
            'title' => $request->title
        ]);

        return response()->json(['post' => $post]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['comment', 'likes'])->where('id', $id)->first();
        return response()->json(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['title' => 'required|string', 'body' => 'required|string']);
        $post = Post::where('id', $id)->update([
            'title' => $request->title,
            'body' => $request->body
        ]);
        return response()->json(['message' => 'Post updated', 'post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Record deleted']);
    }
}
