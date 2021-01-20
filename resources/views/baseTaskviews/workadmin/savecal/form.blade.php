@php
//$getT=$param['getT'] ?? [];
$year=$data['ev'] ;
$months=['hónapok','Január','Február','Március','Április','Május','Június','Július','Augusztus','Szeptember','Október','November','Decenber'];

$calendarbase=$param['calendar']['view']['base']  ?? 'calendar';
$ev_ho_view=$param['calendar']['view']['ev_ho_view'] ??  $calendarbase.'.ev_ho';
$checkbutton_view=$param['calendar']['view']['checkbutto_view'] ??  $calendarbase.'.checkbutton';
@endphp 

<script>
  function addyear(){ $('#ev').val(parseFloat($('#ev').val())+1); }
  function minusyear(){ $('#ev').val(parseFloat($('#ev').val())-1); }
</script>
<style>
    .flex-container {
        padding: 0;
        margin: 0;
        list-style: none;
        justify-content: flex-end;
        -ms-box-orient: horizontal;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -moz-flex;
        display: -webkit-flex;
        display: flex;
    }

    .nowrap {
        -webkit-flex-wrap: nowrap;
        flex-wrap: nowrap;
    }

    .flex-item {
        background: white;
        padding: 5px;
        /* width: 13.7%;
          height: 100px;*/
        margin: 0.3%;
        text-align: center;
        overflow: hidden;
    }
</style>

<div  class="row">
    <div class="col-xs-6">Mentés neve:</div>
    <div class="col-xs-6">Megjegyzés:</div>
</div>
<div class="row">
    <div class="col-xs-6">       
        {!! Form::text('name',null, ['id'=>'name','class' => 'form-control input-sm',])!!}
    </div>
    <div class="col-xs-6">
        {!! Form::text('note',null, ['id'=>'note','class' => 'form-control input-sm',])!!}
    </div>  
</div>
<div class="row"> 
    <div class="col-xs-6">Év hónap választás:</div>
    <div class="col-xs-6">Kijelölés:</div>          
</div>       
<div class="row">  
    <div class="col-xs-3">                         
        <div class="input-group">
            <span  onclick="minusyear()" style="cursor: pointer;" class="input-group-addon"><</span>
            {!! Form::text('ev',  $year, ['id'=>'ev','class' => 'form-control input-sm','style' => 'padding-right:0px;padding-left:5px;']) !!}
            <span onclick="addyear()" style="cursor: pointer;" class="input-group-addon">></span>
        </div>                        
    </div>     
    <div class="col-xs-3"> 
        {!! Form::select('ho', $months, $data['ho']  , ['class' => 'form-control input-sm col-xs-2']) !!}
    </div>         
    <div class="col-xs-6">                
        @include($checkbutton_view)           
    </div>
</div>  
<br/>
<div class="row"> 
    <div class="col-xs-6">     
        <button type="submit" name="store" value="new" class=" btn-primary btn btn-large">
        <i class="fa fa-save" aria-hidden="true"> új mentés</i> 
        </button>
        <button type="submit" name="store" value="update"  class=" btn-primary btn btn-large">
                <i class="fa fa-save" aria-hidden="true"> frissítés/új</i> 
        </button>
    </div> 
</div> 
<ul class="flex-container nowrap" style="justify-content:flex-start;margin: 2%;"> 

    @foreach($data['worker'] as $item)
        <div style="border: 1px solid grey; border-radius: 3px;margin: 0.5%;">   
            <li class="flex-item" >
            <div style="height:60px;width:60px;">  
                @if(isset($item['foto']))
                 <img src="/{{ $item['foto'] }}" alt="foto" height="50px" width="50px"> 
                @else
                <i class="fa fa-user fa-3x"  aria-hidden="true"></i>
                @endif
            </div>   
                                {{ $item['id'] }}
<br/>
<input type="checkbox"  name="worker_id[]" value="{{ $item['id'] }}" >                        
            </li>                        
        </div>
    @endforeach    

</ul>  