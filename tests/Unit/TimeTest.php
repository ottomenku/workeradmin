<?php

namespace Tests\Unit;

use App\RoleTime;
use App\User;
use App\Time;
use Carbon\Carbon;
use Tests\TestCase;

class TimeTest extends TestCase
{
 /*  public function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite_testing']);
        \Artisan::call('migrate');
        \Artisan::call('db:seed');
    }*/

public function testhasGetTimeRole()
    {  
         $user = User::findOrFail(20);
        \Auth::login($user);
      $time= new Time() ;
     $res= $time-> getTimes(['year'=>2021,'month'=>'1',]);
     $this->assertEquals([],$res);
    }

/*
    
         $user = User::findOrFail(20);
        \Auth::login($user);
         $time= new Time() ;
        $data=['worker_id'=>'4','timetype_id'=>'1','datum'=>'2020-02-02','start'=>'11:11:11','hour'=>'8','pub'=>'0'];
     $timeid= $time->create($data)->id;
        //  $timeid=156;
         $this->assertTrue($time->hasGetTimeRoleFromId($timeid));
       \Auth::logout();
       $user = User::findOrFail(23);
        \Auth::login($user);
        $this->assertFalse($time->hasGetTimeRoleFromId($timeid));
        \Auth::logout();
        $user = User::findOrFail(12);
         \Auth::login($user);
         $this->assertTrue($time->hasGetTimeRoleFromId($timeid));
         \Auth::logout();
         $user = User::findOrFail(13);
          \Auth::login($user);
          $this->assertFalse($time->hasGetTimeRoleFromId($timeid));
 
    } 
/*    //  ha kikommentelem a tesztetket legyen egy jó teszt hogy a phpunit ne jelezzen hibát   
   // public function testTrue() {$this->assertTrue(true);}
    public function testgetEndFromMonth() {
  $this->assertEquals(\CalendarHandler::getEndFromMonth('2020','1'), '2020-01-31');

}
     public function testgetTimes() {
    $time=new \App\Time();
  //$time= $time->getTimes(4, $yearOrstart='0',$monthOrEnd='0');
  $time= $time->getTimes(4);
  $this->assertEquals($time->toarray(), []);

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
