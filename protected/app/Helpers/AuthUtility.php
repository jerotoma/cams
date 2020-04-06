<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUtility {

    public static function getRoleName() {
        $role = 'view';  //Can view client
        if (Auth::user()->hasRole('admin')) {
            $role = 'admin'; //Can delete, edit, and view client
        } else if (Auth::user()->hasRole('authorize')) {
            $role = 'authorize'; //Can authorize, delete, edit, and view client
        } else if (Auth::user()->hasRole('inputer')) {
            $role = 'inputer'; //Can delete, edit, and view client
        }
       return $role;
    }

    public static function getPermissionName() {
        $permission = 'view';  //Can view client
        if (Auth::user()->hasPermission('admin')) {
            $permission = 'admin'; //Can delete, edit, and view client
        } else if (Auth::user()->hasPermission('authorize')) {
            $permission = 'authorize'; //Can authorize, delete, edit, and view client
        } else if (Auth::user()->hasPermission('inputer')) {
            $permission = 'inputer'; //Can delete, edit, and view client
        }
       return $permission;
    }
}
