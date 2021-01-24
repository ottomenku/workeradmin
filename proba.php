<?php
  function cleanchars($string) {
    $chars = array(
      "á"=>"a","é"=>"e","í"=>"i",
      "ü"=>"u","ű"=>"u","ú"=>"u",
      "ő"=>"o","ö"=>"o","ó"=>"o",
      "Á"=>"A","É"=>"E","Í"=>"I",
      "Ü"=>"U","Ű"=>"U","Ú"=>"U",
      "Ő"=>"O","Ö"=>"O","Ó"=>"O",
    );
    $a=str_replace(array_keys($chars), $chars, $string);  
    $b=preg_replace("/[^a-zA-Z0-9]+/", " ", $a);//leceréli szóközre ami nem szám vagy betű 
    $c=trim($b); //elejéről végéről eltávolítja a szóközöket.
    return preg_replace('/\s+/', '_', $c); //szóközöket aláhüzásra cseráli több egymás mellettit egyre
  }

echo cleanchars('ŰŐÜgas@&#dég   _jsk-él').mktime();