<div class="p-l-20 p-t-10">
    <h3>Styling and Javascript Customizations
        <span class="small-text text-muted pull-right p-r-10"><a href="http://docs.kaijuscripts.com/coinindex/"
                                                                 target="_blank"><i class="fa fa-external-link"></i> Online Documentation</a></span>
    </h3>
    <p>Paste custom stylesheet and javascript code to include in each page.</p>
</div>

{!! Form::open(['class'=>'form', 'route' => 'private.settings_customization', 'method' => 'POST']) !!}

@include('backend.partials.input-textarea', ['id' => 'CUSTOM_CSS', 'label' => 'Custom Styles', 'rows' => 10, 'col' => 8, 'text_col' => 3, 'value' => setting('CUSTOM_CSS'), 'required' => false])

@include('backend.partials.input-textarea', ['id' => 'CUSTOM_JS', 'label' => 'Custom Javascript', 'rows' => 10, 'col' => 8, 'text_col' => 3, 'value' => setting('CUSTOM_JS'), 'required' => false])

<hr>

{!! Form::submit('Save', ['class' => 'btn btn-lg btn-success m-l-20 m-b-20']) !!}

{!! Form::close() !!}