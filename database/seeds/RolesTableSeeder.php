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
            1 =>['superadmin',100 ],
            2 => ['admin',60],
            3 => ['owner',50 ],
            4 => ['manager',40 ],
            5  => ['workadmin',30 ],
            6 => ['moderator',20 ],
            8  => ['user',5 ],
            9  => ['unverified',1 ]
        ];

        /*
         * Add Role Items
         *
         */
        foreach ($RoleItems as $key=>$RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem[0])->first();
            if ($newRoleItem === null) {
                DB::table('roles')->insert([
                    'id' => $key,
                    'name'          => $RoleItem[0],
                    'slug'          => $RoleItem[0],
                    'description'   => $RoleItem[0].' role',
                    'level'         => $RoleItem[1],
                ]);
            }
        }

        //choose the default role upon user creation.
      //admin
      

        //choose the default role upon user creation.
         $admin=config('roles.models.defaultUser')::find(2); 
         $root=config('roles.models.defaultUser')::find(1); //superadmin
        //$root=App\User::find(1); //superadmin
        $role = config('roles.models.role')::where('name', '=', 'superadmin')->first(); 
        $root->attachRole($role);
        $role = config('roles.models.role')::where('name', '=', 'admin')->first();
        $root->attachRole($role);
        $admin->attachRole($role);
        $role = config('roles.models.role')::where('name', '=', 'owner')->first(); 
        $root->attachRole($role);
        $role = config('roles.models.role')::where('name', '=', 'manager')->first(); 
        $root->attachRole($role);
        $role = config('roles.models.role')::where('name', '=', 'workadmin')->first(); 
        $root->attachRole($role);
        $role = config('roles.models.role')::where('name', '=', 'moderator')->first(); 
        $root->attachRole($role);
        $role = config('roles.models.role')::where('name', '=', 'worker')->first(); 
        $root->attachRole($role);
        $role = config('roles.models.role')::where('name', '=', 'user')->first(); 
        $root->attachRole($role);
/// owner-----------------------------------csak példa-----
$owner=config('roles.models.defaultUser')::find(12); 
$role = config('roles.models.role')::where('name', '=', 'owner')->first(); 
$owner->attachRole($role);
$role = config('roles.models.role')::where('name', '=', 'manger')->first(); 
$owner->attachRole($role);
$role = config('roles.models.role')::where('name', '=', 'workadmin')->first(); 
$owner->attachRole($role);
//workers--------------------------
$worker1=config('roles.models.defaultUser')::find(20); 
$worker2=config('roles.models.defaultUser')::find(23);
$role = config('roles.models.role')::where('name', '=', 'worker')->first();
$worker1->attachRole($role);
$worker2->attachRole($role);
    }
}
