<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(!count(\App\User::where("full_name","=","System Administrator")
            ->where("full_name","=","System Administrator")
            ->where("username","=",'admin')
            ->where("level","=",'Super')->get())>0) {
            factory(App\User::class, 1)->create()->each(function ($user) {
                $role = config('roles.models.role')::where('name', '=', 'Admin')->first();  //choose the default role upon user creation.
                $user->attachRole($role);
            });
        }

    }
}
