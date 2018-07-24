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
    <a class="btn btn-primary" href="{{ route('users.create') }}">{{ __('New User') }}</a>
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
                        <th>Action</th>
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
                            <a href="{{ route('users.edit', $user->username) }}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
