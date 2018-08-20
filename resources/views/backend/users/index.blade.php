@extends('layouts.backend')

@section('title', 'Cryptocurrencies')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="m-l-20 m-r-20 m-t-5 m-b-5">
                    @if ($message = Session::get('success'))

<div class="alert alert-success alert-block">

  <button type="button" class="close" data-dismiss="alert">×</button> 

        <strong>{{ $message }}</strong>

</div>

@endif


@if ($message = Session::get('error'))

<div class="alert alert-danger alert-block">

  <button type="button" class="close" data-dismiss="alert">×</button> 

        <strong>{{ $message }}</strong>

</div>

@endif
@if ($errors->any())

<div class="alert alert-danger">

  <button type="button" class="close" data-dismiss="alert">×</button> 

  Some error occoured.

</div>

@endif
                </div>

                <div class="card-block">
              <div class="col-md-12" style="margin: 10px 0px;clear: both;">
                 <a style="margin-left:10px;" href="{{ url('private/user/add') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</a> <a href="{{ url('private/user/deleted') }}" class="btn btn-danger pull-right"><i class="fa fa-user"></i> Deleted Users</a>
              </div>
              
              <div class="panel panel-primary" style="clear: both;">
                <div class="panel-heading">Manage Users</div>
                  <div class="panel-body">
                  <table id="list_faq" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($users as $user)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                          @if($user->status == 1)
                            Active
                          @else
                            Inactive
                          @endif
                        </td>
                        <td>
                          <a href="{{ url('private/user/edit') }}/{{ base64_encode($user->id) }}" class="btn btn-primary">Edit</a>  |  <a onclick="return confirm('Are you sure you want to delete this user?');" href="{{ url('private/user/delete') }}/{{ base64_encode($user->id) }}" class="btn btn-danger">Delete</a>
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
</div>
@endsection