@extends('layouts.app')

@section('content')


<!-- image gallery -->
        <div id="images" class="pt-5 pb-4 ">
        <div class="container">
            <h2 class="text-center text-uppercase mb-4-5">Image Gallery</h2>
            <div class="row">
              @foreach($images as $image)
                    <div class="col-md-3 mb-4">
                        <img src="{{$image->imageName}}" class="w-100" style="border-top-left-radius:50px;border-top-right-radius:50px;">
                        <p class="text-center text-light bg-dark" style="border-bottom-right-radius:50px;border-bottom-left-radius:50px;">{{$image->description}}</p>
                    </div>

              @endforeach
              @guest
              @else
              <div class="col-md-3 mb-4">
                <a href="{{route('image.create')}}" class="btn-primary">
                  {{ __('Add an Image') }}
                </a>
              </div>
              @endguest
        </div>
    </div>
    <div id="images_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image</h5>
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
                                <i class="fab fa-3x fa-facebook"></i>
                            </a>
                        </div>
                                                                                            <div class="col-auto mb-4">
                            <a href="https://instagram.com/mycompany" class="text-light" target="_blank">
                                <i class="fab fa-3x fa-instagram"></i>
                            </a>
                        </div>
                                                                                            <div class="col-auto mb-4">
                            <a href="https://twitter.com/mycompany" class="text-light" target="_blank">
                                <i class="fab fa-3x fa-twitter"></i>
                            </a>
                        </div>
                                                                                                                                                                                            </div>
        </div>
    </div>
@endsection
