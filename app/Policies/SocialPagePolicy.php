<?php

namespace App\Policies;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class SocialPagePolicy
{
    use HandlesAuthorization;

    public function update(Admin $admin)
    {
        return $admin instanceof Admin;
    }
}
