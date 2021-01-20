@php 
//$year=$data['year'] ?? $this->PAR['getT']['ev'] ?? \Carbon::now()->year; 
$year=$viewpar['routpars']['id'] ?? Carbon\Carbon::now()->year; 
$ho=$viewpar['routpars']['id'] ?? Carbon\Carbon::now()->month;
$checkbutton=$viewpar['calendar']['checkbutton'] ?? true;
$months_magyar=['hónapok','Január','Február','Március','Április','Május','Június','Július','Augusztus','Szeptember','Október','November','Decenber'];
$months=$viewpar['calendar']['months'] ?? $months_magyar; unset($months[0]);// kiveszi az alapfeliratot és 1-el kezdődikaz index nem 0-val!!!!!

//if($ev_ho_formurl_addgetT){$ev_ho_formurl= MoHandF::url($ev_ho_formurl,$viewpar['getT']);}

 @endphp

<script>
    function addyear(){
  
      $('#ev').val(parseFloat($('#ev').val())+1);    
    }
    function minusyear(){
        $('#ev').val(parseFloat($('#ev').val())-1);    
      }

</script>          
&nbsp;&nbsp;&nbsp;&nbsp;      
      <div class="col-xs-4">
        <div class="input-group">
            <span  onclick="minusyear()" style="cursor: pointer;" class="btn btn-primary input-sm"><</span>
            {!! Form::text('ev',  $year, ['id'=>'ev','class' => 'form-control input-sm col-xs-1','style' => 'padding-right:0px;padding-left:5px;']) !!}
            <span onclick="addyear()" style="cursor: pointer;" class="btn btn-primary input-sm">></span>
        </div>                   
      </div>
        <div class="col-xs-2"> 
            {!! Form::select('ho', $months, $ho  , ['class' => 'form-control input-sm col-xs-2']) !!}       
        </div>    
        <div class="col-xs-2">
            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Dátum frissítés', ['class' => 'btn btn-primary input-sm']) !!}            
      </div>  



 

    
