<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Zizaco\Entrust\Traits\EntrustUserTrait;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoleAndPermission; // add this trait to your user model

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'user', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function detachAllRoles()
    {
        \DB::table('role_user')->where('user_id', $this->id)->delete();

        return $this;
    }
}
