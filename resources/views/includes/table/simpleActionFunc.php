<?php
   function actionbutton($action,$viewpar,$itemid) {
    $baseActionKey=$viewpar['baseActionKey'] ?? 'mocontroller.mocontroller.baseAction';
    $baseAction=config($baseActionKey);
    $actual=$baseAction[$action];
    $res=' <a href="'.url($viewpar['route']).'/'.$action.'/'. $itemid .'" title="'.$actual['title'].'" class="'.$actual['class'].'"';
        if(!empty($actual['onclick'])) {$res.= 'onclick="'.$actual['onclick'].' " ';}
        if(!empty($actual['label'])) {$res.= $actual['label'];}
        if(!empty($actual['fa'])) {$res.='><i class="'.$actual['fa'].'" aria-hidden="true"></i>'; }                        
        $res.='</a>';
    return $res;    
 } 
 ?>