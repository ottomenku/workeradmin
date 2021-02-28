@extends('admin_crudgenerator.docs.backend')

@section('content')

<div style="margin:5%">   <center><h3>Dokumentum  generálás</h3> </center>

    <form id="editform" method="post" action="/m/ad.man.docgeneral/preview" target="_blank">
      <button type="submit"  class="btn btn-primary" value="Submit"> Előnézet</button>  
      <button class="btn btn-primary" onclick="kuldment()" value="mentés">Generálás</button><br>

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
    <script>
    function kuldment(){
      $("#editform").prop("target", '_self');
      $('#editform').attr('action', "/m/ad.man.docgeneral/storedoc").submit();
  }
</script>
  </div> 

   
    @endsection