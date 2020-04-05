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
}
