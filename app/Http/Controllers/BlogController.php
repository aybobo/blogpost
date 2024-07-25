<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return response()->json(['blogs' => $blogs]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:blogs']);
        $blog = Blog::create(['name' => $request->name]);
        return response()->json(['message' => 'Blog created', 'blog' => $blog]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json(['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $name = $request->validate(['name' => 'required|string']);
        $check_duplicate = Blog::where('name', $name)->first();
        if ($check_duplicate) {
            if ((int)$check_duplicate->id !== (int)$id) {
                return response()->json(['message' => 'Record with same name exist']);
            }
        }

        $blog = Blog::where('id', $id)->update(['name' => $name]);
        return response()->json(['message' => 'Record updated', 'blog' => $blog]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json(['message' => 'Record deleted']);
    }
}
