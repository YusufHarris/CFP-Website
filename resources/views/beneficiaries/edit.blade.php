@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit ') }}{{$beneficiary->name}}{{__('`s profile.')}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('beneficiary.update',$beneficiary->id) }}" aria-label="{{ __('Edit Beneficiary') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$beneficiary->name}}" name="name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="introduction" class="col-md-4 col-form-label text-md-right">{{ __('Introduction') }}</label>

                            <div class="col-md-6">
                                <textarea id="introduction" type="text" class="form-control" name="introduction" rows="3" cols="4">{{$beneficiary->introduction}}</textarea>
                                @if ($errors->has('introduction'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('introduction') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Current Profile Picture') }}</label>

                            <div class="col-md-6">
                                <img src="{{$beneficiary->avatar}}" alt="{{$beneficiary->name}}" width="50px" height="50px" class="rounded">
                                <input id="avatar" type="file" class="form-control" name="avatar" accept="image/*">
                            </div>
                        </div>

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
                <h4 class="modal-title">{{ __('Delete this beneficiary?') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you sure you want to delete this beneficiary?  It cannot be recovered.') }}</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('beneficiary.destroy', $beneficiary->id) }}" aria-label="{{ __('Delete') }}">
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
