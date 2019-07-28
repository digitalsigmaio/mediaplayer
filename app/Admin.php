<?php

namespace App;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'email', 'password', 'role_id' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token', ];

    protected $with = [ 'role' ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [ 'email_verified_at' => 'datetime', ];

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification( $token )
    {
        $this->notify( new AdminResetPasswordNotification( $token ) );
    }

    public function role()
    {
        return $this->belongsTo( Role::class );
    }

    /**
     * @return bool
     */
    public function isDeveloper(): bool
    {
        return $this->role_id == 1;
    }

    /**
     * @param Admin $admin
     *
     * @return bool
     */
    public function isSuperior( Admin $admin ): bool
    {
        return $this->role_id < $admin->role_id;
    }

    public function isSuper(): bool
    {
        return $this->role_id < 3;
    }

    // @todo refactor the app to creatable project
}
