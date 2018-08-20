@extends('layouts.master')

@section('title', \App\Library\SeoHelper::title())

@section('content')
<style>
.container-fluid{
    max-width: 100%;
    padding-right: 0px;
    padding-left: 0px;
    padding:0px;
    min-height: 500px; 
}
.page-wrapper{
    padding-top: 0px;
}
</style>
  

 <section id="wrapper" class="login-page-new-reset-password">
    <div class="logo padding-bottom-30" style="text-align:center"> <a href="https://gocoiner.com/">
                        <div class="logo-wrapper" style=" display: inline-block; margin-left:0"> <img src="https://gocoiner.com/public/images/header-logo.png" alt=""></div>
                        </a> </div>
        <div class="login-box card">
            <div class="card-block">
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
                 <form class="form-horizontal form-material" method="POST" action="{{ url('/send_link')}}">
                    
                    {{ csrf_field() }}

                    <h2 class="box-title m-b-20">Reset Password</h2>

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                       <!--  <label for="email" class="col-md-6 control-label">E-Mail Address</label> -->

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ $email or old('email') }}" required autofocus placeholder="Enter Your Registered Mail">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


 <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@stop