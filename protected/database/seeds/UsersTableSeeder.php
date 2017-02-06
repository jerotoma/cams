<?php

use Illuminate\Database\Seeder;

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
            ->where("level","=",'Super')->get())>0)
        {
            DB::table('users')->insert([
                'full_name' => "System Administrator",
                'username' => 'admin',
                'level' => 'Super',
                'email' => 'chriss.innocent@gmail.com',
                'password' => bcrypt('admin'),
                'status' => 'Active',
            ]);
        }

    }
}
