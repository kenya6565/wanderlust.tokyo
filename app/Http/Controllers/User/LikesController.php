<?php

namespace App\Http\Controllers\User;

use \App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikesController extends Controller
{
    public function store(Request $request)
    {
        \Auth::user()->like($request->id);
        
        return response()->json([
          'count_likes' => Post::find($request->id)->liking_users()->count(),
        ]);
    }

    public function destroy(Request $request)
    {
        \Auth::user()->unlike($request->id);
        return response()->json([
          'count_likes' => Post::find($request->id)->liking_users()->count(),
        ]);
        
    }
}
