<table class="table table-hover">
    <thead>
    <tr>
        <th class="text-center d-none d-md-block d-lg-block d-xl-block">#</th>
        <th>Name</th>
        <th class="text-right">{{ __('coin.price') }}</th>
        <th class="text-right">{{ __('coin.mkt_cap') }}</th>
        <th class="text-right">{{ __('coin.change') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td class="text-center d-none d-md-block d-lg-block d-xl-block">{{ $loop->index + 1 }}</td>
            <td class="txt-oflo"><a href="{{ coin_url($item) }}">{{ $item->symbol }}</a></td>
            <td class="text-right"><sup>$</sup> {{ $item->price_usd }}</td>
            <td class="text-right"><sup>$</sup> {{ $item->market_cap_usd }}</td>
            <td class="text-right"><span class="{{ $text_class }}">{{ $item->percent_change_24h }} %</span></td>
        </tr>
    @endforeach
    </tbody>
</table>