<?php

namespace Tests;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param Authenticatable|null $user
     * @return $this
     */
    protected function signIn(Authenticatable $user = null)
    {
        \App\Role::insert(config('admin-roles'));
        $user = $user ?: factory('App\Admin')->create();
        $this->actingAs($user, 'admin');

        return $this;
    }
}
