<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

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
        'full_name',
        'username',
        'password',
        'role_id',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function detachAllRoles() {
        \DB::table('role_user')->where('user_id', $this->id)->delete();
        return $this;
    }

    public function department() {
        return $this->belongsTo('\App\Department');
    }

    public function roles() {
        return $this->belongsToMany('\App\Role', '\App\RoleUser', 'user_id', 'role_id');
    }

    public function userSettings() {
        return $this->hasMany('\App\UserSetting');
    }
}
