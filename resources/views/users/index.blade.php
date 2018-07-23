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

    <div class="text-right">
    <a class="btn btn-primary" href="{{ action('UsersController@create') }}">{{ __('New User') }}</a>
    </div>
    <br />

    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>E-Mail Address</th>
                        <th class="text-center">Administrator</th>
                        <th class="text-right">Created</th>
                        <th>Status</th>
                        <th colspan=2>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr class="<?php if($user->id == Auth::id()){echo 'bg-secondary text-light';}else{echo '';}?>">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center"><?php if($user->admin){echo 'X';}?>
                        <td class="text-right">{{ $user->created_at }}</td>
                        <td><?php if($user->enabled){echo 'Enabled';}else{echo 'Disabled';}?></td>
                        <td class="text-right">
                            <a href="{{ action('UsersController@edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Delete Account Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Account</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure that you want to delete this account?</p>
            </div>
            <div class="modal-footer">
                <form action="{{action('UsersController@destroy', $user->id)}}" method="POST">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Yes</button>
                </form>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

@endsection
