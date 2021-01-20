<?php

namespace App\Http\Controllers;
use App\Roles;
use App\Http\Controllers\Controller;
use jeremykenedy\LaravelRoles\Models\Role;


/**
 *  az /admin route ide van irányitva a felhasználi jog alapján eldönti hogy mi legyen a kezdő oldal
 */
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
       // Check role anywhere
if (\Auth::check()) {
    $message=null;   
$roles=Role::pluck('name', 'level')->toarray();
$rolenames=$roles[\Auth::user()->level()];


$routeForRole=config('mocontroller.mocontroller.routeForRole') ;

    if(isset($routeForRole[$rolenames])){ $route=$routeForRole[$rolenames]; }
    else{$route='error'; $message='A joghoz ('.$rolenames.') nem tartzik érvényes route';  }

  //  $route='error';$message='A joghoz ('.$rolenames.') nem tartzik érvényes route';
    if($route=='error'){
       return view('error',['error' => $message]) ; 
        }else{ return redirect($route[0]);}
}
else {
    return view('auth.login');
}
         
    }
}
