<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the ad can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the ad can view the model.
     */
    public function view(User $user, Ad $model): bool
    {
        return true;
    }

    /**
     * Determine whether the ad can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the ad can update the model.
     */
    public function update(User $user, Ad $model): bool
    {
        return true;
    }

    /**
     * Determine whether the ad can delete the model.
     */
    public function delete(User $user, Ad $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the ad can restore the model.
     */
    public function restore(User $user, Ad $model): bool
    {
        return false;
    }

    /**
     * Determine whether the ad can permanently delete the model.
     */
    public function forceDelete(User $user, Ad $model): bool
    {
        return false;
    }
}
