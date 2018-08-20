<footer class="footer">

	
    @if($show_donate_button)
        <button type="button" class="btn btn-secondary btn-sm pull-right" data-toggle="modal" data-target="#myModal">Donate</button>
    @endif
    Copyright © {{ date('Y') }} {{ $app_name }}.<br/>
    <span class="small-text">Powered by <a class="link" href="https://codecanyon.net/item/coinindex-premium-cryptocurrency-market-prices-charts-application/21177305"
                                           target="_blank">CoinIndex</a></span>
</footer>

