<?php

function buttonGeneral($actual,$route,$taskId) { //pl.('del','/m/ad.man.booking',4)
    $res=''; 
    if(!empty($actual)){
         $task=$actual['task'] ?? '';
    $res='<a ';
    if(isset($actual['action']) && $actual['action']=='href') 
    {
        // $res.= 'href="'.url($viewpar['route']).'/'.$task.'/'. $taskId .'"';
       $res.= 'href="'.url($route.'/'.$task.'/'. $taskId ).'"';
    }
  //  if(!isset($actual['title'])){die(dump($actual));}
    $res.=' title="'.$actual['title'].'" style="';
    if(empty($actual['text'])) {$res.= ' width:26px;font-size: 22px;' ;} else{$res.= ' font-size: 1.5em;' ;}
    if(!empty($actual['style'])) {$res.= $actual['style'] ;} 
    $res.='   padding:2px; line-height:0;" class="'.$actual['class'].'"';
    if(!empty($actual['onclick'])) {$res.= 'onclick="'.$actual['onclick'].' " ';}
    if(!empty($actual['label'])) {$res.= $actual['label'];}
    $res.='>';
    if(!empty($actual['fa'])) {$res.='<i class="'.$actual['fa'].'"   aria-hidden="true"></i> '; }   
    if(!empty($actual['text'])) {$res.= $actual['text']; }                     
    $res.='</a>';  
    }
                
    return $res;   
}
function alterButton($action,$viewpar,$item) {//váltó gombok---
       // $publevel=  $viewpar['publevel'] ?? 5; //több szintű jogosultság beállítható 
    if(!is_array($action)){$action=[$action];}
    $param=$action[1] ?? [];
    $act=$action[0] ;
        switch ($act) {  
            case 'ifnotnull': //'actions'=> ['Action',[['ifnotnew',['edit',[param]]],'show' ]]---[['ifnotnew',['edit']] ,'show']
                $valuecol=$param[1]['valuecol'] ?? 'pub';
                if($item->$valuecol!=0){$act=$param[0];}else{$act='empty';;$param= [];}
                $param=$param[1] ?? [];
                break;    //['Dolgozóknak',[['ifnew',['edit',['valuecol'=>'userallowed']]] ]],
            case 'ifnull'://'actions'=> ['Action',[['ifnew',['edit',[param]]],'show' ]]-
               // $param=$param[1] ?? [];
                $valuecol=$param[1]['valuecol'] ?? 'pub';
                if($item->$valuecol==0){$act=$param[0];}else{$act='empty';$param= [];}
                $param=$param[1] ?? [];
                
                break;
            case 'ifplusz':
                 $valuecol=$param[1]['valuecol'] ?? 'pub';
                 if($item->$valuecol>0){$act=$param[0];}else{$act='empty';$param= [];}
                 $param=$param[1] ?? [];
                 break;
             case 'ifminus':
                 $valuecol=$param[1]['valuecol'] ?? 'pub';
                 if($item->$valuecol<0){$act=$param[0];}else{$act='empty';$param= [];}
                 $param=$param[1] ?? [];
                 break;   
            case 'ifpub':  // a klasszikus pub unpub páros
                $valuecol=$param['valuecol'] ?? 'pub';
                if($item->$valuecol>0){$act='unpub';}else{$act='pub';}
                break;       
         /*   case 'newpub':
                $valuecol=$param['valuecol'] ?? 'pub';
                if($item->$valuecol==0){$act='pub';}else{$act='empty';}
                break;   
            case 'newunpub':
                $valuecol=$param['valuecol'] ?? 'pub';
                if($item->$valuecol==0){$act='unpub';}else{$act='empty';}
                break;   
           case 'notnew_ifpub': 
                $valuecol=$param['valuecol'] ?? 'pub';
                if($item->$valuecol>0){$act='unpub';}
                elseif($item->$valuecol<0){$act='pub';}
                else{$act='empty';}
                break;
            case 'ifopen':
                $valuecol=$param['valuecol']?? 'open';
                if($item->$valuecol>0){$act='close';}else{$act='open';}
                break;
                case 'statuswithnew'://'actions'=> ['Statusz',['status','edit' ]]---[['status',[param]],'edit' ]
                $valuecol=$param['valuecol'] ?? 'pub';
                if($item->$valuecol>0){$act='allowed';}
                if($item->$valuecol<0){$act='forbidden';}
                if($item->$valuecol==0){$act='new';}  
                 break; */
            case 'status'://'actions'=> ['Statusz',['status','edit' ]]---[['status',[param]],'edit' ]
                $valuecol=$param['valuecol'] ?? 'pub';
                if($item->$valuecol>0){$act='allowed';}
                if($item->$valuecol<0){$act='forbidden';}
                if($item->$valuecol==0){$act='empty';}
                break;
            default:
            ///$act='open';
            break;
         }   
         $baseActionKey=$viewpar['baseActionKey'] ?? 'mocontroller.mocontroller.baseAction';
         $baseAction=config($baseActionKey);
         $actual=$baseAction[$act];

//TODO megoldani hogy a paraméter átadás ne fagyjon le pl:: 'ifnew'://'actions'=>['Dolgozóknak',[['ifnew',['edit',['valuecol'=>'userallowed']]] ]],
 // if($act=='ifnull') {die(dump($actual));} 
 $g=array_merge($actual, $param); 
return array_merge($actual, $param); //lehet üres is
  return $actual;
}

function actionbutton($action,$viewpar,$item) {
  
    $actual=alterButton($action,$viewpar,$item);
 
    return  buttonGeneral($actual,url($viewpar['route']),$item->id);
} 
 ?>