<?php

namespace App\Handlers;
use App\Worker;
use App\Ceg; 
class WorkerHandler
{
    public function setWorkerAndCegPar($DATA)
    {
      $user=\Auth::user();
      $worker=Worker::where('user_id', $user->id)->first();
      $ceg=Ceg::find($worker->ceg_id)->with('user')->first();
      $DATA['cegid']=$ceg->id;
      $DATA['cegnev']=$ceg->cegnev;
      $DATA['workerids']=[$worker->id];  
      $DATA['workerid']=$worker->id;
      $DATA['workers']=[$worker->id=>$worker];
      $DATA['level']=$user->level();
      return $DATA;
    }

}