<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class AttachmentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user) 
    {
        return $user->isAdmin();
    }

    public function delete(User $user) 
    {
        return $user->isAdmin();
    }

    public function uploadAttachment(User $user, Task $task): bool
    {
        return $user->id == $task->user_id;
    }
}
