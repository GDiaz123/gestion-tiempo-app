<?php

namespace App\Policies;

use App\Models\Tarea;
use App\Models\User;

class TareaPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Tarea $tarea): bool
    {
        return true;
    }

    public function update(User $user, Tarea $tarea): bool
    {
        return true;
    }

    public function delete(User $user, Tarea $tarea): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }
}
