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
                    <div class="row">
                        <div class="col-8">{{ __('Update Password') }}</div>
                        <div class="col-4 text-right">
                            <a class="btn btn-warning" href="{{ route('edit') }}">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}" aria-label="{{ __('Update') }}">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">

                        <div class="form-group row">
                            <label for="current-password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                            <div class="col-md-6">
                                <input id="current-password" type="password" class="form-control{{ $errors->has('current-password') ? ' is-invalid' : '' }}" name="current-password" value="" required autofocus>

                                @if ($errors->has('current-password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control{{ $errors->has('new-password') ? ' is-invalid' : '' }}" name="new-password" value="" required>

                                @if ($errors->has('new-password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control{{ $errors->has('new-password-confirm') ? ' is-invalid' : '' }}" name="new-password_confirmation" value="" required>

                                @if ($errors->has('new-password-confirm'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new-password-confirm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Password') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
