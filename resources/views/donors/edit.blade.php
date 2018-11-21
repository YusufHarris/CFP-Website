@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit ') }}{{$donor->title}}{{__('`s profile.')}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('donor.update', $donor->id) }}" aria-label="{{ __('Update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" class="form-control" value="{{$donor->title}}" name="title" required>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="current" class="col-md-4 col-form-label text-md-right">{{ __('Current') }}</label>

                            <div class="col-md-6">
                                <input id="current" type="checkbox" class="form-control{{ $errors->has('current') ? ' is-invalid' : '' }}" name="current" value="1" {{ $donor->current ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>

                            <div class="col-md-6">
                                <img src="{{str_replace('_thm.', '.', $donor->logo)}}" alt="{{$donor->title}}" height="50px" class="rounded">
                                <input id="logo" type="file" class="form-control" name="logo" accept="image/*">
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
            </div>
        </div>
    </div>
</div>

@endsection
