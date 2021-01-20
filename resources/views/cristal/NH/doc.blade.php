@php
$items=$data['categories'] ?? [];
@endphp
<!-- Container Starts -->

<div class="container">
  <div class="section-header">   
      <br/>       
    <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Letölthető <span>Domentumaink</span></h2>
    <hr class="lines wow zoomIn" data-wow-delay="0.3s">
    <p class="section-subtitle wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore magna.</p>
  </div>
  <div class="row">          
    <div class="col-md-12">
      <!-- Portfolio Controller/Buttons -->
      <div class="controls text-center wow fadeInUp" data-wow-delay=".6s">
     <!--   <a class="control mixitup-control-active btn btn-common" data-filter="all">
          All 
        </a> -->
 @foreach($items  as $item)
        <a href="/cat/{{ $item['id'] }}" class="control btn btn-common" data-filter=".research">
         {{$item['name']}}
        </a>
 
 @endforeach   
        
        </div>
    </div>  
      
</div> 
</div>
    <!-- Portfolio Controller/Buttons Ends-->  