<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
//use Database\Seeds\PermissionsTableSeeder;
//use Database\Seeds\RolesTableSeeder;
//use Database\Seeds\ConnectRelationshipsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        config(['roles.defaultSeeds.RolesTableSeeder'=>false]);
        config(['roles.defaultSeeds.PermissionsTableSeeder'=>false]);
        config(['roles.defaultSeeds.ConnectRelationshipsSeeder'=>false]);
        config(['roles.defaultSeeds.UsersTableSeeder'=>false]);

        Model::unguard();
        
       $this->call(UsersTableSeeder::class);
      //  $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);
        Model::reguard();
       
        $this->call(DayTimeTableSeeder::class);
    }
}
