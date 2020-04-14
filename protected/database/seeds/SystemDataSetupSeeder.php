<?php

use Illuminate\Database\Seeder;
use App\UserSetting;
use App\ClientSetting;
use App\User;
use App\Client;

use App\Helpers\SystemConstant;

class SystemDataSetupSeeder extends Seeder {
    public function run() {
        $this->runSytemDataSetup();
    }

    private function runSytemDataSetup() {
        User::chunk(100, function($users){
            foreach($users as $user) {
               if(!UserSetting::where('user_id', '=', $user->id)->where('setting_key', '=', SystemConstant::SIDE_BAR_OPEN_CLOSE_STATUS)->exists()) {
                    UserSetting::create([
                        'user_id' => $user->id,
                        'setting_key' => SystemConstant::SIDE_BAR_OPEN_CLOSE_STATUS,
                        'setting_value' => true,
                    ]);
               }
            }
        });
    }
}
