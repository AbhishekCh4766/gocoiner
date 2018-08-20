@extends('layouts.starter')

@section('content')
    <section id="wrapper">
        <div class="login-box card">
            <div class="card-block">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal form-material" method="POST" action="{{ route('frontendauth.password.email') }}">
                    {{ csrf_field() }}

                    <h3 class="box-title m-b-20">Reset Password</h3>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-6 control-label">E-Mail Address</label>

                        <div class="col-md-9">
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Send Password Reset Link
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection