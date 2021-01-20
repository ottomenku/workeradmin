<?php
namespace App\Handlers;
use App\worker;
use App\User;
use App\Ceg; 
class AdminHandler
{
    public function setCegPar($ACT)
    {
    //  $cegId=Worker::where('user_id', \Auth::user()->id)->ceg_id;
    $ceg=Ceg::where('user_id', \Auth::user()->id)->first();
      if(empty($ceg) ){exit('Nincs a managerhez tartozó cég. (Adminhandler::setCegPar)');}
      $ACT['cegId']=$ceg->id;
      $ACT['cegnev']=$ceg->cegnev;
      return $ACT;
    }
    public function getCegPar()
    {
    $ceg=Ceg::where('user_id', \Auth::user()->id)->first();
      if(empty($ceg) ){exit('Nincs a managerhez tartozó cég. (Adminhandler::getCegPar)');}
      $ACT['cegId']=$ceg->id;
      $ACT['cegnev']=$ceg->cegnev;
      return $ACT;
    }
    public function hasOwnWorker($workerid) //az admin  cégéhez tartozik -e a dolgozó
    { 
      $res=false;
      if($this->getCegPar()['cegId'] == $this->getCegParFromWrkerId($workerid)['cegId']){$res=true;}
      return $res;
    }

    public function hasOwnUser($userid) //az admin  cégéhez tartozik -e a dolgozó
    { 
        $res=false;

      if($this->getCegPar()['cegId'] == $this->getCegParFromUserId($userid)['cegId']){$res=true;}
      return $res;
    }
    public function getCegParFromUserId($userid){
      $ceg=Ceg::where('user_id', $userid)->first();
      if(empty($ceg) ){exit('Nincs a usererhez tartozó cég. (Adminhandler::getCegParFromUserId)');}
      $ACT['cegId']=$ceg->id;
      $ACT['cegnev']=$ceg->cegnev;
      return $ACT;
    }
    public function getCegParFromWrkerId($workerid)
    {
        $userid=Worker::findOrFail($workerid)->user_id;
        return $this->getCegParFromUserId($userid);
    }
    public function workerCreate($data,$ACT)
    {
        $data['password']=\Hash::make($data['password']);
        $data['user_id']=  User::create($data)->id;
        $data['ceg_id']=$ACT['cegId'];
        Worker::create($data);
        \DB::table('role_user')->insert([
            'role_id' => 5, //worker
            'user_id' => $data['user_id'],
        ]);

    }
    public function workerUpdate($id,$data)
    {
        if(isset($data['password']) && !empty($data['password']))
        {$data['password']=\Hash::make($data['password']);}
        else{unset($data['password']);}
        $worker= worker::findOrFail($id);
        $userid=$worker->user_id;
        $worker->update($data);
        $user = User::findOrFail($userid);
        $user->update($data);
    }
    public function workerDestroy($id)
    {
        $userid= Worker::findOrFail($id)->user_id;
        User::destroy($userid);
    }
}