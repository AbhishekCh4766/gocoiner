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
  

 <section id="wrapper" class="login-page-new-reset-form">
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
                <form class="form-horizontal form-material" method="POST" action="{{ url('save-password') }}/{{$id}}">
                    {{ csrf_field() }}

                    <h2 class="box-title m-b-20">Reset Password</h2>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <!-- <label for="password" class="col-md-4 control-label">Enter New Password</label> -->

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                       <!--  <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label> -->
                        <div class="col-md-12">
                            <input id="confirm_password" type="password" class="form-control"
                                   name="confirm_password" required placeholder="confirm Password">

                            @if ($errors->has('confirm_password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" onclick="return Validate()">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
 <script>
    function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        if (password != confirmPassword) {
            alert("Passwords do not match Please Check.");
            return false;
        }
        return true;
    }
</script>
@stop