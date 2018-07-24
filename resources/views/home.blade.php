
@extends('layouts.app')

@section('content')


<div class="container">

    @if (\Session::has('success'))
    <br />
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div>
    <br />
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Welcome</div>

                <div class="card-body">
                    You are at the home page.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
