@extends('layouts.backend')

@section('title', 'Edit Page')

@section('content')
<div class="row">
  <div class="box">
    <div class="box-body">
      <div class="panel panel-primary" style="clear: both;">
        <div class="panel-heading">Edit User</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <form role="form" action="{{ url('private/user/update') }}/{{ base64_encode($user->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" name="name" value="{{ $user->name }}">
                    </div>
                  </div>
               <!--    <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Last Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name" name="lname" value="{{ $user->last_name }}">
                    </div>
                  </div> -->
                 <!--  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Username" name="username" value="{{ $user->username }}">
                    </div>
                  </div> -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ $user->email }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Password" name="password">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Status</label>
                      <select class="form-control" name="is_active">
                        <option <?php if($user->status == 1){ echo 'selected'; } ?> value="1">Active</option>
                        <option <?php if($user->status == 0){ echo 'selected'; } ?> value="0">Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection