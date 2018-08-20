<div class="p-l-20 p-t-10">
    <h3>Search Engine Optimization Settings
        <span class="small-text text-muted pull-right p-r-10"><a href="http://docs.kaijuscripts.com/coinindex/"
                                                                 target="_blank"><i class="fa fa-external-link"></i> Online Documentation</a></span>
    </h3>
</div>

{!! Form::open(['class'=>'form', 'route' => 'private.settings_seo', 'method' => 'POST']) !!}

<div class="p-l-20 p-t-10">
    <h4>Analytics & Optimizations</h4>
</div>

@include('backend.partials.input-text', ['id' => \App\Library\Consts::GOOGLE_ANALYTICS_ID, 'label' => 'Google Analytics tracking ID', 'value' => setting(\App\Library\Consts::GOOGLE_ANALYTICS_ID), 'required' => false])

@include('backend.partials.input-check', ['id' => \App\Library\Consts::ENABLE_PAGE_SPEED, 'label' => 'Enable Page-speed module?', 'value' => 1, 'checked' => (bool)setting(\App\Library\Consts::ENABLE_PAGE_SPEED), 'required' => false])

<hr>

<div class="p-l-20 p-t-10">
    <h4>Custom URL Generation</h4>
</div>

@include('backend.partials.input-text', ['id' => \App\Library\Consts::COIN_URL_PREFIX, 'label' => 'URL Prefix for Coin Pages', 'value' => setting(\App\Library\Consts::COIN_URL_PREFIX, \App\Library\SeoHelper::COIN_URL_PREFIX), 'required' => false])

@include('backend.partials.input-text', ['id' => \App\Library\Consts::COIN_URL_SUFFIX, 'label' => 'Trailing Slug for Coin Page URL', 'value' => setting(\App\Library\Consts::COIN_URL_SUFFIX, \App\Library\SeoHelper::COIN_SLUG_TEMPLATE), 'required' => false])

<hr>

<div class="p-l-20 p-r-20 p-t-10">
    <h4>Title and Meta Tags</h4>

    @include('backend.partials.template-warning')
</div>

@include('backend.partials.input-text', ['id' => \App\Library\Consts::COIN_PAGE_TITLE, 'label' => 'Coin Page Title Template', 'value' => setting(\App\Library\Consts::COIN_PAGE_TITLE, \App\Library\SeoHelper::COIN_PAGE_TITLE_TEMPLATE), 'required' => false])

@include('backend.partials.input-text', ['id' => \App\Library\Consts::GENERAL_PAGE_TITLE, 'label' => 'General Page Title Template', 'value' => setting(\App\Library\Consts::GENERAL_PAGE_TITLE, \App\Library\SeoHelper::GENERAL_PAGE_TITLE_TEMPLATE), 'required' => false])

@include('backend.partials.input-text', ['id' => \App\Library\Consts::META_KEYWORDS, 'label' => 'Meta Keywords Template', 'value' => setting(\App\Library\Consts::META_KEYWORDS, \App\Library\SeoHelper::META_KEYWORDS_TEMPLATE), 'required' => false])

@include('backend.partials.input-textarea', ['id' => \App\Library\Consts::META_DESCRIPTION, 'label' => 'Meta Description Template', 'value' => setting(\App\Library\Consts::META_DESCRIPTION, \App\Library\SeoHelper::META_DESCRIPTION_TEMPLATE), 'required' => false, 'rows' => 8])

<hr>

{!! Form::submit('Save', ['class' => 'btn btn-lg btn-success m-l-20 m-b-20']) !!}

{!! Form::close() !!}