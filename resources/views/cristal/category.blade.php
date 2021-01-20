@extends('cristal.frame')
@section('content')
    <!-- Blog Section -->
    <section id="blog" class="section">
        <!-- Container Starts -->
@php
$items=$data['list'] ?? [];
@endphp
   <div dusk="category-contener" class="container">
            <div class="section-header" style="background-color:white;">
                <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"><span>{{$data['catname']}}</span></h2>
           </div>
            <div class="row">
@foreach($items  as $item)
     
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 blog-item" >
                    <!-- Blog Item Starts -->
                    <div class="blog-item-wrapper wow fadeInUp" data-wow-delay="0.3s">
                        <div class="blog-item-img">
                            <a href="single-post.html">
                                <img src="img/blog/img1.jpg" alt="">
                            </a>
                        </div>
                        <div class="blog-item-text" style="padding:5px;overflow: hidden;">
                        <center>
                                <a href="/admin/docprev/{{$item['id']}}" data-remote="false" data-toggle="modal" data-target="#myModal" >
                                    <img src="/docprev/thumb/{{$item['prev']}}" height="200px" width="200px">
                                </a>                                   
                            
                         </center>
                            <h3> {{$item['name']}}</h3> 
                            <p>
                                    {{Str::limit($item['note'] , 100)}}
                            </p>

                        <button onclick=" datasendModal({'url':'{{ url('download/'.$item['id']) }}','modalstatus':'show'}) ;" class="btn btn-common" style="color:white;" ><i class="lnr lnr-download"></i> -->
                         Letöltés</button>
                        </div>
                    </div> 
                </div>
                    <!-- Blog Item Wrapper Ends-->
            
@endforeach
   
            </div>
    </section>

    @endsection