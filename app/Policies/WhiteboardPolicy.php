<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Whiteboard;
use Illuminate\Auth\Access\Response;

class WhiteboardPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // handled within the controller
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Whiteboard $whiteboard): bool
    {
        return $whiteboard->user_id === $user->id
            || $whiteboard->participants->contains($user->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Whiteboard $whiteboard): bool
    {
        return $whiteboard->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Whiteboard $whiteboard): bool
    {
        return $whiteboard->user_id === $user->id;
    }
}
