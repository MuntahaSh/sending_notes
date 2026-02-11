<?php

namespace App\Policies;

use App\Models\Notes;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Notes $notes): bool
    {
        return ($user->id == $notes->user_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Notes $notes): bool
    {

        return ($user->id == $notes->user_id && $notes->send_date >= date('Y-m-d'));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Notes $note): bool
    {
        return ($user->id == $note->user_id);   //user = user owns this note/ only autharized user can delete the notes
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Notes $notes): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Notes $notes): bool
    {
        return false;
    }
}
