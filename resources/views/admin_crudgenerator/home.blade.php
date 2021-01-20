@extends('admin-crudgenerator.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Session::has('error_message'))
                    <div class="container">
                        <div class="alert alert-danger">
                            {{ Session::get('error_message') }}
                        </div>
                    </div>
                @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
