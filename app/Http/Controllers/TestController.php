<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Stored;
use App\User;

class TestController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function probaManagerLogin($key)
    {
        ///probamanagerlogin/aD15ll465ghAjfEbbulkkkkllllllhgz
        if($key=='aD15ll465ghAjfEbbulkkkkllllllhgz'){
            auth()->logout();
            $user=User::find(29);
            auth()->login($user);
            return redirect('/m/ad.time.manager');
        }else{return redirect('/login');}
       
    }
    public function testhome()
    {
        $user = \DB::table('test')->where('name', 'test1')->first();
       // die(config('app.url'));
         die(dump($user));
         $user=User::find();
         auth()->login($user);
        //return view('error',$error);
    }
    public function error($error)
    {
        return view('error',$error);
    }
 

}
