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

        $unpublishedPosts = post::where('is_published','=' , false)->get();

        return response()->json($unpublishedPosts);


    }
    public function accept($id)
    {
        $post = Post::findOrFail($id);
        $post->is_published = 1;
        $post->save();

        return response()->json([
            'message' => 'Post accepted',
        ], 200);
    }

    public function refuse($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => 'Post refused',
        ], 200);
    }
}
