@extends('admin_crudgenerator.docs.backend')

@section('content')

<div style="margin:5%">   <center><h3>Dokumentum  generálás</h3> </center>

    <form id="editform" method="post" action="/m/ad.man.docgeneral/storeworkerdocs/{{$data['item']['id']}}" >
      <button type="submit"  class="btn btn-primary" value="Submit"> Documentumok generálása</button>  
   <div class="row">
     <div class="col-md-6">
        <label class="control-label" for="name">azonosító</label>
        <input type="text" class="form-control"  name="name" value="{{$data['item']['name']}}"> 
     </div>
      
     <div class="col-md-6">
        <label class="control-label" for="note">Megjegyzés</label>
        <input type="text" class="form-control"  name="note" value="{{$data['item']['note']}}"> 
    </div>
    <div class="col-md-12">
      <label class="control-label" for="workerids">Dolgozók kiválasztása:</label><br>
      @foreach ($data['workers'] ?? [] as $worker)
      <div style=" align-items: stretch; border: 1px solid gray; float:left;padding:5px; margin:5px;" >              
          <div >   
                <input  type="checkbox" name="workerids[]" value="{{$worker->id}}"> 
                @php
                   // a view link első paraméterének a etmplate idnek kell lennie! 
                @endphp 
                <a href="/m/ad.man.docgeneral/docgeneralview/{{$data['item']['id']}}/{{$worker->id}}" target="_blank" title="show" style=" width:20px;font-size: 18px; padding:2px; line-height:0;" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>   
                {{$worker->workername}}            
          </div>
      </div>
  @endforeach
    </div>
   </div>
      
     
      <input type="hidden" id="summernotehidden" name="editordata" value="{{$data['item']['editordata'] }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$data['item']['id'] }}"> 
    </form>
  </div> 

   
    @endsection