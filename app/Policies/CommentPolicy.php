<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{

        // /**
    //  * Determine whether the user can view any models.
    //  */
    // public function before(User $user, $ability): bool {
    //     if($user->isAdmin()) {
    //         return true;
    //     }
    //     else {
    //         return false;
    //     }
    // }

    /**

     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): bool
    {
        if($user->id == $comment->user_id) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {
        if($user->id == $comment->user_id || $user->id == $comment->post->user_id) {
            return true;
        }
        else {
            return false;
        }
    }
}
