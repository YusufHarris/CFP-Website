
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
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donors as $donor)
                    <tr>
                        <td>{{$donor->id}}</td>
                        <td>
                            <img src="{{str_replace('_thm.', '.', $donor->logo)}}" onerror="this.src='/storage/mainmenu_logo.png';" height="30px" alt="{{$donor->title}}"/>
                        </td>
                        <td>{{$donor->title}}</td>
                        <td>{{ $donor->current ? 'Current':'Previous' }}
                        <td class="text-right">
                            <a href="{{ route('donor.edit', $donor->id) }}" class="btn btn-warning">
                                <i class="fa fa-pencil"></i> {{ __('Edit') }}
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete{{ $donor->id }}">
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
@foreach ($donors as $donor)
<div id="confirmDelete{{ $donor->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Delete') }} {{ $donor->title }}?</h4>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you sure you want to delete this donor?  It cannot be recovered.') }}</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('donor.destroy', $donor->id) }}" aria-label="{{ __('Delete') }}">
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
