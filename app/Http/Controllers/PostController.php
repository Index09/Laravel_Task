<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:20',
        ]);


        $post = post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
        ]);

        $code = 200;

        return response()->json($post,$code  );
    }


    public function ShowUnpublishedPosts()
    {


    }
}
