<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer',
            'comment' => 'required|string'
        ]);

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'comment' => $request->comment,
            'user_id' => auth()->id
        ]);

        return response()->json(['comment' => $comment]);
    }
}
