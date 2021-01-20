<?php
/*
echo (new Carbon('first day of December 2008'))->addWeeks(2); 
echo $dt->startOfWeek();    // 2012-01-30 00:00:00
echo $dt->endOfWeek(); 
$now = Carbon::now();
$weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
$weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
*
$now=Carbon::createFromFormat('Y-m-d', '2018-01');

echo $now;
*/







/*function probaFunc(){
echo 'nincs par';
}
$par1='par1';
probaFunc($par1,$par2 ?? null,null);

$str='{jfkjsahfskfjbbgbb{ipiupi}';
$res=preg_match_all('/\{(.*?)\}/', $str, $outArr);
echo $res;
//var_dump($res);
$dotkey='ACT.id.hhh';
$dotkeys=explode('.',$dotkey);
$prop=array_shift($dotkeys);
if(empty($dotkeys)){echo '$this->$prop='.$prop;}
else{echo implode('.',$dotkeys);}

substr($str, -1); //utolsó
substr($str, 0,1); //első
if(substr($str, 0,1)=='{' && substr($str, -1)=='}'){
    echo 'ok';
}*/