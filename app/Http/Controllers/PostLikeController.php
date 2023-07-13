<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request)
    // Making use of route-model binding
    {
        // dd($post->likedBy($request->user()));
        // To check if a user has liked something, returns true and false

        if ($post->likedBy($request->user())) {
            return response(null, 409);
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
            // 'post_id' => $request->posts()->id,
        ]);
        // We want a user to like a post once, head to post model to add protection

        if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
            // If this post was liked by the user then don't send an email
            // Using soft deletes here

            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }
        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        // Go through the user, into the users_likes realtionship, pluck out using where clause
        // post_id is $post->id and then we use the delete method

        return back();
    }
}
