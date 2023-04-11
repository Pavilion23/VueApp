<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(5);               //Get the Posts
        return PostResource::collection($posts);  //Return collections Post as a resource
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = $request->isMethod('put') ? Post::findOrFail($request->id) : new Post;
        $post->id    = $request->input('id');
        $post->title = $request->input('title');
        $post->body  = $request->input('body');

        if ($post->save()) {
            return new PostResource($post);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);   //Get one Post
        return new PostResource($post);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->delete()) {
            return new PostResource($post);
        }
    }
}
