<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function ActionToPost($id , request $request)
    {
        $action = $request->query('action');
        $post = Post::findOrFail($id);
        if( $action == 'accept'){
 
            $post->is_published = 1;
            $post->save();
            return response()->json([
                'message' => 'Post accepted',
            ], 200);

        }else {

            $post->delete();
            return response()->json([
                'message' => 'Post refused',
            ], 200);
        }

    }


    public function getUserPosts(Request $request)
    {
        $filter = $request->query('filter');

        if ($filter === 'me') {
            $user = Auth::user();
            $userPosts = Post::where('user_id', $user->id)->get();

            return response()->json($userPosts);
        }

        $posts = Post::all();

        return response()->json($posts);
    }
}
