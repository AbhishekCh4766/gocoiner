<div class="p-l-20 p-t-10">
    <h3>Email Settings
        <span class="small-text text-muted pull-right p-r-10"><a href="http://docs.kaijuscripts.com/coinindex/"
                                                                 target="_blank"><i class="fa fa-external-link"></i> Online Documentation</a></span>
    </h3>
</div>

{!! Form::open(['class'=>'form', 'route' => 'private.settings_system', 'method' => 'POST']) !!}

@include('backend.partials.input-select', ['id' => 'MAIL_DRIVER', 'label' => 'Email Driver *', 'required' => true, 'selected' => setting('MAIL_DRIVER'), 'options' => ['smtp' => 'SMTP', 'sendmail' => 'sendmail', 'mailgun' => 'mailgun'], 'col' => 7])

@include('backend.partials.input-text', ['id' => 'MAIL_HOST', 'label' => 'Email Server Host', 'value' => setting('MAIL_HOST'), 'required' => false])

@include('backend.partials.input-text', ['id' => 'MAIL_PORT', 'label' => 'Port', 'value' => setting('MAIL_PORT'), 'required' => false])

@include('backend.partials.input-text', ['id' => 'MAIL_USERNAME', 'label' => 'Username', 'value' => setting('MAIL_USERNAME'), 'required' => false])

@include('backend.partials.input-password', ['id' => 'MAIL_PASSWORD', 'label' => 'Password', 'required' => false])

@include('backend.partials.input-select', ['id' => 'MAIL_ENCRYPTION', 'label' => 'Encryption', 'required' => false, 'selected' => setting('MAIL_ENCRYPTION'), 'options' => ['none' => 'None', 'ssl' => 'SSL', 'tls' => 'TLS'], 'col' => 7])

<hr>


{!! Form::submit('Save', ['class' => 'btn btn-lg btn-success m-l-20 m-b-20', 'disabled' => true]) !!}

{!! Form::close() !!}