<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model {

     /**
     * Get the user that owns the userSetting.
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

}
