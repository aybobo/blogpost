<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate(['post_id' => 'required']);
        Like::create(['user_id' => auth()->id(), 'post_id' => $request->post_id]);
        return response()->json(['message' => 'Post liked']);
    }
}
