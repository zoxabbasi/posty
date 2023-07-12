<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::get();
        // This will return all the posts in the natural database order
        // This will be a laravel collection
        // Idealy we don't want to do this, as this will grab everthing from the database, use paginate instead

        $posts = Post::orderBy('created_at', 'desc')->with(['user', 'likes'])->paginate(20);
        // This is pull the posts in descending order of created_at
        // Eager loading the realationship of post, user and likes
        // To display the rest of the posts, we use links() under the iteration in index.blade.php


        return view('posts.index', ['posts' => $posts]);
        // Passing posts as an array in the view
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        // Post::create([
        //     // 'user_id' => auth()->user()->id
        //     'user_id' => auth()->id,
        //     'body' => $request->body,
        // ]);

        // auth()->user()->posts()->create

        $request->user()->posts()->create([
            'body' => $request->body,
            // Using this syntax, laravel will automatically fill in the user_id column for us
        ]);

        return redirect()->back();
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        // Shorthand authorize method
        $post->delete();

        return back();
    }
}
