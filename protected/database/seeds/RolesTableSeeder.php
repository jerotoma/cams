<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $RoleItems = [
            [
                'name'        => 'Unverified',
                'slug'        => 'unverified',
                'description' => 'Unverified Role',
                'level'       => 0,
            ],
            [
                'name'        => 'User',
                'slug'        => 'user',
                'description' => 'User Role',
                'level'       => 1,
            ],

            [
                'name'        => 'Inputer',
                'slug'        => 'inputer',
                'description' => 'User for inputing data to the system',
                'level'       => 2,
            ],
            [
                'name'        => 'Viewer',
                'slug'        => 'viewer',
                'description' => 'User for viewing data',
                'level'       => 3,
            ],
            [
                'name'        => 'Authorizer',
                'slug'        => 'authorizer',
                'description' => 'User for Authorize data',
                'level'       => 4,
            ],
            [
                'name'        => 'Inventory',
                'slug'        => 'inventory',
                'description' => 'Access to inventory',
                'level'       => 5,
            ],
            [
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Super System Administrator',
                'level'       => 6,
            ],
        ];

        /*
         * Add Role Items
         *
         */
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem['slug'])->first();
            if ($newRoleItem === null) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'          => $RoleItem['name'],
                    'slug'          => $RoleItem['slug'],
                    'description'   => $RoleItem['description'],
                    'level'         => $RoleItem['level'],
                ]);
            }
        }
    }
}
