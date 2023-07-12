<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */

        //Policy determines who can do what with the post resource

        public function delete(User $user, Post $post){
            return $user->id === $post->user_id;
            // Does the user->id match the post->user->id
            // If so then we have permission to delete it
            // We are pulling things out of the model to clear things up

            // Go to app/Providers/AuthServiceProvider.php to configure a policy
            // Then go to PostController destroy method
        }

}
