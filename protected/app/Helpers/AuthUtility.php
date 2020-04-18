<?php
namespace App\Helpers;

class AuthUtility {

    public static function getRoleName() {
        $role = 'view';  //Can view client
        if (auth()->user()->hasRole('admin')) {
            $role = 'admin'; //Can delete, edit, and view client
        } else if (auth()->user()->hasRole('authorize')) {
            $role = 'authorize'; //Can authorize, delete, edit, and view client
        } else if (auth()->user()->hasRole('inputer')) {
            $role = 'inputer'; //Can delete, edit, and view client
        }
       return $role;
    }

    public static function getPermissionName() {
        $permission = 'view';  //Can view client
        if (auth()->user()->hasPermission('admin')) {
            $permission = 'admin'; //Can delete, edit, and view client
        } else if (auth()->user()->hasPermission('authorize')) {
            $permission = 'authorize'; //Can authorize, delete, edit, and view client
        } else if (auth()->user()->hasPermission('inputer')) {
            $permission = 'inputer'; //Can delete, edit, and view client
        }
       return $permission;
    }
}
