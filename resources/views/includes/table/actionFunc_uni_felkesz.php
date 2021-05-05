<?php

function buttonGeneral($actual,$route,$taskId) { //pl.('del','/m/ad.man.booking',4)
    $res=''; 
    
    if(!empty($actual)){
        $style= $actual['style'] ?? '';
         $task=$actual['task'] ?? '';
    $res='<a ';
    if(isset($actual['action']) && $actual['action']=='href') 
    {
        // $res.= 'href="'.url($viewpar['route']).'/'.$task.'/'. $taskId .'"';
       $res.= ' href="'.url($route.'/'.$task.'/'. $taskId ).'"';
    }
    if(isset($actual['target'])) 
    {
        // $res.= 'href="'.url($viewpar['route']).'/'.$task.'/'. $taskId .'"';
       $res.= ' target="'.$actual['target'].'"';
    }

  //  if(!isset($actual['title'])){die(dump($actual));}
    $res.=' title="'.$actual['title'].'"' ;
    $style=$actual['style'] ?? ''; //TODO mocontroller.mocontroller.baseAction-badefimioálni alap style
     if( $style!='none') {
        if( $style=='') {if(empty($actual['text'])) {$style= ' width:20px;font-size: 18px;' ;} else{$style.= ' font-size: 1.5em;' ;}}        
        $res.= ' style="'.$style.' padding:2px; line-height:0;"';
    }
    $res.='  class="'.$actual['class'].'"';
    if(!empty($actual['onclick'])) {$res.= 'onclick="'.$actual['onclick'].' " ';}
    if(!empty($actual['label'])) {$res.= $actual['label'];}
    $res.='>';
    if(!empty($actual['fa'])) {$res.='<i class="'.$actual['fa'].'"   aria-hidden="true"></i> '; }   
    if(!empty($actual['text'])) {$res.= $actual['text']; }                     
    $res.='</a>';  
    }
                
    return $res;   
}
/**
 * $ifArr tömb kulcsai az ikon nevek amivel visszatér a függvény, ha akulcshoz tartozó tömbben deklarált feltétl teljesül.
 *  Ha egyik feltétel sem jó ajkkor a base kulcsú ikonnal tér vissza.
 * A $valueArr tmbjének kulcsai $ifArr tomb változó nevei, értékükkel vizsgálja hogy igaz e az $ifArr valamelyik feltétele
 */
function getActualIfIcon($ifArr,$valueArr) {
//ifArr example: [['base'=>'baseicon'],['icon1'=>['val2','>',val1'],['icon,'=>['val2','<',val1']]]
//$valueArr example: [['val1'=>'pubval'],['val2'=>1]]
$icon=$ifarr['base'];
unset($ifarr['base']);
foreach ($ifArr as $key => $value) {
    if($value[1]=='<' && $valueArr[$value[0]] < $valueArr[$value[2]] ){ $icon= $key ;  }
    if($value[1]=='>' && $valueArr[$value[0]] >$valueArr[$value[2]] ){ $icon= $key ;  }
    if($value[1]=='<=' && $valueArr[$value[0]] <= $valueArr[$value[2]] ){$icon = $key ;  }
    if($value[1]=='>=' && $valueArr[$value[0]] >= $valueArr[$value[2]] ){$icon = $key ;  } 
    if($value[1]=='==' && $valueArr[$value[0]] == $valueArr[$value[2]] ){$icon = $key ;  }
    if($value[1]=='=' && $valueArr[$value[0]] == $valueArr[$value[2]] ){$icon = $key ;  }
    if($value[1]=='!=' && $valueArr[$value[0]] != $valueArr[$value[2]] ){ $icon= $key ;  }

}
 return $icon;
}


/**
 * Az action alapján alapértelmezetten mocontroller.mocontroller.baseAction ($viewpar['baseActionKey']-ben felül lehet írni) 
 * config tömből kikeresi az aktuális paramétereket és összefésüli az action paramétereivel $action[1] ha vannak
 * 
 */
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
// $g=array_merge($actual, $param); 
return array_merge($actual, $param); //lehet üres is
 // return $actual;
}
/**
 * ha az if arr tömb ne csinál semmit, ha stirng előb megkeresi a viewpar$viewpar['ifArr'] -ban 
 *   a configban egyesíti és azzal tér vissza
 */
function getifArr($ifarr,$viewpar) {
    if(!is_array($ifarr)){
        $configKey='mocontroller.ifArr.'.$ifArr;
        $ifArr=$viewpar['ifArr'][$ifarr] ?? [];
        $configIfArr=config($configKey) ?? [];
      $ifArr= array_merge($configIfArr,$ifArr);
    }
return $ifarr;
}
function getIcons($actions,$viewpar,$item) {
    $icons=[];
    foreach ($actions as $key => $action) {
        if(is_array($action)){
            $ifarr=$this->getifArr($action[0],$viewpar) ;
            $$valueArr=$this->getifArr($action[0],$viewpar) ;  
            $icons[]=agetActualIfIcon($ifArr,$valueArr);

        }
       else{$icons[]=$action;}
    }  
    return  $icons;
} 


function actionbutton($actions,$viewpar,$item) {
    $icons=$this->getIcons($actions,$viewpar,$item);
    
 
    return  buttonGeneral($actual,url($viewpar['route']),$item->id);
} 
 ?>