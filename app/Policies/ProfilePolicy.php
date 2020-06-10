<?php

namespace App\Policies;

use App\Profile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Profile $profile)
    {
        return $user->id == $profile->user_id;
    }

    public function update(User $user, Profile $profile)
    {
        return $user->id == $profile->user_id;
    }

    public function destroy(User $user, Profile  $profile)
    {
        return $user->id == $profile->user_id;
    }
}
