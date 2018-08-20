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
  

 <section id="wrapper" class="login-page-new">
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
                <form class="form-horizontal form-material" id="loginform" method="POST"
				
			        <form method="POST" action="{{ url('post_login') }}">
                    {{ csrf_field() }}
                    
                    <h2 class="box-title m-b-20">Login to your Free Account</h2>
					    <div class="form-icon"><ul>
						    <li><a href="{{ url('login/google') }}"><img src="{{url('public/images/gplus-new.png')}}"><p>Sign in with Google</p></a></li>
							<li><a href="{{ url('login/twitter') }}"><img src="{{url('public/images/t.png')}}"><p>Sign in with Twitter</p></a></li>
							</ul>
                        </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                       

                        <div class="col-xs-6 input-box-email">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required="" autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div> 
						<!-- <label for="email" class="col-xs-4 control-label">E-Mail Address</label> -->
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      

                        <div class="col-xs-6 input-box-email">
                            <input id="password" type="password" class="form-control" placeholder="Password" name="password" required="">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
						  <!-- <label for="password" class="col-xs-4 control-label">Password</label> -->
                    </div>

                    <!--<div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>-->

                        <?php 

                            if(isset($_GET["from"])){
                        ?>
                        <input type="hidden" name="from" value="<?php echo $_GET["from"]; ?>">
                        <?php 
                            }
                        ?>


                    <div class="form-group login-button">
                        <div class="col-xs-12 div-button-main">
                            <button type="submit" class="btn btn-info btn-lg btn-block">Login</button>
                            <p>Forgot Your Password?<span><a class="btn btn-link pull-right" href="{{ url('/reset-password') }}">click here</a></span></p>
                            
                        </div>
                    </div>
                    
                        <div class="form-group m-b-0 option_for_sign_up">
                            <div class="col-sm-12 text-center">
                                <p>Don't have an account with us? <a href="{{ url('/registration') }}"
                                                             class="text-info m-l-5"><b>Sign
                                            Up</b></a></p>
                            </div>
                        </div>

                </form>
            </div>
        </div>
    </section>

@stop