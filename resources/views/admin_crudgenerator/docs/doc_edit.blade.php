@extends('admin_crudgenerator.docs.backend')

@section('content')

<div style="margin:5%">   <center><h3>Dokumentum  generálás</h3> </center>

    <form id="editform" method="post" action="/m/ad.man.doc.doctemplate/preview" target="_blank">
      <button type="submit"  class="btn btn-primary" value="Submit"> Előnézet</button>  
      <button class="btn btn-primary" onclick="kuldment()" value="mentés">Generálás</button><br>

   <div class="row">
     <div class="col-md-6">
        <label class="control-label" for="name">azonosító</label>
        <input type="text" class="form-control"  name="name"> 
     </div>
      
     <div class="col-md-6">
        <label class="control-label" for="note">Megjegyzés</label>
        <input type="text" class="form-control"  name="note"> 
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
      
     
      <textarea id="summernote" name="editordata"></textarea>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    function kuldment(){
      $("#editform").prop("target", '_self');
      $('#editform').attr('action', "/m/ad.man.doctemplate/docsave").submit();
  }
  </div> 

   
    @endsection