<div class="p-l-20 p-t-10">
    <h3>Monetization Settings
        <span class="small-text text-muted pull-right p-r-10"><a href="http://docs.kaijuscripts.com/coinindex/"
                                                          target="_blank"><i class="fa fa-external-link"></i> Online Documentation</a></span>
    </h3>
</div>

{!! Form::open(['class'=>'form', 'route' => 'private.settings_monetization', 'method' => 'POST']) !!}

@include('backend.partials.input-text', ['id' => 'ADSENSE_PUB_ID', 'label' => 'Google Adsense Publisher ID', 'value' => setting('ADSENSE_PUB_ID'), 'required' => false])

@include('backend.partials.input-text', ['id' => 'ADSENSE_SLOT1_ID', 'label' => 'Adsense Slot #1 ID', 'value' => setting('ADSENSE_SLOT1_ID'), 'required' => false])

@include('backend.partials.input-text', ['id' => 'ADSENSE_SLOT2_ID', 'label' => 'Adsense Slot #2 ID', 'value' => setting('ADSENSE_SLOT2_ID'), 'required' => false])

@include('backend.partials.input-textarea', ['id' => 'AFFILIATE_LINKS', 'label' => 'Affiliate Links', 'value' => setting('AFFILIATE_LINKS'), 'required' => false, 'rows' => 8])

<hr>

<div class="p-l-20">
    <h3>Donation Details</h3>
    <p>Provide your cryptocurrency wallets to receive donation from visitors</p>
</div>

@include('backend.partials.input-text', ['id' => 'DONATE_BTC', 'label' => 'Bitcoin Wallet', 'value' => setting('DONATE_BTC'), 'required' => false])

@include('backend.partials.input-text', ['id' => 'DONATE_ETH', 'label' => 'Ethereum Wallet', 'value' => setting('DONATE_ETH'), 'required' => false])

@include('backend.partials.input-text', ['id' => 'DONATE_LTC', 'label' => 'Litecoin Wallet', 'value' => setting('DONATE_LTC'), 'required' => false])

<hr>

{!! Form::submit('Save', ['class' => 'btn btn-lg btn-success m-l-20 m-b-20']) !!}

{!! Form::close() !!}