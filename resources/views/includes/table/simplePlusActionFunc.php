<?php
//EZ AZ AKTUÁLIS!!!!!!!!!

function btnGeneralCase($action,$fullActionPar,$viewparActionbuttonPar,$item) {
  if(in_array($action,['pub','closed','pubinfo','closedinfo',''])){
    $ifval=$viewparActionbuttonPar['ifval'][$action] ?? 0;
    if($item[$action]>=$ifval){$action='un'.$action;}
    return btnGeneral($action,$fullActionPar,$viewparActionbuttonPar,$item);
    }
  elseif($action=='destroynew'){
    $to = Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $item->updated_at);
    $from =Carbon\Carbon::now();
    $diff_in_hours = $to->diffInHours($from);
    $user=\Auth::user();
    if($diff_in_hours<3 && $item->worker_id==$user->getWorkerid()) {
      return btnGeneral('destroy',$fullActionPar,$viewparActionbuttonPar,$item);
      }
    }else{return btnGeneral($action,$fullActionPar,$viewparActionbuttonPar,$item);}

}

// $funcname($action,$actpar,$viewparActionbuttonPar,$item) 
function btnGeneral($action,$fullActionPar,$viewparActionbuttonPar,$item) {
  //  $viewparActionbuttonPar['route']=$viewpar['actionbuttonPar']['route'] ?? $viewpar['route'];
  $actual=$fullActionPar[$action];
    $url=$actual['href'] ?? $viewparActionbuttonPar['route'].'/'.$action.'/'.$item['id'];
    $res='<a href="'.url($url).'" ';
    foreach ($actual as $key => $value) {
        if($key=='fa' || $key=='text'){}
        else{$res.= $key.'="'.$value.'" ';}
    }
    if(!empty($actual['fa'])) {$res.='><i class="'.$actual['fa'].'" aria-hidden="true"></i>'; }                        
    if(!empty($actual['text'])) {$res.= $actual['text']; }      
    $res.='</a>';
    return $res;    
 }
/*
 function btnGeneral_old($actual,$url) {
    $res=' <a href="'.url($url).'" title="'.$actual['title'].'" class="'.$actual['class'].'"';
        if(!empty($actual['onclick'])) {$res.= 'onclick="'.$actual['onclick'].' " ';}
        if(!empty($actual['label'])) {$res.= $actual['label'];}
        if(!empty($actual['fa'])) {$res.='><i class="'.$actual['fa'].'" aria-hidden="true"></i>'; }                        
        if(!empty($actual['text'])) {$res.= $actual['text']; }  
        $res.='</a>';
    return $res;    
 }*/

 ?>