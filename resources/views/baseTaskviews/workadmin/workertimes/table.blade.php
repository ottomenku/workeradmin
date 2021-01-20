{!! Form::open([
    'url' =>  $param['routes']['base'], 
    'method' => 'post',
    'class' => 'form-horizontal'
    ]) !!}
<div class="row">
        <div class="col-lg-2">
                {!! Form::select('worker_id', $data['workers'], 0, ['class' => 'form-control', 'required' => 'required']) !!}     
        </div>
        <div class="col-lg-10">
                @php
                $year=$data['ev'] ;
            
                $months=['Minden hónap','Január','Február','Március','Április','Május','Június','Július','Augusztus','Szeptember','Október','November','Decenber'];
               // $months=$param['calendar']['months'] ?? $months_magyar; unset($months[0]);// kiveszi az alapfeliratot és 1-el kezdődikaz index nem 0-val!!!!!
          
                 @endphp
                
                <script>
                    function addyear(){
                  
                      $('#ev').val(parseFloat($('#ev').val())+1);    
                    }
                    function minusyear(){
                        $('#ev').val(parseFloat($('#ev').val())-1);    
                      }
                 
                </script> 
            
            
                
                          
                    <div class="form-group ">
                      <div class="col-xs-4">
                  
                        <div class="input-group">
                            <span  onclick="minusyear()" style="cursor: pointer;" class="input-group-addon"><</span>
                            {!! Form::text('ev',  $year, ['id'=>'ev','class' => 'form-control input-sm','style' => 'padding-right:0px;padding-left:5px;']) !!}
                            <span onclick="addyear()" style="cursor: pointer;" class="input-group-addon">></span>
                        </div>
                          
                                    
                      </div>
                
                        <div class="col-xs-4"> 
                            {!! Form::select('ho', $months, $data['ho']  , ['class' => 'form-control input-sm col-xs-2']) !!}       
                        </div>    
                        <div class="col-xs-4"> 
                                <button type="submit" name="ev_ho" value="szures" class=" btn-primary btn btn-large">
                                        <i class="fa fa-search" aria-hidden="true">Szűrés</i> 
                                </button> 
                        </div>
         
                {!! Form::close() !!}
                </div>
         </div>  
    </div>       
   <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                     <th>Időtipus</th><th>Dátum</th><th>Start</th><th>End</th><th>Óra</th><th>Megjegyzés</th><th>Dolgozómegjegyzés</th><th>Állapot</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['list'] as $item)
                                    <tr>
                                       
                                        <td>{{ $item['timetype']['name'] }}</td>
                                        <td>{{ $item->datum }}</td> <td>{{ $item->start }}</td><td>{{ $item->end }}</td><td>{{ $item->hour }}</td>
                                        <td>{{ str_limit($item->managernote, 20,  '...')  }}</td>
                                        <td>{{ str_limit($item->workernote, 20,  '...') }}</td> 
                                        <td>

                                                @if($item->pub==1)
                                                 <span class="btn btn-primary btn-xs"> uj</span>
                                                @elseif($item->pub==0)
                                                <span class="btn btn-success btn-xs" title="Add New Wroletime">
                                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                </span>
                                                @elseif($item->pub==2)
                                                <span class="btn btn-danger btn-xs" title="Add New Wroletime">
                                                    <i class="fa fa-times" aria-hidden="true"></i> 
                                                </span>
                                                @endif
    
                                            </td>
                                        <td>
                          
                                            @if($item->pub==2 )
                                
                                            <a href="{!!  MoHandF::url($param['routes']['base'],$param['getT'],['task'=>'pub','id'=>$item->id]) !!} "
                                             class="btn btn-success btn-xs" title="unPub">
                                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            </a>
                                            @elseif($item->pub==0)
                                            <a href="{!!  MoHandF::url($param['routes']['base'],$param['getT'],['task'=>'unpub','id'=>$item->id]) !!} "
                                            class="btn btn-danger btn-xs" title="pub">
                                                <i class="fa fa-times" aria-hidden="true"></i> 
                                            </a>
                                            @elseif($item->pub==1)
                                            <a href="{!!  MoHandF::url($param['routes']['base'],$param['getT'],['task'=>'pub','id'=>$item->id]) !!} "
                                                    class="btn btn-success btn-xs" title="unPub">
                                                       <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                   </a>
            
                                                     <a href="{!!  MoHandF::url($param['routes']['base'],$param['getT'],['task'=>'unpub','id'=>$item->id]) !!} "
                                                class="btn btn-danger btn-xs" title="pub">
                                                    <i class="fa fa-times" aria-hidden="true"></i> 
                                                </a> 
                                            @endif       
                                            {!! 
                                                MoHandF::linkButton([
                                                'link'=> MoHandF::url($param['routes']['base'].'/'.$item->id.'/edit',$param['getT']),
                                                'fa'=>'pencil-square-o']) 
                                            !!}
                                            {!!
                                                 MoHandF::delButton([
                                                'tip'=>'del',
                                                'link'=>MoHandF::url($param['routes']['base'].'/'.$item->id,$param['getT']),
                                                'fa'=>'trash-o']) 
                                            !!}
                                            <a href="{{ url('/'.$param['routes']['base'].'/' . $item->id,$param['getT']) }}" 
                                                title="View "><button class="btn btn-info btn-xs">
                                                <i class="fa fa-eye" aria-hidden="true"></i> </button></a>
                                    
                                        </td>
                                    </tr>
                                  
                                @endforeach
                                </tbody>
                            </table>
                         </div>

