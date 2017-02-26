<?php 
namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    public function permissions()
    {
        return $this::hasMany('\App\PermissionRole','role_id');
    }
}