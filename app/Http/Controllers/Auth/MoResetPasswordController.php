<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use app\User;
class MoResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

 //   use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';
  //saját---------------------------------------------  
     public function showMoResetForm()
    {
        //$this->middleware('guest');
        return view('auth.reset');
    }  

    public function changepasswd(Request $request)
    {
      if(\Auth::Check())
      {
        $request_data = $request->All();
        $validator = $this->admin_credential_rules($request_data);
        if($validator->fails())
        {
          return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
        }
        else
        {  
          $current_password = \Auth::User()->password;           
          if(\Hash::check($request_data['current-password'], $current_password))
          {           
            $user_id = \Auth::User()->id;                       
            $obj_user = User::find($user_id);
            $obj_user->password = \Hash::make($request_data['password']);;
            $obj_user->save(); 
            return redirect()->to('/admin');
          }
          else
          {           
            $error = array('current-password' => 'Please enter correct current password');
            return response()->json(array('error' => $error), 400);   
          }
        }        
      }
      else
      {
        return redirect()->to('/');
      }  
    }  

    public function admin_credential_rules(array $data)
    {
    $messages = [
        'current-password.required' => 'Kérem a régi jelszót',
        'password.required' => 'kérem az új jelszót',
    ];

    $validator = \Validator::make($data, [
        'current-password' => 'required',
        'password' => 'required|same:password',
        'password_confirmation' => 'required|same:password',     
    ], $messages);

    return $validator;
    }  
 
}
  
