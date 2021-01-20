<?php

namespace Ottomenku\Moview;
 
class MoHtml
{public $classes=[
  'input'=>['form-control'],'cLabel'=>['control-label'],'helpBlock'=>['help-block']
   ];
  public  $name;
  public $baseFormtypes=[
    'input'=>['input',['id'=>false,'name'=>false,'type'=>'tex','type'=>'tex','class'=>'form-control']] 
    ,'label'=>[]
    ,'inputDate'=>[]
    ,'inputArr'=>[]
     ];
     //a controller küldi el a viewParam['Formtypes']-ban
     public $Formtypes=[
      'name'=>['input',[]] 
      ,'inputBase'=>[]
      ,'inputDate'=>[]
       ];
  
    public function makeHandler($pars)
    {
          $res="<$pars[0] ";
          $fpars=$pars[1] ?? [];
        //  if(!is_array($fpars)){ $fpars=explode(',',$fpars);}
          foreach ($fpars as $key => $par) {
            $res.= $key.'="'.$par.'" '; 
          }
          $res.='>';
          return $res;
    }
public function formgeneral($Formtypes){
  $res='';
foreach ($Formtypes as $key =>$value ) {
 $res.=$this->unit($key,$value);
}
return $res;
}

   public function unit($name,$par)
    {
      $pars=config('app.view.type.'.$type) ;
        return $this->makeHandler($pars);
    }
    public function input($type, $value=null)
    {
      $pars=config('app.view.type.'.$type) ;
      if(!empty($value)){ $pars['value']=$value;}
        return $this->makeHandler($pars);
    }


    public function twoUnit($type, $value=null,$content='',$close=true)
    {
      $pars=config('app.view.type.'.$type) ;
      if(!empty($value)){ $pars['value']=$value;}
      $res= $this->makeHandler($pars);
      if(!empty($content)){ $res.=$content;}
       if($close) $res.="</$pars[0]>";
      return $res;
    }
    public function select($type, $value=null,$content='',$close=true)
    {
//--

    }

}


