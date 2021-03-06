<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
// TODO BaseModel nem használható met a moIndexnek van paramétere
class Worker extends Model
{
    //use LogsActivity;
    use SoftDeletes;
/**
 * visszatér a felhasznáó cégével
 */
    public function getUserCeg($user=null)
    {
      return  \Auth::user()->getCeg();   
    } 
     public function getOwnWorkerid()
    {  
      $user=\Auth::user();
      $worker=$this->where('user_id',$user->id)->first(); 
      return  [$worker->id];
      }
      /**
       * managerek használhatják csak a saját dolgozóit adja vissza
       */
      public function getWorker($id)  
      {  
        //if($id==0){$id=}
        $managercegid=\Auth::user()->getCeg()->id;

        $worker=$this->find($id); 
        if($managercegid==$worker->ceg_id){return $worker;}
        else {return [];}
        }
      public function getWorkerids()
      { 
          $user=\Auth::user();
       //   $gg=[$user->getWorkerid()];
          if($user->hasRole('worker')) {return [$user->getWorkerid()];}
          elseif($user->level()>20 ) { 
              $cegid=$user->getCegid();
              return Worker::where('ceg_id',$cegid)->pluck('id')->toarray();
          }
          return[];
      }
    public function getWorkersToSelect()
    {  

      $ceg=$this->getUserCeg(); 
      return  $this->where('ceg_id',$ceg->id)->pluck('fullname', 'id')->toarray();
      }
     public function getWorkers($toarray=true)
      { 
        $ceg=$this->getUserCeg(); 
        $workers=$this->where('ceg_id',$ceg->id)->with('user')->get();
        if($toarray){return $workers->toarray();}
        else{return $workers;}
        }
        public function getWorkersIdkey($toarray=true)
      { 
          $res=[];
          $workers= $this->getWorkers($toarray);
          foreach ($workers as $worker) {
          $res[$worker->id]=$worker;
          } 
         return $res;
        }
    public function moIndex($ACT,$request)
    {
      $ceg=$this->getUserCeg(); 
        $workers= $this->where('ceg_id',$ceg->id)->with('user');
        return  $workers->latest()->paginate(25)  ;
    }
    public function moEdit($id)
    {
    $worker= $this->find($id)->toarray();
    $user=User::where('id',$worker['user_id'])->first()->toarray();
    return array_merge($worker, $user);
    }
 
    public function moStore($data)
    {
      $admin=\Auth::user();
      $ceg= Ceg::where('user_id',$admin->id)->first(); 
        $data['password']=\Hash::make($data['password']);
        $user=User::create($data);
        $data['user_id']=  $user->id;
        $data['ceg_id']=$ceg->id;
        $data['workername']= $data['workername'] ??  $data['name'] ;
        $worker= $this->create($data);

        //foto mentése------------
        if(isset($data['image']) && !empty($data['image'])){
          $image= $data['image'];
          $dir=$worker->ceg_id;
           $fotopath=$this->save_thumb($image,$dir,$worker->id );
          $worker->update(['foto'=>$fotopath]);
        }

       // jogosultság beállítása-------------------
       $role = config('roles.models.role')::where('name', '=', 'worker')->first(); 
       $user->attachRole($role);

    }
    function save_thumb($image,$dir,$nameBefore)
    {
      $ds='\\';
      $basedir=public_path('/'.$dir);
      if (!file_exists($basedir)) { mkdir($basedir, 0755, true);}
     $image_name = $nameBefore. '_' .time() . '.' . $image->getClientOriginalExtension();
     $resize_image = \Image::make($image->getRealPath());
   //  $resize_image->resize(250, 250, function($constraint){
    //  $constraint->aspectRatio();
  //   })->save($basedir . $ds . $image_name);
     $image->move($basedir, $image_name);
     return '/'.$dir. '/' . $image_name;
    }



    public function moUpdate($id,$data)
    {
        if(isset($data['password']) && !empty($data['password']))
        {$data['password']=\Hash::make($data['password']);}
        else{unset($data['password']);}
        $worker= $this->findOrFail($id);
        $userid=$worker->user_id;
        $data['workername']= $data['workername'] ??  $data['name'] ;
        //foto mentése------------
        if(isset($data['image']) && $data['image']){
          $image= $data['image'];
         $dir=$worker->ceg_id;
          $data['foto']=$this->save_thumb($image,$dir,$worker->id );
         // if(\File::exists($worker->foto)) { \File::delete($worker->foto); }
        }
        $worker->update($data);
        $user = User::findOrFail($userid);
        $user->update($data);
    }
    public function moDestroy($id)
    {
     $userid= $this->findOrFail($id)->user_id;
      $this->destroy($id);
      User::destroy($userid);
      //if(File::exists($worker->foto)) { File::delete($worker->foto); }
    }
    public function show($id)
    {
      return $this->findOrFail($id);      
    }
    
    public function pub($id)
    {
        $ob=$this->find($id);
        $ob->update(['pub'=>1]);
    }
    public function unpub($id)
    {
        $ob= $this->find($id);
        $ob->update(['pub'=>0]);
    }
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *    
     * @var array
     */
    protected $fillable = ['user_id','ceg_id','position','foto', 'fullname', 'workername','mothername','city','cim','tel','birth','birthplace','ado','tb','start','end','note','pub'];

 
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function ceg()
    {
        return $this->belongsTo('App\Ceg');
    }
    public function time()
    {
      return $this->hasMany('App\Time'); 
    }
    public function day()
    {
      return $this->hasMany('App\Day'); // assuming user_id and task_id as fk
    }

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }
}
