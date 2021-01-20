@php $year=$data['year'] ?? $this->PAR['getT']['ev'] ?? \Carbon::now()->year; 
$months_magyar=['hónapok','Január','Február','Március','Április','Jájus','Június','Július','Augusztus','Szeptember','Október','November','Decenber'];
$months=$this->PAR['calendar']['months'] ?? $months_magyar; unset($months[0]);// kiveszi az alapfeliratot és 1-el kezdődikaz index nem 0-val!!!!!
$ev_ho_formurl=$param['routes']['ev_ho_form'] ?? MoHandF::url($param['routes']['base'],$param['getT']);
 @endphp


 {{ Form::open(['url'=>$ev_ho_formurl, 'method' => 'GET'])}}
 <div class="row">             
    <div class="form-group ">
<script>
    function addyear(){
  
      $('#ev').val(parseFloat($('#ev').val())+1);    
    }
    function minusyear(){
        $('#ev').val(parseFloat($('#ev').val())-1);    
      }
   
</script>   
    <div class="col-sm-3">
 
            <div class="input-group">
                    <span  onclick="minusyear()" style="cursor: pointer;" class="input-group-addon"><</span>
                    {!! Form::text('ev',  $year, ['id'=>'ev','class' => 'form-control']) !!}
                    <span onclick="addyear()" style="cursor: pointer;" class="input-group-addon">></span>
                  </div>
         
    </div>

            <div class="col-sm-2">
                {!! Form::select('ho', $months, null, ['class' => 'form-control']) !!}
            </div>
              <div class="col-sm-2">
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : @trans('mo.update'), ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}