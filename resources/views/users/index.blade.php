@extends('layouts.app')

@section('content')

<div class="container">

    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('user.create') }}">
            <i class="fa fa-plus-circle"></i> {{ __('New') }}
        </a>
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
                        <th></th>
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
                            <form method="POST" action="{{ route('user.resetPassword', $user->username) }}" aria-label="{{ __('Reset Password') }}">
                                @csrf
                                <input name="_method" type="hidden" value="PATCH">
                                <button type="submit" class="btn btn-warning"> {{ __('Reset Password') }}</a>
                            </form>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('user.edit', $user->username) }}" class="btn btn-warning">
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
