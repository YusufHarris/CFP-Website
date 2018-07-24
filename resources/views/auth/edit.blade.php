@extends('layouts.app')

@section('content')

@if (\Session::has('success'))
<br />
<div class="alert alert-success">
    <p>{{ \Session::get('success') }}</p>
</div>
<br />
@endif
@if (\Session::has('error'))
<br />
<div class="alert alert-danger">
    <p>{{ \Session::get('error') }}</p>
</div>
<br />
@endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Profile') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update') }}" aria-label="{{ __('Update') }}">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ Auth::user()->username }}" onclick="return false;" disabled="disabled">

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-4 col-md-3 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-warning" href="{{ route('password.update') }}">{{ __('Update Password') }}</a>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="card-footer text-right">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDisable">{{ __('Disable Account') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Disable Confirmation Popup -->
<div id="confirmDisable" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Disable your account?') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you sure you want to disable your account?  You will not be able to login again.') }}</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="{{ route('disable') }}">Yes</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
  </div>
</div>

@endsection
