<h4> <a href="/changeuser/aD15ll465ghAjfEbbulkkkkllllllhgzz/2"> Admin</a></h4>

@foreach ($data as $item)
  <h3>  {{$item['cegdata']['cegnev']}} </h3>
   <h5>Manager: <a href="/changeuser/aD15ll465ghAjfEbbulkkkkllllllhgzz/{{$item['cegdata']['user_id']}}"> {{$item['cegdata']['user']['name']}} </a></h3>
@foreach ($item['workers'] as $worker)
<h5>{{$worker['position'] ?? 'worker'}}: <a href="/changeuser/aD15ll465ghAjfEbbulkkkkllllllhgzz/{{$worker['user_id']}}"> {{$worker['workername']}} </a></h3>
@endforeach

@endforeach
