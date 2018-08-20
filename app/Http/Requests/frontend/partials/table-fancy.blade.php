<table class="table stylish-table table-hover">
    <thead>
    <tr>
        <th colspan="2">@sortablelink('name', __('coin.currency'))</th>
        <th class="text-right">@sortablelink('price_usd', __('coin.price'))</th>
        <th class="text-right">@sortablelink('market_cap_usd', __('coin.market_cap'))</th>
        <th class="text-right">@sortablelink('volume_usd_24h', __('coin.volume_24h'))</th>
        <th class="text-right">@sortablelink('percent_change_1h', __('coin.change_1h'))</th>
        <th class="text-right">@sortablelink('percent_change_24h', __('coin.change_24h'))</th>
        <th class="text-right">@sortablelink('percent_change_7d', __('coin.change_7d'))</th>
    </tr>
    </thead>
    <tbody>
    @foreach($coins as $coin)
        <tr>
            <td style="width:48px; padding-right: 6px;">
                <span>
                    @if(isset($coin->logo))
                        <a href="{{ coin_url($coin) }}">
                            <img src="{{ asset('asset/images/coins/tn/' . $coin->logo) }}" width="30">
                        </a>
                    @endif
                </span>
           </td>
       
            <td>
                <h6>
                    <a href="{{ coin_url($coin) }}" class="d-none d-md-block d-lg-block d-xl-block"> {{ $coin->name }}</a>
                </h6>
                <small class="text-muted">{{ $coin->symbol }}</small>
            </td>

            <td class="text-right"><sup>$</sup> {{ $coin->price_usd }}</td>
            <td class="text-right"><sup>$</sup> {{ $coin->market_cap_usd }}</td>
            <td class="text-right"><sup>$</sup> {{ $coin->volume_usd_24h }}</td>
            @include('frontend.partials.change-td', ['value' => $coin->percent_change_1h, 'class' => 'text-right'])
            @include('frontend.partials.change-td', ['value' => $coin->percent_change_24h, 'class' => 'text-right'])
            @include('frontend.partials.change-td', ['value' => $coin->percent_change_7d, 'class' => 'text-right'])
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    TablesawConfig = {
        swipeHorizontalThreshold: 2,
        swipeVerticalThreshold: 20
    };
</script>