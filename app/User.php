<?php

namespace App;
/* eredeti
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable; */

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use App\Ceg;
     use App\Worker;
    class User extends Authenticatable
    {
        use Notifiable;
        use HasRoleAndPermission;
        use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

 /**
      * ha nem adunk meg useridet vagy 0-at adunk a bejelentkezett user id-ja lesz az
     * aztulajdonosnáll null tér vissza  
     */
    public function getWorker($userid=0){
        if($userid>0) {$user_id=$userid;} else{ $user_id=$this->id;}   
        return Worker::where('user_id', $user_id)->first() ?? null;
    }
 /**
      * ha nem adunk meg useridet vagy 0-at adunk a bejelentkezett user id-ja lesz az
     * a tulajdonosnáll 0-al tér vissza 
     */
    public function getWorkerid($userid=0){

        return $this->getWorker($userid)->id ?? 0;
    } 
    /**
      *Saját cégge tér vissza az adminnál az 1-es cég
     */
    public function getCeg(){
     //  if($userid>0) {$user_id=$userid;} else{ $user_id=$this->id;}    
    //   $user_id= $this->id;
    //    $user=$this->find($user_id);
    $user=\Auth::user();
        if($user->hasRole('owner')) {
            $ceg=Ceg::where('user_id',$user->id)->first();
        }elseif($user->hasRole('admin')){
        $ceg=Ceg::find(1);
        }
        else{
            $cegid=Worker::where('user_id',$user->id)->first()->ceg_id;
            $ceg=Ceg::find($cegid);
        }
        return $ceg;
    }
    public function  getCegPubArray(){
       $ceg=$this->getCeg();
         return ['id'=>$ceg->id,"cegnev"=>$ceg->cegnev];
     }


   
   /**
    * ha nem adunk meg useridet vagy 0-at adunk a bejelentkezett user id-ja lesz az
     * az adminnál  1 el tér vissza (az egyes a base cég)
     */
    public function getCegid(){
        return $this->getCeg()->id ?? 0;
    }
    public function getUser($userid=0){
        if($userid>0) {$user=$this->find($userid);} else{ $user=$this;}  
        return $user;
    }
    /**
    * hozzáférhet-e az adot  céghez az adott user
    * ha nem adunk meg useridet a bejelentkezett user id-ja lesz az
    * az adminnál  mindig trueval tér vissza
    */
    public function hasCegid($cegid,$userid=0){
        $user=$this->getUser($userid);
        if($user->hasRole('admin')){return true;}
        $ceg_id= $this->getCegid($userid);
        if($ceg_id= $cegid){return true;}
        return false;
    }
}
