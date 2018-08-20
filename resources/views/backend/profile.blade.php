@extends('layouts.backend')

@section('title', 'Administration')

@section('content')
    <div class="row">
        <div class="col-lg-9 col-xlg-10 col-md-8">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Update Profile</h4>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    {!! Form::open(['class'=>'form', 'route' => 'private.profile_update', 'method' => 'POST']) !!}

                    <div class="form-group row{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label for="email" class="col-3 col-form-label">E-Mail Address</label>
                        <div class="col-9">
                            {!! Form::text('email', auth()->user()->email, ['class' => 'form-control', 'id' => 'email', 'required' => true]) !!}

                            @if ($errors->has('email'))
                                <div class="form-control-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('current_password') ? ' has-danger' : '' }}">
                        <label for="current_password" class="col-3 col-form-label">Current Password</label>

                        <div class="col-9">
                            {!! Form::password('current_password', ['class' => 'form-control', 'id' => 'current_password', 'required' => true]) !!}

                            @if ($errors->has('current_password'))
                                <div class="form-control-feedback">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label for="password" class="col-3 col-form-label">New Password</label>

                        <div class="col-9">
                            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'required' => true]) !!}

                            @if ($errors->has('password'))
                                <div class="form-control-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                        <label for="password" class="col-3 col-form-label">Confirm Password</label>

                        <div class="col-9">
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'required' => true]) !!}

                            @if ($errors->has('password_confirmation'))
                                <div class="form-control-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    {!! Form::submit('Update', ['class' => 'btn btn-lg btn-success']) !!}

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
@endsection