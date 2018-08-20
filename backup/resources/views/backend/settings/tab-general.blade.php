<div class="p-l-20 p-t-10">
    <h3>Website Settings
        <span class="small-text text-muted pull-right p-r-10"><a href="http://docs.kaijuscripts.com/coinindex/"
                                                                 target="_blank"><i class="fa fa-external-link"></i> Online Documentation</a></span>
    </h3>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! Form::open(['class'=>'form', 'route' => 'admin.settings_general', 'method' => 'POST']) !!}


@include('backend.partials.input-text', ['id' => \App\Library\Consts::APP_NAME, 'label' => 'Website Name *', 'value' => setting(\App\Library\Consts::APP_NAME), 'required' => true])

@include('backend.partials.input-text', ['id' => \App\Library\Consts::APP_URL, 'label' => 'Website URL *', 'value' => setting(\App\Library\Consts::APP_URL), 'required' => true])

@include('backend.partials.input-select', ['id' => \App\Library\Consts::APP_LOCALE, 'label' => 'Website Language *', 'required' => true, 'selected' => setting(\App\Library\Consts::APP_LOCALE, 'en'), 'options' => \App\Library\Languages::languageChoices(), 'col' => 7])

@include('backend.partials.input-select', ['id' => \App\Library\Consts::THEME_COLOR, 'label' => 'Color Theme *', 'required' => true, 'selected' => setting(\App\Library\Consts::THEME_COLOR), 'options' => ['blue' => 'Blue', 'green' => 'Green', 'purple' => 'Purple', 'red' => 'Red', 'cyan' => 'Cyan'], 'col' => 7])

<hr>

<div class="p-l-20">
    <h3>Administrator Details</h3>
</div>

@include('backend.partials.input-text', ['id' => 'ADMIN_EMAIL', 'label' => 'Administrator Email *', 'value' => setting('ADMIN_EMAIL'), 'required' => true])

@include('backend.partials.input-check', ['id' => 'ENABLE_REGISTRATION', 'label' => 'Allow new admin user registration?', 'value' => 1, 'checked' => (bool)setting('ENABLE_REGISTRATION')])

<hr>

<div class="p-l-20">
    <h3>Display Settings</h3>
</div>

@include('backend.partials.input-number', ['id' => 'COIN_LIST_COUNT', 'label' => 'Number of Coin Listings Per Page', 'value' => setting('COIN_LIST_COUNT', 10), 'required' => false, 'min'=> 10, 'max'=> 100])

@include('backend.partials.input-number', ['id' => 'ARTICLE_LIST_COUNT', 'label' => 'Post/News Listings Per Page', 'value' => setting('ARTICLE_LIST_COUNT', 10), 'required' => false, 'min'=> 5, 'max'=> 50])

@include('backend.partials.input-number', ['id' => 'PRECISION_CURRENCY', 'label' => 'Cryptocurrency Price Decimal Points', 'value' => setting('PRECISION_CURRENCY', 2), 'required' => false, 'min'=> 0, 'max'=> 6])

@include('backend.partials.input-number', ['id' => 'PRECISION_PERCENT', 'label' => 'Change Percentage Decimal Points', 'value' => setting('PRECISION_PERCENT', 2), 'required' => false, 'min'=> 0, 'max'=> 6])

@include('backend.partials.input-number', ['id' => 'TOP_MOVERS_VOLUME', 'label' => 'Top Mover Min. 24H Volume (USD)', 'value' => setting('TOP_MOVERS_VOLUME', 50000), 'required' => false, 'min'=> 0, 'max'=> 1000000])

<hr>

<div class="p-l-20">
    <h3>Comment Settings</h3>
</div>

@include('backend.partials.input-check', ['id' => 'ENABLE_DISQUS', 'label' => 'Enable Disqus.com integration?', 'value' => 1, 'checked' => setting('ENABLE_DISQUS')])

@include('backend.partials.input-text', ['id' => 'DISQUS_USERNAME', 'label' => 'Disqus.com Shortname', 'value' => setting('DISQUS_USERNAME'), 'required' => false])

<hr>

{!! Form::submit('Save', ['class' => 'btn btn-lg btn-success m-l-20 m-b-20']) !!}

{!! Form::close() !!}