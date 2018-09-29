@extends('layouts.app')

@section('content')

<a href="{{route('galleries')}}" class="btn btn-primary" style="background-color:green;color:white;border-color:green;">Go back to Galleries</a>
<!-- photo gallery -->
<div id="images" class="pt-5 pb-4">
  <div class="container">
    <h2 class="text-center text-uppercase mb-4-5 bg-dark text-light shade">{{$gallery->title}}</h2>
    @auth
    <div class="col-md-4 mb-4">
      <a href="{{route('photo.create',$gallery)}}" class="btn btn-primary">
        {{ __('Add an Photo') }}
      </a>
      <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#confirmDelete">{{ __('Delete This Gallery') }}</button>
    </div>
    @endauth
      <div class="row shade">
          @foreach($photos as $photo)
            <div class="col-md-3 mb-4">
              <a href="{{$photo->filename2}}" data-lightbox="{{$photo->gallery_id}}" data-title="{{$photo->description}}">
                <img src="{{$photo->filename}}" class="w-100" style="border-top-left-radius:50px;border-top-right-radius:50px;">
                @guest
                <p class="text-center text-light bg-dark w-100" style="border-bottom-right-radius:50px;border-bottom-left-radius:50px;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{$photo->description}}
                </p>
                @endguest
              </a>

              @auth
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown show">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle text-center text-light bg-dark w-100" href="#" style="border-bottom-right-radius:50px;border-bottom-left-radius:50px;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{$photo->description}} <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdown">
                    <form method="POST" class="dropdown-item" action="{{ route('photo.destroy', $photo->id) }}" aria-label="{{ __('Delete') }}">
                      @csrf
                      <input name="_method" type="hidden" value="DELETE">
                      <button type="submit" class="btn btn-danger">Delete</a>
                      </form>
                    </div>
                  </li>
                </ul>
                @endauth
              </div>
              @endforeach
            </div>
            {{ $photos->links() }}
      <div id="images_modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Photo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="" class="w-100 rounded">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>                                                                                                                                                                                 </div>
@endsection
