
modal ajax:
<a href="remoteContent.html" data-remote="false" data-toggle="modal" data-target="#myModal" class="btn btn-default">
    Launch Modal
</a>
modal from div:
<a href="#myModalId" data-toggle="modal" data-content="d1">myLink1</a>
<div id="d1" style="display:none">
    div1 content                    
</div>

https://getbootstrap.com/docs/3.4/components/#glyphicons
nyilak
glyphicon glyphicon-triangle-right ,left, bottom, top //teli
glyphicon glyphicon-menu-right, left,bottom, top,

awesome:#
<script src="https://kit.fontawesome.com/f419bc7769.js" crossorigin="anonymous"></script>


<p class="bg-primary">...</p>
<p class="bg-success">...</p>
<p class="bg-info">...</p>
<p class="bg-warning">...</p>
<p class="bg-danger">...</p>

<i class="fa fa-info"></i>
<i class="fa fa-info-circle"></i>
<i class="fa fa-save"></i>
<i class="fa fa-plus" aria-hidden="true"></i>
<i class="fa fa-comment"></i>
<i class="fa fa-eye" aria-hidden="true"></i>
<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
<i class="fa fa-trash-o" aria-hidden="true"></i>

.col-md-offset-4 //eltolás
Extra small devices Phones (<768px)	Small devices Tablets (≥768px)	Medium devices Desktops (≥992px)	Large devices Desktops (≥1200px)>
.col-xs-	.col-sm-	.col-md-	.col-lg-
//ajax post to modal
<button onclick="datasendModal({'url':'{{ route('billingdataformJson', 'base') }}'}) ;" class="btn btn-common">Buy Now</button>
//gombok
<a href="{{ url('/admin/howto') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
színek:
btn-default, btn-primary, btn-success, btn-info, btn-danger, btn-link
háttérszín



<!-- Split button -->
<div class="btn-group">
  <button type="button" class="btn btn-danger">Action</button>
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div>





Sizes
 .btn-lg, .btn-sm, or .btn-xs 
 Create block level buttons—those that span the full width of a parent— by adding .btn-block.
 We use .disabled as a utility class here, similar to the common .active class, so no prefix is required. 

 Responsive images
Images in Bootstrap 3 can be made responsive-friendly via the addition of the .img-responsive class. This applies max-width: 100%;, height: auto; and display: block; to the image so that it scales nicely to the parent element.

To center images which use the .img-responsive class, use .center-block instead of .text-center. See the helper classes section for more details about .center-block usage.
<img src="..." alt="..." class="img-rounded">
<img src="..." alt="..." class="img-circle">
<img src="..." alt="..." class="img-thumbnail">


