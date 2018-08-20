@extends('layouts.master')

@section('title', \App\Library\SeoHelper::title())

@section('content')

<style>
.container-fluid{
	max-width: 100%;
	padding-right: 0px;
    padding-left: 0px;
    padding:0px;
}
.page-wrapper{
	padding-top: 0px;
}
</style>
  
    {{ Form::open(array('url' => '/registration_page')) }}
<center>

  <div class="row registration-box-section">
            <div class="registration-box">
			   <div class="row padding-top-50 padding-bottom-30 signup-top-bar">
					<div class="twelve columns text-center">
                          <ul class="errors">
    @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
    @endforeach
    </ul>
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
					  <div class="logo padding-bottom-30" style="text-align:center"> <a href="https://gocoiner.com/">
						<div class="logo-wrapper" style=" display: inline-block; margin-left:0"> <img src="https://gocoiner.com/public/images/header-logo.png" alt=""></div>
						</a> </div>
					  <h2>Create your Free Account</h2>
					  <p>Track your cryptocurrency portfolio with Gocoiner</p>
					</div>
			  </div>
  
                  <div class="row">
				  <div class="twelve columns">
					<div class="two columns"></div>
					<div class="eight columns">
					  <div class="six columns bg-blue-register-main register-icon-li listing-six">
						<ul>
						  <li>Easily monitor your portfolio(s)</li>
						  <li>Track value of crypto wallets</li>
						  <li>Build your asset watchlist</li>
						  <li>Curate news and events</li>
						  <li>Premium Recommendations for Free (Market Experts Recommendations)</li>
						</ul>
						</div>
						
						  <div class="six columns bg-blue-register-main register-icon-li listing-social">
                         <div class="form-icon"><ul>
						    <li><a href="{{ url('login/google') }}"><img src="{{url('public/images/gplus-new.png')}}"><p>Sign in with Google</p></a></li>
							<li><a href="{{ url('login/twitter') }}"><img src="{{url('public/images/t.png')}}"><p>Sign in with Twitter</p></a></li>
							</ul>
                        </div>
						<p style="margin: 32px 0 35px; float:left; width:100%; text-align: center;border-top: 1px solid #555;color: #666; position:relative;">
						<!-- <span style="top: -11px; display: inline-block;background:#232e42; position: absolute; margin-left: -16px; font-size: 14px;">OR</span> -->
						    <div class="form-group">
							  {{Form::label('username', 'Username', array('class' => 'col-lg-12 control-label'))}} 
							  <div class="col-lg-12 input-box-social-icon">
								{{ Form::text('username', $username = null, array('class' => 'form-control input-md', 'placeholder' => 'name', 'required')) }}
								<small class="text-danger">{{ $errors->first('username') }}</small>
							  </div>
							</div>

							<div class="form-group">
							  {{Form::label('email', 'Email', array('class' => 'col-lg-12 control-label'))}}
							  <div class="col-lg-12 input-box-social-icon">
							   {{Form::email('email', $value = null, array('class' => 'form-control input-md', 'placeholder' => 'abc@gmail.com', 'required', 'pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$'))}} 

							   <small class="text-danger">{{ $errors->first('email') }}</small>
							  </div>

							</div>

							<div class="form-group">
							  {{Form::label('password', 'Password', array('class' => 'col-lg-12 control-label'))}}
							  <div class="col-lg-12 input-box-social-icon">
								{{Form::password('password', array('class' => 'form-control input-md', 'placeholder' => 'Min 6 charachers', 'required'))}}
								 <small class="text-danger">{{ $errors->first('password') }}</small>
							  </div>
							</div>
							 <div class="col-lg-12 input-box-button">
								 
								{{Form::submit('Create Account', array('class' => 'btn btn-primary'))}}
								    <span class="help-block">By registering you agree to our <a href="{{url('/page/terms')}}" target="blank">Terms of Use</a>  and <a href="{{url('/page/privacy-policy')}}" target="blank"> Privacy Policy</a></span>
							 </div>
						</div>
  
           
        

          <!--   <div class="form-group">
              {{Form::label('password_confirmation', 'Confirm Password', array('class' => 'col-md-4 control-label text-right'))}}
              <div class="col-lg-12">
                {{Form::password('password_confirmation', array('class' => 'form-control input-md', 'placeholder' => 'Confirm Password', 'required' => 'true|min:6'))}}
                <span class="help-block">at least 6 characters</span>
              </div> Secret key-6LfLNlIUAAAAAB2QJS3nmOsmPWO-cGu64RirWlqw
            </div> -->

                            <!--<div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LfLNlIUAAAAAIevb8k5_rLTMo_9LJQ_ktJ85ONE" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                            <input class="form-control d-none" data-recaptcha="true" required data-error="Please complete the Captcha">
                            <div class="help-block with-errors"></div>
                            </div>-->
                
           

               </div>
                   {{ Form::close() }}

</center>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
      $(function () {

    window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change')
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change')
    }

    $('#contact-form').validator();

    $('#contact-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = "/registration_page";

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data) {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#contact-form').find('.messages').html(alertBox);
                        $('#contact-form')[0].reset();
                        grecaptcha.reset();
                    }
                }
            });
            return false;
        }
    })
});
    </script>
</body>

@stop