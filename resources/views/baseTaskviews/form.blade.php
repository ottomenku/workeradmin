@extends($viewpar['template'].'.'.$viewpar['frame'])
@php
$base_par=[
'labelpar'=>['class' => 'col-md-4 control-label'],
'inputpar'=>['class' => 'form-control'], 
'formcreatepar'=>[ 'class' => 'form-horizontal', 'files' => true], //url a parméterben kell megadni vagy generál aroutból
'formeditpar'=>[ 'method' => 'PATCH','class' => 'form-horizontal', 'files' => true], 
]; // helyi alap változók, a controllerel átadott $viewpar felülírja

 //be kell írni a composr.json-ba  "autoload": { "files": ["packages/ottomenku/laravel-mocontroller/src/helper.php" ]
// vagylétre kell hzni a \vendor\laravel\framework\src\Illuminate\Foundation\helpers.php-ban
$conf=setconf($base_par,$viewpar,'tpar'); //be kell másolni és mergelni a paramétereket a confba hogy a config()-al lehessen elérni, és ne kelljen vele foglalkozni hogy van e olyan kulc illetve könnyú alap alapértéket adni

$value = array_get($base_par, 'names.john', 'default'); //dot tömbelérés defaultal
@endphp
@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header"> {{ config('tpar.taskheader') }}</div>
        <div class="card-body">
                <a href="{{ url($viewpar['route']) }}" title="Back"><button class="btn btn-warning btn-sm">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Vissza</button>
                </a>
                 
            <br/>
            <br/>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @include (config('tpar.forminclude'), ['submitButtonText' => 'Update'])     
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection