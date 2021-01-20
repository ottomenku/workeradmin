@php
//$howtos=$data['howto'] ?? [];
$howcats=$data['howcat'] ?? [];
@endphp
<header  style="background-color:#004C6D" >

<div class="container">
  <div class="section-header">
    <br />
    <h2 style=" color:white;" class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Kisvállalati
      <span>Tudástár</span></h2>
    <p style=" color:white;" class="section-subtitle wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">Lorem ipsum dolor sit
      amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore magna.</p>
  </div>
  <div class="row" style="min-height:150px;">
    <div class="container mt-3">
      <div class="col-md-11 offset-md-1">
        <ul class="nav nav-tabs">
            
          @foreach($howcats as $howcat)
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#howcat{{$howcat->id}}">{{$howcat->name}}</a>
          </li>
          @endforeach
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" >
            
          @foreach($howcats as $howcat)
          
          <div id="howcat{{$howcat->id}}" style=" background-color:white; min-height:100px;"" class="container tab-pane fade"><br>
            <div class="row">
            <!-- <div id="home" class="container tab-pane active "><br> -->
            @foreach($howcat->howto as $howto)
            <div style="background-color:#F5F5F5; " class="col-md-4 list-group-item info">
                <table>
                <tr>
                  <td>
                  <a href="/howtoprev/{{$howto->id}}" data-remote="false" data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                  </a>
                </td>
                  <td>
                <div style="cursor: pointer" onclick=" datasendModal({'url':'{{ url('download/'.$howto->id) }}','modalstatus':'show'}) ;" class="">
                
                  &nbsp; {{ str_limit( $howto->name,40, '..') }}
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
</header>