@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Image') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('image.store', $gallery_id) }}" aria-label="{{ __('Add Image') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="imageName" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="imageName" type="file" class="form-control" name="imageName" accept="image/*" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" rows="3" cols="4"></textarea>
                            </div>
                        </div>
                        <p>Gallery ID: {{$gallery_id}}</p>
                        <input type="hidden" class="form-control" id="gallery_id" name="gallery_id" value="{{$gallery_id}}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Image to Gallery') }}
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
