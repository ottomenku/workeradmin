@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form id="form-change-password" role="form" method="POST" action="{{ url('/changepasswd') }}" novalidate class="form-horizontal">
                        <div class="col-md-9">             
                          <label for="current-password" class="col-sm-4 control-label">Régi jelszó</label>
                          <div class="col-sm-8">
                            <div class="form-group">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                              <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password">
                            </div>
                          </div>
                          <label for="password" class="col-sm-4 control-label">Új jelszó</label>
                          <div class="col-sm-8">
                            <div class="form-group">
                              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                          </div>
                          <label for="password_confirmation" class="col-sm-4 control-label">Új jelszó mégegyszer</label>
                          <div class="col-sm-8">
                            <div class="form-group">
                              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-5 col-sm-6">
                            <button type="submit" class="btn btn-danger">Submit</button>
                          </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
