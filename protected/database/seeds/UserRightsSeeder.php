<?php

use Illuminate\Database\Seeder;

class UserRightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $inputer = new \App\Role();
        $inputer->name         = 'inputer';
        $inputer->display_name = 'Inputer'; // optional
        $inputer->description  = 'User for inputing data to the system'; // optional
        $inputer->save();

        $viewer = new \App\Role();
        $viewer->name         = 'viewer';
        $viewer->display_name = 'Viewer'; // optional
        $viewer->description  = 'User for viewing data'; // optional
        $viewer->save();

        $authorizer = new \App\Role();
        $authorizer->name         = 'authorizer';
        $authorizer->display_name = 'Authorizer'; // optional
        $authorizer->description  = 'User for Authorize data'; // optional
        $authorizer->save();

        $admin = new \App\Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Administrator'; // optional
        $admin->description  = 'Super System Administrator'; // optional
        $admin->save();


        //Create permissions
        $create = new \App\Permission();
        $create->name         = 'create';
        $create->display_name = 'Create'; // optional
        $create->description  = 'create'; // optional
        $create->save();

        $edit = new \App\Permission();
        $edit->name         = 'edit';
        $edit->display_name = 'Edit'; // optional
        $edit->description  = 'Update and modify data'; // optional
        $edit->save();

        $view = new \App\Permission();
        $view->name         = 'viewer';
        $view->display_name = 'Viewer'; // optional
        $view->description  = 'viewer data only'; // optional
        $view->save();

        $authorze = new \App\Permission();
        $authorze->name         = 'authorize';
        $authorze->display_name = 'Authorize'; // optional
        $authorze->description  = 'Authorize Data imported'; // optional
        $authorze->save();

        $delete = new \App\Permission();
        $delete->name         = 'delete';
        $delete->display_name = 'delete'; // optional
        $delete->description  = 'delete Data'; // optional
        $delete->save();

        $admin->attachPermissions(array($create, $edit,$view,$delete,$authorze));
        $inputer->attachPermissions(array($create, $edit,$view,$delete));
        $authorizer->attachPermissions(array($view,$authorze));
        $viewer->attachPermissions(array($view));

        $user = \App\User::where('username', '=', 'admin')->first();
        $user->attachRole($admin);
    }
}
