@extends('layouts.backend')

@section('title', 'Edit Page')

@section('content')
<div class="row">

    <div class="box">
            <div class="box-body">
              @if(session()->has('success'))
                  <div class="alert alert-success">
                    {{ session()->get('success') }}
                  </div>
              @endif  

              <div class="panel panel-primary" style="clear: both;">
                <div class="panel-heading">Deleted Users</div>
                  <div class="panel-body">
                  <table id="list_faq" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($users as $user)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$user->name}} </td>
                        <td>{{$user->email}}</td>
                        <td>
                          <a href="{{ url('private/user/restore') }}/{{ base64_encode($user->id) }}" class="btn btn-primary">Restore</a>  |  <a onclick="return confirm('Are you sure you want to permanent delete this user?');" href="{{ url('private/user/finaldelete') }}/{{ base64_encode($user->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                      <?php $i++; ?>
                    @endforeach
                    </tbody>
                  </table>
              </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
</div>
@endsection