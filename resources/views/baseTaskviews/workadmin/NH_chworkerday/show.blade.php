@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Chworkerday {{ $chworkerday->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/workadmin/chworkerday') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/workadmin/chworkerday/' . $chworkerday->id . '/edit') }}" title="Edit Chworkerday"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['workadmin/chworkerday', $chworkerday->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Chworkerday',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $chworkerday->id }}</td>
                                    </tr>
                                    <tr><th> Workerday Id </th><td> {{ $chworkerday->workerday_id }} </td></tr><tr><th> Daytype Id </th><td> {{ $chworkerday->daytype_id }} </td></tr><tr><th> Managernote </th><td> {{ $chworkerday->managernote }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
