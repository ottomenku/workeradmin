<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Billingdata;
use App\User;

class PayTest extends TestCase
{

    public function testTrue() {$this->assertTrue(true);}
    
   /* public function setUp(): void
    {

        parent::setUp();
        $this->user = factory('App\User')->create();
        //$this->artisan('db:seed');
    }

    public function testMem1()
    {}


    public function testMem2()
    {
        //$path =config('app.public_docprew_path');
      
    /*    config(['database.default' => 'sqlite_testing']);
        \Artisan::call('migrate');
        $user = User::create(['name' => 'test','email' => 'r@o.b', 'password' => password_hash('123456', 1)]);
        \Auth::login($user);*/

        //this fails 
    //    $this->assertTrue(false);





  /*      $request = \Request::create('/store', 'POST',[
           
            'fullname'  => 'fullname',
            'cardname'  => 'cardname',
            'city'  => 'city',
            'zip'  => 5100,
            'address'  => 'address',
            'tel'  => 'tel',
            'adosz'  => '564646465456',

        ]);
        $request->request->add(['user_id' => 11]); 
        $this->assertEquals( $request->user_id, 11);
        
        $billing=Billingdata::firstOrCreate($request->all());
        $savedBilling=Billingdata::get()->last();
        $this->assertEquals( $billing->id, $savedBilling->id);
        
        $billing=Billingdata::firstOrCreate($request->all());
        //$savedBilling=Billingdata::get()->last();
        $this->assertEquals( $billing->id, $savedBilling->id);
    $request2 = \Request::create('/store', 'POST',[
           
            'fullname'  => 'fullname',
            'cardname'  => 'cardname',
            'city'  => 'city33333',
            'zip'  => 5100,
            'address'  => 'address',
            'tel'  => 'tel333333',
            'adosz'  => '564646465456',

        ]);
        $request2->request->add(['user_id' => 11]);
       // $request->city='city2';
        $billing2=Billingdata::firstOrCreate($request2->all());
        $savedBilling2=Billingdata::get()->last();
        $this->assertNotEquals( $billing2->id, $savedBilling->id);
        $this->assertEquals( $billing2->id, $savedBilling2->id);
        $this->assertEquals( $savedBilling2->city,'city33333' );
        $this->assertEquals( $savedBilling->city,'city' );

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->json('POST', '/doc/3', [
            'avatar' => $file,
        ]);

        // Assert the file was stored...
       Storage::disk( $path)->assertExists($file->hashName());

        // Assert a file does not exist...
      Storage::disk( $path)->assertMissing('missing.jpg');
*/
    //$this->assertEquals(1, 1); 
   // }
}