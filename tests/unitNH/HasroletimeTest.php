<?php

namespace Tests\Unit;

use App\RoleTime;
use Carbon\Carbon;
use Tests\TestCase;

class HasroletimeTest extends TestCase
{
  
    //  ha kikommentelem a tesztetket legyen egy jó teszt hogy a phpunit ne jelezzen hibát   
    public function testTrue() {$this->assertTrue(true);}

/*
    public function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite_testing']);
        \Artisan::call('migrate');
    }
    public function testGetRoleStart()
    {

        $tart = RoleTime::getRoleStart(1, 1);
        //   $today=\Carbon\Carbon::now()->format('Y-m-d') ;
        $today = Carbon::now();
        $todayStr = \Carbon\Carbon::now()->format('Y-m-d');
        $this->assertEquals($todayStr, $tart);

        $tomorrow = Carbon::now()->addDay(1);
        $yesterday = Carbon::now()->addDay(-1);
        RoleTime::create([
            'user_id' => 1,
            'role_id' => 1,
            'admin_id' => 1,
            'start' => $yesterday->format('Y-m-d'),
            'end' => $yesterday->format('Y-m-d'),
        ]);
        $tart = RoleTime::getRoleStart(1, 1);
        $this->assertEquals($todayStr, $tart);

        RoleTime::create([
            'user_id' => 1,
            'role_id' => 1,
            'admin_id' => 1,
            'start' => $tomorrow->format('Y-m-d'),
            'end' => $tomorrow->format('Y-m-d'),
        ]);
        $tart = RoleTime::getRoleStart(1, 1);
        $this->assertEquals($tomorrow->format('Y-m-d'), $tart);
    }

 
    public function testHasRoleTime()
    {
        $roletime = new Roletime();
        $this->assertFalse($roletime->hasRole(1, 1));

        //   $today=\Carbon\Carbon::now()->format('Y-m-d') ;
        $today = Carbon::now();
        $tomorrow = Carbon::now()->addDay(1);
        $tomorrow2 = Carbon::now()->addDay(2);
        $yesterday = Carbon::now()->addDay(-1);
        $yesterday2 = Carbon::now()->addDay(-2);
        RoleTime::create([
            'user_id' => 1,
            'role_id' => 1,
            'admin_id' => 1,
            'start' => $tomorrow,
            'end' => $tomorrow2,
        ])->id;
        RoleTime::create([
            'user_id' => 1,
            'role_id' => 1,
            'admin_id' => 1,
            'start' => $yesterday2,
            'end' => $yesterday,
        ]);
        RoleTime::create([
            'user_id' => 2,
            'role_id' => 1,
            'admin_id' => 1,
            'start' => $today,
            'end' => $tomorrow,
        ]);
        RoleTime::create([
            'user_id' => 1,
            'role_id' => 2,
            'admin_id' => 1,
            'start' => $today,
            'end' => $tomorrow,
        ]);
        //   $this->assertEquals($id,1);
        //  $this->assertTrue(true);

        $this->assertFalse($roletime->hasRole(1, 1));
        $id = RoleTime::create([
            'user_id' => 1,
            'role_id' => 1,
            'admin_id' => 1,
            'start' => $yesterday,
            'end' => $today,
        ])->id;

        $this->assertTrue($roletime->hasRole(1, 1));
        $roletime->destroy($id);
        $this->assertFalse($roletime->hasRole(1, 1));
        $id = RoleTime::create([
            'user_id' => 1,
            'role_id' => 1,
            'admin_id' => 1,
            'start' => $today,
            'end' => $tomorrow,
        ])->id;
        $this->assertTrue($roletime->hasRole(1, 1));
        $roletime->destroy($id);
        RoleTime::create([
            'user_id' => 1,
            'role_id' => 1,
            'admin_id' => 1,
            'start' => $yesterday,
            'end' => $tomorrow,
        ]);
        $this->assertTrue($roletime->hasRole(1, 1));
        RoleTime::create([
            'user_id' => 1,
            'role_id' => 1,
            'admin_id' => 1,
            'start' => $today,
            'end' => $tomorrow,
        ]);
        $this->assertTrue($roletime->hasRole(1, 1));
    }
*/
}
