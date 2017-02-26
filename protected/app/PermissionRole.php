<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    //
    protected $table = 'permission_role';

    public function role()
    {
        return $this::belongsTo('\App\Role','role_id');
    }
    public function permission()
    {
        return $this::belongsTo('\App\Permission','permission_id');
    }

}
