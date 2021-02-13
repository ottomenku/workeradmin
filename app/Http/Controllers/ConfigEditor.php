<?php

namespace App\Http\Controllers;
use App\Roles;
use App\Http\Controllers\Controller;
use jeremykenedy\LaravelRoles\Models\Role;


/**
 *  az /admin route ide van irányitva a felhasználi jog alapján eldönti hogy mi legyen a kezdő oldal
 */
class ConfigEditor extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
      return view('confeditor.confeditor');
    }

    public function create()
    {
      //  $config=config('mocontroller') ;
      //  return dump($config);
     //    return response()->json($config);
      $res['fs']=$this->listFolderFiles('../config/mocontroller/');
      $res['comf']=config('mocontroller');
      $res['comf_full']=$this->setfullConf('mo',$res['comf'],[]);
     
  dump($res) ;

    } 
//bármelyik aktualizálandó kulcsban lehet 'delParrent']
public function  setAct($act,$confArr)
{
   if(isset($confArr['delParrent'])){ $act= $this->removeFromArr($act, $confArr['delParrent'] );}
   $act= array_merge_recursive( $act, $confArr); 
   return $act;  
}
public function setfullConf($actkey, $act, $actGroupconf, $fullConf=[])
{
   // ha van groupconf,(könyvtárban, groupban lennie kell ezen kívül csak task fileokat vagy újabb groupot tartalmazhat) fullosítja a kulcsokat és összefésüli az act groupconfba
   if(isset($act['groupconf'])){
      $actGroupconf= $this->setAct($actGroupconf,$act['groupconf']); 
      
   }  
   
   foreach ($act as $key => $value) {
      if($key =='groupconf'){$fullConf[$actkey]['groupconf']=$actGroupconf;}
      else{
         if(isset($value['groupconf'])){
               $fullConf[$key]=$this->setfullConf($key, $value, $actGroupconf, $fullConf); 
            }              
               if(isset($value['base'])){
                  $fullConf[$key]= $this->confToAct( $actGroupconf,$value);       
               }
            } 
      }
        
  // $res['fullconf'] = $fullconf;  
  // $res['act'] =$act; 
  // $res['$actGroupconf'] = $actGroupconf; 
   return $fullConf;   
}
function confToAct( $actGroupconf,$act)
{ 
   $res=[];
   $res['base']=$this->setAct( $actGroupconf['base'] ,$act['base']); //TODO:basenek lennie kell a task fájlban!
   foreach ($act as $key => $value) {   
      if($key!='base'){ 
        $grKey= $actGroupconf[$key] ?? [];
         $val=$this->setAct($grKey, $res['base']);
         $res[$key]=$this->setAct($val,$value);
      }        
         
      }    
return $res;
}

function mergeDotkeyRecursive($dotkey1,$dotkey2)
{ 
  $dotkey1= str_replace('_','.',$dotkey1);
 $dotkey2= str_replace('_','.',$dotkey2);
return array_merge_recursive($this->get($dotkey1),$this->get($dotkey2));

}
public function removeFromAarr($arr, $dotkeys='')
    {
       if (!is_array($dotkeys)) {$dotkeys = explode(',', $dotkeys);}
        foreach ($dotkeys as $dotkey) {
           array_forget($arr, $dotkey);
        }
    }

   /* visszatér az adott property dotkey értékével 
    * Pl get('ACT')= $this->ACT,   get(ACT.id)=$this->ACT['id']
    */
   public function get($dotkey)
   {
    $dotkeys=explode('.',$dotkey);
    $prop=array_shift($dotkeys);
    if(empty($dotkeys)){return $this->$prop;}
    else{return \Arr::get($this->$prop,implode('.',$dotkeys));}
   
   }
   function listFolderFiles($dir){
      $res=[];
       $ffs = scandir($dir);
       unset($ffs[array_search('.', $ffs, true)]);
       unset($ffs[array_search('..', $ffs, true)]);
   
       // prevent empty ordered elements
       if (count($ffs) < 1){ return $res;}
          

       foreach($ffs as $ff){
           
           if(is_dir($dir.'/'.$ff)){ $res[$ff]=$this->listFolderFiles($dir.'/'.$ff);}
           else{$res[]=$ff;}
          
       }

      return $res;
   }
}
