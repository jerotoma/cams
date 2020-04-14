<?php
namespace App\Helpers;

use App\UserSetting;

class SystemConfig {

    public static function getUserSettingByUserIdAndKey($userId, $settingKey) {
        if (!is_numeric($userId)) {
            return null;
        }
        if (!is_string($settingKey)) {
            return null;
        }
        $query = UserSetting::where('user_id', '=', $userId)->where('setting_key', '=', $settingKey);
        if (($query->count() > 0)) {
            return $query->first();
        }
       return null;
    }

}
