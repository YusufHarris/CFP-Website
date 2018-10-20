@extends('layouts.app')

@section('content')

<div class="container">

    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('beneficiary.create') }}">
            <i class="fa fa-plus-circle"></i> {{ __('New') }}
        </a>
    </div>
    <br />

    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Picture</th>
                        <th>Name</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($beneficiaries as $beneficiary)
                    <tr>
                        <td>{{$beneficiary->id}}</td>
                        <td>
                            <img src="{{$beneficiary->avatar}}" onerror="this.src='https://i.imgur.com/fitWknA.png';" width="30px" height="30px" alt="{{$beneficiary->directory}}defavatar.jpg" style="border-radius:50px;"/>
                        </td>
                        <td>{{$beneficiary->name}}</td>
                        <td class="text-right">
                            <a class="btn btn-warning" href="{{ route('beneficiary.edit', $beneficiary->id) }}">
                                <i class="fa fa-pencil"></i> {{ __('Edit') }}
                            </a>
                        </td>
                        <td class="text-right">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete{{$beneficiary->id}}">
                                <i class="fa fa-user-times"></i> {{ __('Delete') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Popups -->
@foreach ($beneficiaries as $beneficiary)
<div id="confirmDelete{{$beneficiary->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Delete') }} {{ $beneficiary->name }}?</h4>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you sure you want to delete this beneficiary?  It cannot be recovered.') }}</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('beneficiary.destroy', $beneficiary->id) }}" aria-label="{{ __('Delete') }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-primary">Yes</a>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
