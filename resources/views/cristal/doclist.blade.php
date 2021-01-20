@php
//$docs=$data['doc'] ?? [];
$cats=$data['cat'] ?? [];
@endphp

<div class="container" >
  <div class="section-header">
    <br />
    <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Letölthető
      <span>Dokumentumaink</span></h2>
    <hr class="lines wow zoomIn" data-wow-delay="0.3s">
    <p class="section-subtitle wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">Lorem ipsum dolor sit
      amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore magna.</p>
  </div>
</div>
  <div class="container" style="min-height:150px;" > 
  <div class="row" >
    <div class="container mt-3">
      <div class="col-md-11 offset-md-1">
        <ul class="nav nav-tabs">
            
          @foreach($cats as $cat)
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#cat{{$cat->id}}">{{$cat->name}}</a>
          </li>
          @endforeach
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" >
            
          @foreach($cats as $cat)
          
          <div id="cat{{$cat->id}}" class="container tab-pane fade"><br>
            <div class="row">
            <!-- <div id="home" class="container tab-pane active "><br> -->
            @foreach($cat->doc as $doc)

            <div style="background-color:#F5F5F5;" class="col-md-4 list-group-item info">
                <table>
                <tr>
                  <td>
                  <a href="/docprev/{{$doc->id}}" data-remote="false" data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                  </a>
                </td>
                  <td>
                <div style="cursor: pointer" onclick=" datasendModal({'url':'{{ url('download/'.$doc->id) }}','modalstatus':'show'}) ;" class="">
                
                  &nbsp; {{ str_limit( $doc->name,40, '..') }}
                </div>
                </td>
              </tr>
            </table>
              </div>

 
         

                 
            @endforeach
          </div> </div>
          @endforeach
        
      </div>
    </div>
  </div>
</div>
</div>
