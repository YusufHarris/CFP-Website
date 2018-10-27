
@extends('layouts.app');
@section('content')

<div class="container">

    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('donor.create') }}">
            <i class="fa fa-plus-circle"></i> {{ __('New') }}
        </a>
    </div>
    <br/>

    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donors as $donor)
                    <tr>
                        <td>{{$donor->id}}</td>
                        <td>
                            <img src="{{$donor->logo}}" onerror="this.src='https://i.imgur.com/fitWknA.png';" height="30px" alt="{{$donor->title}} Photo" style="border-radius:50px;"/>
                        </td>
                        <td>{{$donor->title}}</td>
                        <td class="text-right">
                            <a href="{{ route('donor.edit', $donor->id) }}" class="btn btn-warning">
                                <i class="fa fa-pencil"></i> {{ __('Edit') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
