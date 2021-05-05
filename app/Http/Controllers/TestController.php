<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Stored;
use App\User;
use App\Worker;
use App\Ceg;

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
        ///probamanagerlogin/aD15ll465ghAjfEbbulkkkkllllllhgzz
        if($key=='aD15ll465ghAjfEbbulkkkkllllllhgzz'){
            auth()->logout();
            $user=User::find(29);
            auth()->login($user);
            return redirect('/m/ad.time.manager');
        }else{return redirect('/login');}
       
    }
    public function change()
    {
        $cegs=Ceg::with('user')->get()->toarray();
        foreach ( $cegs as $ceg) {
            $data[$ceg['id']]['cegdata']=$ceg;
            $data[$ceg['id']]['workers']=Worker::where('ceg_id',$ceg['id'])->with('user')->get()->toarray();
        }
       //return dump($data);
        return view('change', compact('data'));
    }

    public function changeUser($key,$id)
    {
        ///changeuser/aD15ll465ghAjfEbbulkkkkllllllhgzz/29
        if($key=='aD15ll465ghAjfEbbulkkkkllllllhgzz'){
            auth()->logout();
            $user=User::find($id);
            auth()->login($user);
            return redirect('/');
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
