@php

//hozzáfűzi az arr1 elemeihez az arr2 azonos kulcsú elemeit, ha a kulcs new_ val kezdődik a kkor felülirja ha naz aar1 nek nincs olyan kulcsú elme beleteszi
 function momerge($arr1,$arr2){ 
    foreach ($arr2 as $key=>$item){
         if(substr($key, 0, 4)=='new_'){$keynew=substr($key, 3);$arr1[$keynew]=$item;}
         else{ $baseString=$arr1[$key] ?? '';   $arr1[$key] =$baseString.' '.$item; }  
     } 
     return    $arr1 ;  
 }
 function momergeFullPar($arr1,$arr2){ 
     $res=[];
    foreach ($arr1 as $key=>$item){
        $res[$key]=momerge($item,$arr2);
     } 
     return    $res ;  
 }
 $viewparActionbuttonPar= $viewpar['actionbuttonPar'] ?? [];
 $viewparActionbuttonPar['route']=$viewpar['actionbuttonPar']['route'] ?? $viewpar['route'];
 $tableFuncInc= $viewpar['tableFuncInc'] ?? 'includes.table.simpleActionFunc';
 $actionParConfKey=$viewpar['actionParConfKey'] ?? 'mocontroller.mocontroller.actionButton';
 $actionBaseParConfKey=$viewpar['actionBaseParConfKey'] ?? 'mocontroller.mocontroller.actionButtonBasePar';
 $par=config($actionParConfKey) ?? [];
 $baseActionPar=config($actionBaseParConfKey) ?? [];
 $fullActionPar=momergeFullPar($par,$baseActionPar);
 $funcname=$viewpar['actionFuncname'] ?? 'btnGeneralCase';

@endphp 
@include($tableFuncInc)           
<div class="table-responsive">
    <table class="table table-borderless">
<!-- fejléc -->                        
        <thead>
            <tr>
                @foreach($viewpar['table'] as $key=> $val)

                     
                    @if(isset($viewpar['table_action']['check']))  
                        <th>  
                    <!-- oszzes kijelölése ha kell-->   
                    <input class="checkbox" type="checkbox" name="all" value="true">
                        </th>  
                    @else 
     
                    <th>
                    {{$val[0] ?? $key }}
                    </th>
                    @endif 
                @endforeach
            </tr>
        </thead>
<!-- sorok -->                 
        <tbody>
        @foreach($data['tabledata'] ?? [] as $item)
            <tr>
            @foreach($viewpar['table'] as $key=>$val)
            
                <td> 
                @if(substr($key,0,6)=='action')
               
                    @foreach ($val as $act)  
                    @php             
                     //pl.: action=>['pub','download']   
                     //pl.: action=>['pub',['actionname',[func=>'funcname','class'=>'']],'download']                       
                        $funcname=$act['func'] ?? $funcname;
                        $param=$act['param'] ?? [];
                        $action=$act['action'] ?? $act;
                        //$actpar=momerge($actpar,$param);     
                        //$actpar= momerge($par[$action],$baseActionPar);  
                     @endphp                   
                   {!!  $funcname($action,$fullActionPar,$viewparActionbuttonPar,$item)   !!}
                    @endforeach 
                   
                @else
@php  //----------------------------------------------------------------------------------
              
                   if(substr($key,0,4)=='eval'){   
                    //TODO  az evalnál elegánsabb megoldást találni
                    eval('$value='.$val[1].';');  
                    }  
                    elseif (substr($key,0,4)=='icon'){ //substr() azért kell hogy lehessen indexelni
                        $colorcolname=$val[1]['colorcolname'] ?? 'color';
                        $color=$item[$colorcolname] ?? 'gray';
                        $bgcolorcolname=$val[1]['bgcolorcolname'] ?? 'background';
                        $colname=$val[1]['bgcolorcolname'] ?? 'icon';
                        $bgcolor='';
                        if(isset($item[$bgcolorcolname])) {$bgcolor= ' background-color:'.$item[$bgcolorcolname].';';}
                            $value=' <i style="color:'.$color.';'.$bgcolor.'" class="fa fa-'.$item[$colname].'" aria-hidden="true"></i>';        
                        } 
                    elseif (substr($key,0,4)=='join'){ //substr() azért kell hogy lehessen indexelni
                    $joinfunc=$val[1];
                        $joinvar=$val[2];
                        $value=str_limit($item->$joinfunc->$joinvar, 20, '...');        
                    }
                    elseif (substr($key,0,5)=='files'){
                        $joinfunc=$val[1];
                            $value=''; 
                            foreach($item->$joinfunc as $file){                                
                                $value.='<a class="btn btn-primary btn-sm" href="'.url($viewpar['route']).'/download/'.$file->id.'">'.str_limit($file->name, 20, '...').' </a>&nbsp;';                                              
                        }
                    }
                    else{$value=str_limit($item->$key, 30, '...');}
                    //TODO str_limot paraméterből szabályozható legyen
    //-----------------------------------------------------------------------------------------                
@endphp

                {!! $value !!} 
                </td>
            @endif
                
      
            @endforeach
            </tr>
        @endforeach
        </tbody>
</table>