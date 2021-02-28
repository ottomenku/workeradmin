@extends('admin_crudgenerator.docs.backend')

@section('content')


<div style="margin:5%">   <center><h3>Dokumentum sablon generálás</h3> </center>

    <form id="editform" method="post" action="/m/ad.ad.doctemplate/preview" target="_blank">
      <button type="submit"  class="btn btn-primary" value="Submit"> Előnézet</button>  
      <button class="btn btn-primary" onclick="kuldment()" value="mentés">Mentés</button><br>

   <div class="row">
     <div class="col-md-6">
        <label class="control-label" for="note">Form neve</label>
        <input type="text" class="form-control"  name="name"> 
     </div>
      
     <div class="col-md-6">
        <label class="control-label" for="note">Kategória</label>
        <input type="text" class="form-control"  name="cat"> 
    </div>
    <div class="col-md-12">
      <label class="control-label" for="note">Megjegyzés</label>
      <input class="form-control" type="text" name="note"> <br>
    </div>
   </div>
      
     
      <textarea id="summernote" name="editordata"></textarea>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    <div style="display:none;">
     <ul class="workerattribute d-none" style="cursor: pointer;">
        <li data-value="<<['worker']['name']>>">Név</li>
        <li data-value="<<['worker']['user']['email']>>">Email</li>
    </ul>
    <ul class="cegattribute d-none" style="cursor: pointer;">
        <li data-value="<<['ceg']['cegname']>>">cégnév</li>
        <li data-value="<<['ceg']['adoszam']>>">Adószám</li>
    </ul>
    </div>
    <script>
      function kuldment(){
        $("#editform").prop("target", '_self');
        $('#editform').attr('action', "/m/ad.ad.doctemplate/formsave").submit();
    }
  </script>
    @endsection>