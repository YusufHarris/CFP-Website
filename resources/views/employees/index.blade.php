@extends('layouts.app')

@section('content')

<div class="container">

    <div class="text-right">
    <a class="btn btn-primary" href="{{ route('employee.create') }}">{{ __('New Employee') }}</a>
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
                      <th>Job Title</th>
                      <th class="text-right" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($employees as $employee)
                    <tr class="">
                      <td>{{ $employee->id }}</td>
                      <td>
                        <img src="{{$employee->avatar}}" onerror="this.src='https://i.imgur.com/fitWknA.png';" class="rounded" width="30px" height="30px" alt="{{$employee->name}} Photo"/>
                      </td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->title }}</td>
                        <td class="text-right">
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete">{{ __('Delete Employee') }}</button>

                        </td>
                        <td class="text-right">
                            <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach ($employees as $employee)
<!-- Delete Confirmation Popup -->
<div id="confirmDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Delete Employee?') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you sure you want to delete this Employee?') }}</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('employee.destroy', $employee->id) }}" aria-label="{{ __('Delete') }}">
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
