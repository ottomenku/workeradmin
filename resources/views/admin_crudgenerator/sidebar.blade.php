@php             
   $menuT= $viewpar['menu'] ?? [];
   $timemenu= $viewpar['timemenu'] ?? false;
 //  $menuT['superadmin'][]=['/admin/generator'=>' Generátor'];
 @endphp             

 @if ( $timemenu)
    @include('admin_crudgenerator.timemenu')
 @else
 <div class="col-md-3">
    @if (Auth::id()>0)
    @if (Auth::user()->hasRole('superadmin')) 

   <div class="card">
        <div class="card-header">
            Szuperadmin menü
        </div>
        <div class="card-body">
            <ul class="nav flex-column" role="tablist">
                @foreach($menuT['superadmin'] ?? [] as $menu)
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ url($menu[0]) }}">
                        {{ $menu[1]}}
                    </a>
                </li>
            @endforeach
            </ul>   
        </div>  
    </div>    
    @endif 
    @if (Auth::user()->hasRole('admin')) 

   <div class="card">
        <div class="card-header">
            Admin menü
        </div>
        <div class="card-body">
            <ul class="nav flex-column" role="tablist">
                @foreach($menuT['admin'] ?? [] as $menu)
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ url($menu[0]) }}">
                        {{ $menu[1]}}
                    </a>
                </li>
            @endforeach
            </ul>  
        </div>  
        <div class="card-header">
           Zárások
        </div>
@php
    $cegs=App\Ceg::where('pub','>',0)->get(); 
@endphp

        <div class="card-body">
            <ul class="nav flex-column" role="tablist">
             @foreach($cegs ?? [] as $ceg)
             <li class="nav-item" role="presentation">
                <a class="nav-link" href="{{ url('/m/ad.time.admin/getceg/'.$ceg->id) }}">
                    {{ $ceg->cegnev}}
                </a>
            </li>
            @endforeach
            </ul>  
        </div> 
    </div>    
@endif 
@if (Auth::user()->hasRole('manager')) 
@php             
   $doctemplate=new App\Doctemplate();
   $docmenuT=$doctemplate->getMenu(); 
 @endphp  
   <div class="card">
        <div class="card-header">
            Manager menü
        </div>
        <div class="card-body">
            <ul class="nav flex-column" role="tablist">
                @foreach($menuT['manager'] ?? [] as $menu)
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ url($menu[0]) }}">
                        {{ $menu[1]}}
                    </a>
                </li>
            @endforeach
            </ul>  
        </div>  
        <div class="card-header">
          Dokumentum generálás
        </div>
        @foreach($docmenuT as $cat=>$menus)     
        <div class="card-header">
           {{$cat}}
        </div>
        <div class="card-body">
            
            <ul class="nav flex-column" role="tablist">
                @foreach($menus ?? [] as $menu)
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="/m/ad.man.docgeneral/create/{{$menu['id']}}">
                        {{ $menu['name']}}
                    </a>
                </li>
                @endforeach
            </ul>  
        </div>  
        @endforeach
    </div>  
@endif 

@if (Auth::user()->hasRole('worker')) 

   <div class="card">
        <div class="card-header">
            Dolgozói menü
        </div>
        <div class="card-body">
            <ul class="nav flex-column" role="tablist">
                @foreach($menuT['worker'] ?? [] as $menu)
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ url($menu[0]) }}">
                        {{ $menu[1]}}
                    </a>
                </li>
            @endforeach
            </ul>  
        </div>  
    </div>    
@endif  
@endif  
@endif 
</div>
        
