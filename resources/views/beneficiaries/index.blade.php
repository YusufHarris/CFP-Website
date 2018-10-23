
@extends('layouts.app');
@section('content')

<div class="container">

    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('beneficiary.create') }}">
            <i class="fa fa-plus-circle"></i> {{ __('New') }}
        </a>
    </div>
    <br/>

    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($beneficiaries as $beneficiary)
                    <tr>
                        <td>
                            <img src="{{$beneficiary->avatar}}" onerror="this.src='https://i.imgur.com/fitWknA.png';" width="30px" height="30px" alt="{{$beneficiary->directory}}defavatar.jpg" style="border-radius:50px;"/>
                        </td>
                        <td>{{$beneficiary->name}}</td>
                        <td class="text-right">
                            <a href="{{ route('beneficiary.edit', $beneficiary->id) }}" class="btn btn-warning">
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
