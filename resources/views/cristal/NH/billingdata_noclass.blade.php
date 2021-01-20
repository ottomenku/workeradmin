<div class="card-body">
    <style>
      .moinput{
        width: 100%;
      }  
    </style>
        {!! Form::model($data, [
            'method' => 'POST',
          //  'url' => [route('pay')],
            'class' => 'form-horizontal',
            'id' => "billingdataform"
        ]) !!}
        @if ($errors->any())
        <div class="alert alert-danger">
                <H6> HIBA!!! </H6>
        </div>
         @endif
        <h6> Kártyatulajdonos neve: </h6>
        <div class="form-group{{ $errors->has('cardname') ? 'has-error' : ''}}">
                {!! $errors->first('cardname', '<p class="alert alert-danger">:message</p>') !!}
                {!! Form::label('cardname', 'Kártyán szereplő Név', ['class' => 'control-label']) !!}<br/>
                {!! Form::text('cardname', null, ['class' => 'moinput', 'required' => 'required'])   !!}
             
            </div>
            <h6> Számlázási adatok: </h6>

            <div class="form-group{{ $errors->has('fullname') ? 'has-error' : ''}}">
                    {!! Form::label('fullname', 'Név, cégnév', ['class' => 'control-label']) !!}
                    {!! $errors->first('fullname', '<p class="alert alert-danger">:message</p>') !!}<br/>
                    {!! Form::text('fullname', null,  ['class' => 'moinput', 'required' => 'required'])    !!}
                 
                </div>  

            <div class="form-group{{ $errors->has('city') ? 'has-error' : ''}}">
                
                    {!! Form::label('city', 'Város', ['class' => 'control-label']) !!}
                    {!! $errors->first('city', '<p class="alert alert-danger">:message</p>') !!}<br/>
                    {!! Form::text('city', null, ['class' => 'moinput', 'required' => 'required'])    !!}
                    
                </div>  

                <div class="form-group{{ $errors->has('zip') ? 'has-error' : ''}}">
                        {!! Form::label('zip', 'Irányítószám', ['class' => 'control-label']) !!}
                        {!! $errors->first('zip', '<p class="alert alert-danger">:message</p>') !!}<br/>
                        {!! Form::text('zip', null,  ['class' => 'moinput', 'required' => 'required'])    !!}
                     
                    </div> 
                <div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
                        {!! Form::label('address', 'Utca, házszám', ['class' => 'control-label']) !!}
                        {!! $errors->first('address', '<p class="alert alert-danger">:message</p>') !!}<br/>
                        {!! Form::text('address', null, ['class' => 'moinput', 'required' => 'required'])    !!}
                      
                    </div>  
                    <div class="form-group{{ $errors->has('tel') ? 'has-error' : ''}}">
                        {!! Form::label('tel', 'Telefon', ['class' => 'control-label']) !!}
                        {!! $errors->first('tel', '<p class="alert alert-danger">:message</p>') !!}<br/>
                        {!! Form::text('tel', null, ['class' => 'moinput', 'required' => 'required'])    !!}
                     
                    </div> 

    <div class="form-group{{ $errors->has('adosz') ? 'has-error' : ''}}">
                        {!! Form::label('adosz', 'Adószám', ['class' => 'control-label']) !!}
                        {!! $errors->first('adosz', '<p class="alert alert-danger">:message</p>') !!}<br/>
                        {!! Form::text('adosz', null,['class' => 'moinput'])    !!}
                       
                    </div> 
                    @php
                      $orderid =  $data['order_id'] ?? 'min';
                      $userid= $data['user_id'];
                    @endphp     
             <input type="hidden"  name="user_id" value="{{ $userid }}">      
               <input type="hidden"  name="order_id" value="{{ $orderid }}">        
    </form>            
                    <div class="form-group">
                            <div id="saveBtn" onclick="datasendModal({'url':'{{ route('pay') }}','formid':'billingdataform'}) ;" class="btn btn-primary">Tovább a fizetéshez </div>
                        </div>
   

</div>
