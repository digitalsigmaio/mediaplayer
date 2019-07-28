<?php

namespace App\Policies;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function before( Admin $admin, $ability )
    {
        if ($admin->isDeveloper()) return true;
    }

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\Admin $user
     * @param  \App\Admin $admin
     *
     * @return mixed
     */
    public function view( Admin $user, Admin $admin )
    {
        return $user->id == $admin->id;
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\Admin $user
     *
     * @return mixed
     */
    public function create( Admin $user )
    {
        return $user->isSuper();
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\Admin $user
     * @param  \App\Admin $admin
     *
     * @return mixed
     */
    public function update( Admin $user, Admin $admin )
    {
        return $user->id == $admin->id || $admin->isSuper();
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\Admin $user
     * @param  \App\Admin $admin
     *
     * @return mixed
     */
    public function delete( Admin $user, Admin $admin )
    {
        //
    }

    /**
     * Determine whether the user can restore the admin.
     *
     * @param  \App\Admin $user
     * @param  \App\Admin $admin
     *
     * @return mixed
     */
    public function restore( Admin $user, Admin $admin )
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the admin.
     *
     * @param  \App\Admin $user
     * @param  \App\Admin $admin
     *
     * @return mixed
     */
    public function forceDelete( Admin $user, Admin $admin )
    {
        //
    }
}
