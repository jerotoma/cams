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

        $inventory= new \App\Role();
        $inventory->name         = 'inventory';
        $inventory->display_name = 'NFIs and Cash Distribution'; // optional
        $inventory->description  = 'Access to inventory'; // optional
        $inventory->save();


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

        $reports = new \App\Permission();
        $reports->name         = 'reports';
        $view->display_name = 'reports'; // optional
        $reports->description  = 'viewer reports'; // optional
        $reports->save();

        $authorze = new \App\Permission();
        $authorze->name         = 'authorize';
        $authorze->display_name = 'Authorize'; // optional
        $authorze->description  = 'Authorize Data imported'; // optional
        $authorze->save();

        $nfis = new \App\Permission();
        $nfis->name         = 'inventory';
        $nfis->display_name = 'inventory'; // optional
        $nfis->description  = 'Access to NFIs Inventory '; // optional
        $nfis->save();

        $delete = new \App\Permission();
        $delete->name         = 'delete';
        $delete->display_name = 'delete'; // optional
        $delete->description  = 'delete Data'; // optional
        $delete->save();

        $backup = new \App\Permission();
        $backup->name         = 'backup';
        $backup->display_name = 'backup'; // optional
        $backup->description  = 'Access to data export and import'; // optional
        $backup->save();

        $admin->attachPermissions(array($create, $edit,$view,$delete,$authorze,$reports,$nfis,$backup));
        $inputer->attachPermissions(array($create, $edit,$view,$delete,$nfis,$backup));
        $authorizer->attachPermissions(array($authorze,$edit,$view,$delete,$nfis));
        $viewer->attachPermissions(array($view,$reports));
        $inventory->attachPermissions(array($create, $edit,$view,$delete,$nfis,$backup));

        $user = \App\User::where('username', '=', 'admin')->first();
        $user->attachRole($admin);
    }
}
