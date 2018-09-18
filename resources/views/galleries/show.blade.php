@extends('layouts.app')

@section('content')


<!-- image gallery -->
        <div id="images" class="pt-5 pb-4 ">
        <div class="container">
            <h2 class="text-center text-uppercase mb-4-5">{{$gallery->title}}</h2>
            @guest
            @else
            <div class="col-md-3 mb-4">
              <a href="{{route('image.create',$gallery)}}" class="btn btn-primary">
                {{ __('Add an Image') }}
              </a>
            </div>
            @endguest
            <div class="row">
              @foreach($images as $image)
                    <div class="col-md-3 mb-4">
                      <img src="{{$image->imageName}}" class="w-100 avatar-m" style="border-top-left-radius:50px;border-top-right-radius:50px;">


                        <ul class="navbar-nav ml-auto">
                              <li class="nav-item dropdown show">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-center text-light bg-dark" href="#" style="border-bottom-right-radius:50px;border-bottom-left-radius:50px;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{$image->description}} <span class="caret"></span>
                                </a>

                                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <form method="POST" class="dropdown-item" action="{{ route('image.destroy', $image->id) }}" aria-label="{{ __('Delete') }}">
                                      @csrf
                                      <input name="_method" type="hidden" value="DELETE">
                                      <button type="submit" class="btn btn-primary">Delete</a>
                                    </form>
                                  </div>
                                  </li>
                          </ul>

              @endforeach
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
