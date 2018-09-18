@extends('layouts.app')

@section('content')
<style>
/* The container */

/* Hide the browser's default radio button */
.container1 input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container1:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container1 input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container1 input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container1 .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Gallery') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('gallery.store') }}" aria-label="{{ __('Create Gallery') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="imageName" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" accept="text/html" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sector" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6 form-group row">
                              <table class="table text-center">
                                <thead>
                                  <th>Sector</th>
                                  <th>Selection</th>
                                </thead>
                                <tr>
                                  <td><label for="agriculture" class="container1"><h5>Agriculture</h5></td>
                                  <td><input id="agriculture" type="radio" name="sector" value="agriculture" class="form-control"></td>
                                </tr>
                                <tr>
                                  <td><label for="energy"><h5>Energy</h5></lable></td>
                                  <td><input id="energy" type="radio" name="sector" value="energy" class="form-control"></td>
                                </tr>
                                <tr>
                                  <td><label for="forestry"><h5>Forestry</h5></label></td>
                                  <td><input id="forestry" type="radio" name="sector" value="foresty" class="form-control"></td>
                                </tr>
                                <tr>
                                  <td> <label for="water"><h5>Water</h5></label> </td>
                                  <td><input id="water" type="radio" name="sector" value="water" class="form-control"></td>
                                </tr>
                                <tr>
                                  <td><label for="crosscutting"><h5>Cross-cutting</h5></label></td>
                                  <td><input id="crosscutting" type="radio" name="sector" value="crosscutting" class="form-control"></td>
                                </tr>
                              </table>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Gallery') }}
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
