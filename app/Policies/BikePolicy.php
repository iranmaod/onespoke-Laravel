<?php

namespace App\Policies;

use App\Models\Bike;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BikePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given bike can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bike  $bike
     * @return bool
     */
    public function update(User $user, Bike $bike)
    {
        return $user->is($bike->user);
    }
}
