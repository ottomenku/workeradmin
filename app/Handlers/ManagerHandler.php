<?php
namespace App\Handlers;
use App\Worker;
use App\User;
use App\Ceg; 
class ManagerHandler
{
 // App\Handlers\ManagerHandler
  public function setWorkerAndCegPar($DATA)
  {
    $user=\Auth::user();
    $DATA['ceg']=$user->getCegPubArray();
    $workers=Worker::select(['id','position','foto','workername'])->where('ceg_id', $DATA['ceg']['id'])->get();
    $DATA['workerids']=$workers->pluck('id')->toarray();  
    $DATA['workerid']=0;
    $DATA['workers']=$workers->toarray();
    $DATA['level']=$user->level();
    return $DATA;
  }
  public function setCegPar($DATA)
  {
    $DATA['ceg']=$user->getCegPubArray();
    $workers=Worker::select(['id','position','foto','workername'])->where('ceg_id', $DATA['ceg']['id'])->get();
    $DATA['workerids']=$workers->pluck('id')->toarray();  
    $DATA['workerid']=0;
    $DATA['workers']=$workers->toarray();
    $DATA['level']=$user->level();
    return $DATA;
  }
  public function cegToData()
  {
    $user=\Auth::user();
    return Ceg::where('user_id',$user->id)->first()->toarray();
  }
 public function workerToData()
  {
    $user=\Auth::user();
    $g=Worker::where('user_id',$user->id)->first();
    $r='';
    return Worker::where('user_id',$user->id)->first()->toarray();
  }
  public function pubRes()
  {
    $user=\Auth::user();
    $ceg=$user->getCeg();
   // $ceg=$user->getCeg();
    if($ceg->pub<1){exit('Jogosultság felfüggesztve');}
    
  }
  public function htmlGen($data,$htmlname){
    $html=file_get_contents(storage_path('app/doc_tmpl').'.\\'.$htmlname.'.html', true);
   /*     foreach($userdat->attributes as $key=>$dat){
            $html=  str_replace('$'.$key.'$',$dat,$html);         
        } */
        
        foreach($data as $key=>$dat){
            if(!is_array($dat)){$html= str_replace('$'.$key.'$',$dat,$html); }                       
        }
     //   $html=  str_replace('ő','&#x171;',$html);
       // $html=  str_replace('Ő','&Ocirc;',$html);
      //  $chars = array( "ű" => "&udblac;","Ű" => "&Udblac;",  "ő" => "&odblac;","Ő" => "&Odblac;");
       // $chars = array( "ű" => "&ucirc;","Ű" => "&Ucirc;",  "ő" => "&ocirc;","Ő" => "&Ocirc;");
       // $html = str_replace(array_keys($chars), $chars,$html);
        return $html;
   
}

}