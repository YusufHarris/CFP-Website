@extends('layouts.app')

@section('content')

@guest
@else
<div class="col-md-3 mb-4">
  <a href="{{route('gallery.create')}}" class="btn btn-primary">
    {{ __('Add a new Gallery') }}
  </a>
</div>
@endguest
<!-- image gallery -->
        <div id="images" class="pt-5 pb-4 ">
        <div class="container">
            <h2 class="text-center text-uppercase mb-4-5">Galleries</h2>
            <div class="row">
              @foreach($galleries as $gallery)
                    <div class="col-md-3 mb-4">
                      <a href="{{route('gallery.show', $gallery->id)}}">
                        <img src="{{$gallery->photos[0]->filename}}" class="w-100" alt="{{$gallery->title}}">
                        <p class="text-center text-light bg-dark w-100" style="border-bottom-right-radius:50px;border-bottom-left-radius:50px;">
                          {{$gallery->title}}</br>
                          <span class="text-uppercase"><strong>{{$gallery->sector}}</strong></span>
                        </p>
                      </a>
                    </div>

              @endforeach
        </div>
    </div>
    <div id="images_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gallery</h5>
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
    </div>


    <!-- social -->
    <div id="social" class="pt-5 pb-4 bg-primary">
      <div class="container">
      <h2 class="text-center text-uppercase text-light mb-4-5">Like &amp; Follow Us</h2>
        <div class="row justify-content-center">

          <div class="col-auto mb-4">
            <a href="https://www.facebook.com/COMMUNITYFORESTSPEMBA" class="text-light" target="_blank">
              <i class="fa fa-3x fa-facebook"></i>
            </a>
          </div>
          <div class="col-auto mb-4">
            <a href="https://www.youtube.com/user/forestsinternational" class="text-light" target="_blank">
              <i class="fa fa-3x fa-youtube"></i>
            </a>
          </div>
        </div>                                                                                                                                                                                      </div>
      </div>
    </div>
@endsection
