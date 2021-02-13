@php
  $b='lllllllll';
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} </title>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!--  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
     <!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->  
    <!-- az app js becsatolja <link href="{{ asset('css/configeditor.css') }}" rel="stylesheet">   -->
    <!-- az app js becsatolja <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- eredetiből-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  @php
  //$now=$now =Carbon\Carbon::now();
  //$ev= $viewpar['id'] ?? $now->year;
  @endphp

</head>
<body>

  <div class="container">
    <h4>Vue.js Expandable Tree Menu<br/><small>(Recursive Components)</small></h4>
    <div id="app">
    <tree-menu 
               :nodes="tree.nodes" 
               :depth="0"   
               :label="tree.label"
               ></tree-menu>
    </div>
  </div>
  
  
  <script type="text/x-template" id="tree-menu">
    <div class="tree-menu">
      <div class="label-wrapper" @click="toggleChildren">
        <div :style="indent" :class="labelClasses">
          <i v-if="nodes" class="fa" :class="iconClasses"></i>
          @{{ label }}   @{{ name }}
        </div>
      </div>
      <tree-menu 
        v-if="showChildren"
        v-for="(node,name) in nodes" 
        :nodes="node.nodes" 
        :label="node.label"
        :depth="depth + 1"   
      >
      </tree-menu>
    </div>
  </script>
  


 <script src="{{ mix('js/configeditor.js') }}" type="text/javascript"></script>

</body>
</html>
