@php             
   $menuT=[
    'superadmin'=>[],
    'admin'=>[
        1 => ['m/ad.ad.ceg', 'Cégek'],
        2 => ['m/ad.ad.timetypes', ' Időtipusok'],
        3 => ['m/ad.ad.daytypes', ' Natipusok'],
        4 => ['m/ad.ad.basedays', 'Naptár'],
        5 => ['/', ' Home'],
    ],
    
    ];
   $menuT= $viewpar['menu'] ?? $menuT;
 //  $menuT['superadmin'][]=['/admin/generator'=>' Generátor'];
 @endphp             
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
    </div>    
@endif 
@if (Auth::user()->hasRole('workadmin')) 

   <div class="card">
        <div class="card-header">
            Workadmin menü
        </div>
        <div class="card-body">
            <ul class="nav flex-column" role="tablist">
                @foreach($menuT['workadmin'] ?? [] as $menu)
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

</div>
        
