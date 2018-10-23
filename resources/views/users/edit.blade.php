@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }}{{ $user->enabled ? '' : ' - Account Disabled' }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->username) }}" aria-label="{{ __('Update') }}">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

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
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $user->username }}" onclick="return false;" disabled="disabled">

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
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if(Auth::user()->admin)
                        <div class="form-group row">
                            <label for="admin" class="col-md-4 col-form-label text-md-right">{{ __('Administrator') }}</label>

                            <div class="col-md-6">
                                <input id="admin" type="checkbox" class="form-control{{ $errors->has('admin') ? ' is-invalid' : '' }}" name="admin" value="1" {{ $user->admin ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="enabled" class="col-md-4 col-form-label text-md-right">{{ __('Enabled') }}</label>

                            <div class="col-md-6">
                                <input id="enabled" type="checkbox" class="form-control{{ $errors->has('enabled') ? ' is-invalid' : '' }}" name="enabled" value="1" {{ $user->enabled ? 'checked' : '' }}>
                            </div>
                        </div>

                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check-circle"></i> {{ __('Update') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="card-footer text-right">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete">
                            <i class="fa fa-user-times"></i> {{ __('Delete') }}
                        </button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Popup -->
<div id="confirmDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Delete this account?') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you sure you want to delete this account?  It cannot be recovered.') }}</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('user.destroy', $user->username) }}" aria-label="{{ __('Delete') }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-primary">Yes</a>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
  </div>
</div>

@endsection
