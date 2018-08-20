@extends('layouts.master')

@section('title', \App\Library\SeoHelper::title($coin))

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12 inner-market-coin-upper-section">
                <div class="card">
                    <div class="card-block">

                        <div class="d-flex flex-row">
                            <div class="img-width">
								<img src="{{ asset('asset/images/coins/img/'. $coin->logo) }}" class="img-rounded" height="80">
							</div>
                            <div class="p-l-20 market-coin-text">
                                <h1 class="font-medium small-heading">{{ $coin->name }} <sup>{{ $coin->symbol }}</sup> {{ __('coin.h1') }}</h1>
                                <p>{{ \App\Library\SeoHelper::metaDescription($coin) }}</p>
                               <!--  @if(isset($has_affiliate_links))
                                    <div class="pull-right">
                                        <a href="{{ \App\Library\Helper::randomAffiliateLink() }}" target="_blank"
                                           rel="nofollow">
                                            <button class="btn btn-danger" type="button">
                                                <span class="btn-label">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </span>
                                                {{ __('coin.affiliate_link', ['coin_name' => $coin->name]) }}
                                            </button>
                                        </a>
                                    </div>
                                @endif -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @if(isset($adsense_pub_id) && isset($adsense_slot1_id))
            @include('frontend.partials.adsense', ['slot_id' => $adsense_slot1_id])
        @endif

        <div class="row graph-coin-section">
				
			<div class="col-lg-12 graph-coin-four-sections-outer">
				<div class="row">	
					<div class="graph-coin-four-sections">	
						@include('frontend.partials.coin_widget', ['col_size' => 3, 'class'=>'name', 'title' => __('coin.price'), 'subtitle' => 'USD', 'price' => $coin->price_usd, 'footer' => (isset($coin->price_btc) && $coin->price_btc != 1) ? $coin->price_btc : '', 'footer_sub' => 'BTC'])

						@include('frontend.partials.coin_widget', ['col_size' => 3, 'title' => __('coin.market_cap'), 'subtitle' => 'USD', 'price' => $coin->market_cap_usd, 'footer' => null, 'footer_sub' => null])

						@include('frontend.partials.coin_widget', ['col_size' => 3, 'title' => __('coin.change_1h'), 'subtitle' => '%', 'price' => \App\Library\Helper::arrowSignal($coin->percent_change_1h), 'footer' => null, 'footer_sub' => null])

						@include('frontend.partials.coin_widget', ['col_size' => 3, 'title' => __('coin.change_24h'), 'subtitle' => '%', 'price' => \App\Library\Helper::arrowSignal($coin->percent_change_24h), 'footer' => null, 'footer_sub' => null])
					</div>	
				</div>	
			</div>	

            <div class="col-lg-12 market-innercoin">
                <div class="card market-innercoin-graph">
                    <div class="card-block">
                        <h4 class="card-title text-center">{{ __('coin.historical_chart', ['coin_name' => $coin->name, 'coin_symbol' => $coin->symbol]) }}</h4>
                        <div style="background: url({{ asset('asset/images/coins/img/' . $coin->logo) }}) no-repeat center center; position: absolute; height: 100%; width: 100%; opacity: 0.15;"></div>

                        <div class="btn-group" role="group" id="ranges">
                            <button data-range='7' type="button"
                                    class="btn btn-sm btn-info"> {{ __('coin.7d') }}</button>
                            <button data-range='30' type="button"
                                    class="btn btn-sm btn-secondary"> {{ __('coin.1m') }}</button>
                            <button data-range='60' type="button"
                                    class="btn btn-sm btn-secondary"> {{ __('coin.2m') }}</button>
                            <button data-range='90' type="button"
                                    class="btn btn-sm btn-secondary"> {{ __('coin.3m') }}</button>
                            <button data-range='180' type="button"
                                    class="btn btn-sm btn-secondary"> {{ __('coin.6m') }}</button>
                            <button data-range='365' type="button"
                                    class="btn btn-sm btn-secondary"> {{ __('coin.1y') }}</button>
                            <button data-range='1000' type="button"
                                    class="btn btn-sm btn-secondary"> {{ __('coin.all') }}</button>
                        </div>

                        <div id="price_chart" style="height: 400px;"></div>
                        <div id="volume_chart" style="height: 200px;"></div>

                    </div>
                </div>

                @if(isset($adsense_pub_id, $adsense_slot2_id))
                    @include('frontend.partials.adsense', ['slot_id' => $adsense_slot2_id])
                @endif

                <div class="card coin-bottom-tabs">
                    <div class="card-block p-b-0">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs customtab" role="tablist">
                            @if (!blank($coin->description))
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#info"
                                                        role="tab"><span
                                                class="hidden-sm-up"><i class="ti-home"></i></span> <span
                                                class="hidden-xs-down">{{ __('coin.info') }}</span></a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-kfi"
                                                    role="tab"><span
                                            class="hidden-sm-up"><i class="ti-dashboard"></i></span> <span
                                            class="hidden-xs-down">{{ __('coin.kfi') }}</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_hx" role="tab"><span
                                            class="hidden-sm-up"><i class="ti-bar-chart"></i></span> <span
                                            class="hidden-xs-down">{{ __('coin.hist_data') }}</span></a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            @if (!blank($coin->description))
                                <div class="tab-pane active" id="info" role="tabpanel">
                                    <div class="p-20">
                                        <h3>{{ __('coin.description') }}</h3>
                                        @markdown($coin->description)

                                        @if(!blank($coin->start_date))
                                            <p>{{ __('coin.gen_date') }}: {{ $coin->start_date }}</p>
                                        @endif
                                        @if(!blank($coin->website))
                                            <p>{{ __('coin.website') }}: <a href="{{ $coin->website }}"
                                                                            target="_blank">{{ $coin->website }}</a></p>
                                        @endif
                                    </div>
                                    @if (!blank($coin->features))
                                        <div class="p-20">
                                            <h3>{{ __('coin.features') }}</h3>
                                            @markdown($coin->features)
                                        </div>
                                    @endif

                                    @if (!blank($coin->technology))
                                        <div class="p-20">
                                            <h3>{{ __('coin.technology') }}</h3>
                                            @markdown($coin->technology)
                                        </div>
                                    @endif

                                </div>
                            @endif

                            <div class="tab-pane p-20" role="tabpanel" id="tab-kfi">
                                <div class="table-responsive kfi-table">
                                    <table class="table table-condensed">
                                        @foreach(array_chunk($table_rows, 2) as $rows)
                                            <tr>
                                                @foreach($rows as $row)
                                                    <td><strong>{{ $row[0] }}</strong></td>
                                                    <td class="text-right">{!! $row[1] !!}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane p-20 @if(blank($coin->description)) active @endif" id="tab_hx"
                                 role="tabpanel">
                                <div class="table-responsive m-t-40">
                                    <table id="historical-data" class="table table-bordered" data-page-length='10'>
                                        <thead>
                                        <tr>
                                            <th>{{ __('system.date') }}</th>
                                            <th>{{ __('coin.price') }}</th>
                                            <th>{{ __('coin.volume') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($disqus_enabled)
                        <div class="card-block p-b-0">
                            @include('frontend.partials.disqus')
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        var AJAX_URL = "{{ route('api.history') }}";
        var SYMBOL = "{{ $coin->symbol }}";
    </script>
@stop

@push('after-styles')
    <link href="{{ asset('asset/vendor/morrisjs/morris.css') }}" rel="stylesheet">
@endpush

@push('after-scripts')
    <script src="{{ asset('asset/vendor/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('asset/vendor/morrisjs/morris.js') }}"></script>
    <script src="{{ asset('asset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/chart.js') }}"></script>
@endpush