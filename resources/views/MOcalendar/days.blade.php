@php
    $daytype='base';
    if($dt['dayOfWeek']==6 || $dt['dayOfWeek']==0 ){$daytype='hollyday';}
    
    $timetype='base';
    //onclick="datasendModal({'url':'http://localhost:8000/m/ad.work.time/create/{{$dt['datum']}}' }) ;"
@endphp 

  <li class="flex-item btn btn-warning" href="/m/ad.wor.time/create/{{$dt['datum']}}" data-remote="false" data-toggle="modal" data-target="#myModal"
  style="{{ $daystyle[$daytype]['li'] }}">
        <div style="{{ $daystyle[$daytype]['div'] }}">{{ $dt['day'] }}., {{ $dt['type'] }}
        </div>
       @if(isset($dt['basedays']))
        <div style="{{ $daystyle[$daytype]['div'] }}">{{ $dt['basedays']['daytype']['name']}}

        </div>
       @endif 
  <!-- idők-----------------------------------  --->      
    @if(isset($dt['times']))
        @foreach($dt['times'] as $time)  
        <span style="{{ $timestyle[$timetype]['span'] }}" >   {{ str_limit($time['start'], 5,'' ).'-'.str_limit($time['end'], 5,'' )  }}    
            </span> 
   <!--      <div style="display: flex;width:100%;justify-content:flex-end;{{ $timestyle[$timetype]['div'] }}">--->      
                @if($time['pub']==0)         
                <span style="{{ $timestyle[$timetype]['span'] }}" >   {{ str_limit($time['start'], 5,'' ).'-'.str_limit($time['end'], 5,'' )  }}    
                </span> 
                @endif
     <!--        </div>--->   
        @endforeach 
    @endif        
        </li>