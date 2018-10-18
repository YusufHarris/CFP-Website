
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
                 <a href="{{route('donor.create')}}" class="btn btn-primary float-right">Create donor</a>
                </div>
                <div class='position-center'>
                  <table class="text-center table table-striped table-hover" style="width:100%">
                    <thead class="bg-dark text-light">
                      <th><strong>ID</strong></th>
                      <th><strong>Logo</strong></th>
                      <th><strong>Title</strong></th>
                      <th><strong>Edit</strong></th>
                      <th><strong>Delete</strong></th>
                    </thead>
                    <tbody>
                    @foreach ($donors as $donor)
                      <tr>
                        <td>{{$donor->id}}</td>
                        <td>
                          <img src="{{$donor->logo}}" onerror="this.src='https://i.imgur.com/fitWknA.png';" width="30px" height="30px" alt="{{$donor->title}} Photo" style="border-radius:50px;"/>
                        </td>
                        <td>{{$donor->title}}</td>
                        <td>
                            <a class="btn btn-primary" style="background-color:yellow;color:black;border-color:yellow;" href="{{ route('donor.edit', $donor->id) }}">
                              {{_('Edit')}}
                            </a>
                        </td>
                        <td>
                          <div class="float-inheret">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete">{{ __('Delete Donor') }}</button>
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
                            <h4 class="modal-title">{{ __('Delete Donor?') }}</h4>
                          </div>
                          <div class="modal-body">
                           <p>{{ __('Are you sure you want to delete this donor?') }}</p>
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
                    </tbody>
                  </table>

                </div>
            </div>
        </div>
@endsection
