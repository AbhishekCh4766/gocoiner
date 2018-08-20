@extends('layouts.master')
@section('title', __('Contact-us'))
@section('content')


     <div class="contact-form-full-page">
      <div class="contact-us-inner">
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
		<div class="login-logo" style="">
			<img src="https://gocoiner.com/public/images/header-logo.png" alt="">
		</div>
        <h2>Contact us</h2>
        <p>get in touch with us by filling form below</p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        {!! Form::open(['route' => 'contact.store', 'class' => 'contactForm', 'method' => 'POST']) !!}
        <div class="form-group">
            <!-- {!! Form::label('Your Name') !!} -->
            {!! Form::text('name', null, ['required', 'class'=>'form-control', 'placeholder'=>'Name']) !!}
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>

        <div class="form-group">
            <!-- {!! Form::label('Your E-mail Address') !!} -->
            {!! Form::email('email', null, ['required', 'class'=>'form-control', 'placeholder'=>'Email']) !!}
            <small class="text-danger">{{ $errors->first('email') }}</small>
        </div>

        <div class="form-group">
            <!-- {!! Form::label('Your Message') !!} -->
            {!! Form::textarea('message', null,
                ['required', 'class'=>'form-control', 'placeholder'=>'Message(Min 10 characters req)','pattern="[A-Za-z]{10}"']) !!}
                <small class="text-danger">{{ $errors->first('message') }}</small>
        </div>
           <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LfLNlIUAAAAAIevb8k5_rLTMo_9LJQ_ktJ85ONE" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                            <input class="form-control d-none" data-recaptcha="true" required data-error="Please complete the Captcha">
                            <div class="help-block with-errors"></div>
                            </div>
        <div class="form-group">
            {!! Form::submit('Contact Us!',
              ['class'=>'btn btn-primary btn-lg']) !!}
        </div>
        {!! Form::close() !!}

    </div>
</div>

   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    
    <script>
      $(function () {

    window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change')
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change')
    }

    //$('#contact-form').validator();

    $('#contact-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = "/contact.store";

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
@endsection