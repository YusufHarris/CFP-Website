
@extends('layouts.app');
@section('content')

            <div class="content">
                @if (\Session::has('success'))
                <br />
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
                <br />
                @endif
                <div class="title m-b-md text-center">
                 <a href="{{route('employee.create')}}" class="btn btn-primary float-right">Create Employee</a>
                </div>
                <div class='position-center'>
                  <table class="text-center table table-striped" style="width:100%">
                    <thead class="bg-dark text-light">
                      <th><strong>ID</strong></th>
                      <th><strong>Picture</strong></th>
                      <th><strong>Name</strong></th>
                      <th><strong>Job Title</strong></th>
                      <th><strong>Edit</strong></th>
                      <th><strong>Delete</strong></th>
                    </thead>
                    <tbody>
                    @foreach ($employees as $employee)
                      <tr>
                        <td>{{$employee->id}}</td>
                        <td>
                          <img src="{{$employee->avatar}}" onerror="this.src='https://i.imgur.com/fitWknA.png';" width="30px" height="30px" alt="{{$employee->name}} Photo" style="border-radius:50px;"/>
                        </td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->title}}</td>
                        <td>
                            <a class="btn btn-primary" style="background-color:yellow;color:black;border-color:yellow;" href="{{ route('employee.edit', $employee->id) }}">
                              {{_('Edit')}}
                            </a>
                        </td>
                        <td>
                          <div class="float-inheret">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete">{{ __('Delete Employee') }}</button>
                          </div>
                        </td>
                      </tr>
                    </tr>
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
                    </tbody>
                  </table>

                </div>
            </div>
        </div>
@endsection
