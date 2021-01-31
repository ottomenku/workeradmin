<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route as RouteF;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\Storage;
/**
 * a __construct nem hvja meg automatikusan a beállító függvényeket
 */
class BaseWithRouteController extends \Ottomenku\MoController\MoController
{
    use \Ottomenku\MoController\Trt\Funcrun\FuncrunFull;
    use \Ottomenku\MoController\Trt\Crud\Basecrud;

 public function __construct(Request $request)
 {
    // $this->OB['request']=$request;
    $this->setrequest($request); 
    //$this->setConfigFromRoutname();
    // 
 }
 function merge($arr1,$arr2)
 { 

 return array_merge($arr1,$arr2);

 }
 function mergeRecursive($dotkey1,$dotkey2)
 { 
   $dotkey1= str_replace('_','.',$dotkey1);
  $dotkey2= str_replace('_','.',$dotkey2);
 return array_merge_recursive($this->get($dotkey1),$this->get($dotkey2));

 }

/**
 * Ha az akt Group-ra végződik a benne lévő groupconf-ból tölti fel az actot 
 * Ha nem akkor a pathnak megfelelő configból
 */
public function confToACT($path,$task,$group=true)
    {
        $groupconfOrDot='.';
        if($group){ $groupconfOrDot='.groupconf.';  }
        $redirect=config('mocontrollerGroup.error_route','/error');

        $baseArr=config($path.$groupconfOrDot.'base',[]);
   if(empty($baseArr )){
       //   activity()->log($path.$groupconfOrDot.' Group Config nem található');
         // header('Location: ' . $redirect, true, 301 ); 
          exit('Nem érvényes cim');
        }   
        $this->removeFromProp('ACT',config($path.$groupconfOrDot.'base.delParrent'));
        $this->mergeParWithProp('ACT', $baseArr);

        $taskArr=config($path.$groupconfOrDot.$task,[]);
       if(empty($taskArr) && !$group ){
         // activity()->log($path.$groupconfOrDot.$task.' Task config nem található');
        //  header('Location: ' . $redirect, true, 301 ); 
        exit('Nem érvényes task');
        }
        $this->removeFromProp('ACT',config($path.$groupconfOrDot.$task.'delParrent'));
        $this->mergeParWithProp('ACT', $taskArr);  
    }
 public function setConfig($routePartS)
 {
    $task=$this->ACT['task'];
     $configpath='';
     if(isset($routePartS[1]))
     {
        $last= array_pop($routePartS); 
        foreach ($routePartS as $part) { 
         if($configpath==''){$configpath=$part; }
         else{$configpath.='.'.$part; }             
         $this->confToACT($configpath,$task);  
        // $this->ACT['path'] .= '-----'.$configpath ;  
         } 
         $configpath.='.'.$last; 
         $this->confToACT($configpath,$task,false);   
     }else{
        $this->confToACT($routePartS[0],$task,false); 
        }
    
         
 }
 public function moReturn()
 {
  $ret=  $this->ACT['return'][0] ?? 'default';
switch ($ret) {
    case false:
    break;
    case 'view': // elég a taskview-et megadni (index, form, stb..) de nem is muszáj akkor a Taskviews meg a viewsből generálja moView()
    $view=$this->ACT['return'][1] ?? $this->get('ACT.viewpar.view') ?? null;
    if($view!=null){$view=$this->get('ACT.viewpar.Taskviews').'.'.$view;}
    return $this->moView($view); //$this->get('ACT.viewpar.Taskviews').'.'.$this->get('ACT.viewpar.view')
  // dump($view);
  //return view($view);
    break;
    case 'json': 
      if(isset($this->ACT['return'][1])){
        foreach ($this->ACT['return'][1]  as $key => $value) {
          $res[$key]=$this->get($value);
        }
      }else{
       // $res['dt']=$this->DATA;
        $res=$this->DATA;
      }
     
        return response()->json($res) 
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Access-Control-Allow-Methods', '*')
                    ->header('Access-Control-Allow-Headers', '*')  ;

      break;
    case 'viewFull': //a view teljes elérési útját meg kell adni vagy semmit. Akkor a Taskviews meg a viewsből generálja moView()
    $view=$this->ACT['return'][1] ?? $this->get('ACT.viewpar.view') ?? null;
    return $this->moView($view);
    case 'viewsimple': //a view teljes elérési útját meg kell adni vagy semmit. Akkor a Taskviews meg a viewsből generálja moView()
      $view=$this->ACT['return'][1];
      return $this->moView($view);

    case 'download': 
    return Storage::download($this->DATA['file']);  
    case 'downloadFromStorage': 
     // return Storage::download('\storage\\'.$this->DATA['file']); 
     return response()->download(storage_path($this->DATA['file']));
    break;
    case 'redirect':
    $message=$this->ACT['return'][2] ?? '';
    $redirect=$this->ACT['return'][1];

    if(empty($message)){return redirect($redirect);}
    else{return redirect($redirect)->with('flash_message', $message);} 
    break;
    case 'taskrun':
    $task=$this->ACT['task'];
    if(method_exists ($this,$task)){return $this->$task();}
    break;
    case 'dump':
        dump($this->DATA)  ; 
        dump($this->ACT)  ;  
        dump($this->OB)  ;
    break;  
    default:
        $funcname=$this->ACT['return'][0] ?? $this->ACT['task'] ;
        if(method_exists($this,$funcname)){
            return $this->$funcname();

        }
        else{
            $tmpl=$this->ACT['viewpar']['template'] ?? 'admin_crudgenerator';
            return view($tmpl.'.404');
        }
        break;
}
 }
 public function allowed()
 { 
    $allowed=$this->ACT['allowed'] ?? true;  
    if(!$allowed){ 
      $this->ACT['allowed_redirect']=$this->ACT['allowed'][1] ?? '/error';
      $message=$this->ACT['allowed_message']=$this->ACT['allowed'][2] ?? 'Not alloved route:';
    //  activity()->log($message);
      $allowed=false;
     // $allowed[1]=redirect($redirect)->with('flash_message', $message); 
       
     }
     return $allowed;
 }
 public function hasrole()
 { 
    $hasrole=false;$message='Nem megfelelő jogosultság, jelentkezzen be újra!';
    $roleS=$this->ACT['role'] ?? [];
    if(!is_array($roleS))$roleS=explode(',',$this->ACT['role']);
    $role=$roleS[0] ?? ''; 
   
    
     if(empty($role)){$hasrole=true;}
     else{
        if ( $role=='user' && \Auth::user()->id>0 ) {$hasrole=true;} 
        elseif (\Auth::check() && \Auth::user()->hasRole($role)) {$hasrole=true;}  
     }
     if(!$hasrole){
      \Auth::logout(); 
      $this->ACT['hasrole_redirect']=$roleS[1] ?? '/login'; 
      $this->ACT['hasrole_message']=$roleS[2] ?? $message;  
    //  activity()->log($message);
     // header('Location: ' . $redirect, true, 301 ); 
    // return redirect($redirect)->with('flash_message', 'Nem megfelelő jogosultság'); 
     }
     return $hasrole;
     
}
/**
 * hogy az indexet ne kelljen nindig beírni
 */
/*public function baseIndex($routname)
{
  return  $this->baseWithRoute($routname,'index');
}*/
public function setBasePar($routname,$task,$id)
{
  $this->ACT['task']=$this->ACT['viewpar']['task']= $task;
  $this->ACT['id']= $this->ACT['viewpar']['id']= $id ;
  $this->ACT['routname']=$this->ACT['viewpar']['routname']=$routname; 

  $fullpath=$this->configpath.'.'.$routname;
  return explode('.',$fullpath);
 
}
public function setUserPar()
{ 
  $this->ACT['roleId']=$this->ACT['viewpar']['roleId']=\Auth::user()->roles->pluck('id')[0] ?? 1;
  $this->ACT['userId']=$this->ACT['viewpar']['userId']=\Auth::user()->id;
  $this->ACT['email']=$this->ACT['viewpar']['email']=\Auth::user()->email;
}

 /**
 * Erre kell irányítíni a routot ha nem akarunk külön routokat csinálni
 * A config fájlok a a routname és $task paraméterek alapján töltődnek be. (groupname routname)
 *  Task a routname utolsó tagja. resources routok automatikusan oda teszik az aktuális crud taskot. 
 */ 
public function baseWithRoute($routname, $task='index', $id = null, $id1 = null, $id2 = null, $id3 = null)
{
    //ACT['routname'],ACT['task']$this->ACT['id'] $this->ACT['userid'] stb beállítása
    $routePartS=$this->setBasePar($routname,$task,$id);
    //feltölti az ACT tömböt
    $this->setConfig($routePartS);
    //engedélyezettség ellenőrzés $this->ACT['allowed'] -ban lehet tiltani
  if(!$this->allowed()){ return redirect($this->ACT['allowed_redirect'])->with('error_message',$this->ACT['allowed_message']); } 
    //jogosultságokellenőrzése
   if(!$this->hasrole()){ return redirect($this->ACT['hasrole_redirect'])->with('error_message',$this->ACT['hasrole_message']); } 
      //$this->ACT['viewpar']-ba teszi  a rout paramétereket $routname, és $task-ot nem 
        $this->setRoutPars($id , $id1 , $id2 , $id3);
       // Az ACT értékeiben a { } jelek között lévő dotkey kulcsokat kicsréli a kulcsok értékeire
      // $this->replaceACT();//$this->ACT['replaceACT'] -ban lehet tiltani
     $this->setOB();  
        //$this->ACT['funcrun_ksort'] a funcs tömb kulcs szerinti rendezése ha szükséges 1*obkey.func szintaxis (indexelés) esetén (alapértelmezés)
      $this->funcArrRun($this->ACT['funcs'] ?? []);
    return $this->moReturn(); 
  // dump($this->DATA)  ; 
  //   dump($this->ACT)  ;  
       // dump($this->OB)  ; 
}
}
