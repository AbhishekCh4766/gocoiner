@extends('layouts.master')

@section('title', \App\Library\SeoHelper::title())

@section('content')
<body>

{{ Form::open(array('url' => '/registration_page')) }}

    <ul class="errors">
    @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
    @endforeach
    </ul>

<center>

  <div class="row">
            <div class="registration-box">
               <h1>Registration Form</h1> 
            <div class="form-group">
              {{Form::label('username', 'Username', array('class' => 'col-lg-12 control-label'))}} 
              <div class="col-lg-12">
                {{ Form::text('username', $username = null, array('class' => 'form-control input-md', 'placeholder' => 'Username', 'required' => 'true')) }}
              </div>
            </div>

            <div class="form-group">
              {{Form::label('email', 'Email', array('class' => 'col-lg-12 control-label'))}}
              <div class="col-lg-12">
               {{Form::email('email', $value = null, array('class' => 'form-control input-md', 'placeholder' => 'abc@gmail.com', 'required' => 'true'))}} 
              </div>

            </div>

            <div class="form-group">
              {{Form::label('password', 'Password', array('class' => 'col-lg-12 control-label'))}}
              <div class="col-lg-12">
                {{Form::password('password', array('class' => 'form-control input-md', 'placeholder' => 'at least 6 characters', 'required' => 'true|min:6'))}}
                <!-- <span class="help-block">at least 6 characters</span> -->
              </div>
            </div>

          <!--   <div class="form-group">
              {{Form::label('password_confirmation', 'Confirm Password', array('class' => 'col-md-4 control-label text-right'))}}
              <div class="col-lg-12">
                {{Form::password('password_confirmation', array('class' => 'form-control input-md', 'placeholder' => 'Confirm Password', 'required' => 'true|min:6'))}}
                <span class="help-block">at least 6 characters</span>
              </div>
            </div> -->

            <div class="col-lg-12">
                 <span class="help-block">By registering you agree to our Terms of Use and Privacy Policy</span>
                {{Form::submit('Register', array('class' => 'btn btn-primary'))}}
              </div>
               </div>
{{ Form::close() }}

</center>
</body>

@stop