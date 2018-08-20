@extends('layouts.master')

@section('title', \App\Library\SeoHelper::title())

@section('content')
    <div class="row market-page">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                    <div class="col-lg-12">

                           <div class="card">
                            <div class="card-block">


                                


                                <div class="col-md-3 col-3 pull-right">

                                    <div class="dropdown pull-right">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $maxcoins }}
                                        </button>


                                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                               href="{{ route('home.market.pageSize', 10) }}">10</a>
                                            <a class="dropdown-item"
                                               href="{{ route('home.market.pageSize', 25) }}">25</a>
                                            <a class="dropdown-item"
                                               href="{{ route('home.market.pageSize', 50) }}">50</a>
                                            <a class="dropdown-item"
                                               href="{{ route('home.market.pageSize', 100) }}">100</a>
                                        </div>
                                    </div>
                                </div>
  <h4 class="card-title d-none d-md-block d-lg-block d-xl-block">{{ __('market.heading') }}</h4>


<!-- <iframe id="google_ads_frame1" name="google_ads_frame1" src="https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-1050531549663133&amp;output=html&amp;h=90&amp;slotname=7343786953&amp;adk=1162519243&amp;adf=646435420&amp;w=1110&amp;fwrn=3&amp;lmt=1521542345&amp;loeid=38893312%2C368226210&amp;rafmt=1&amp;format=1110x90&amp;url=http%3A%2F%2Fcoinindex.kaijuscripts.com%2Fmarket&amp;flash=0&amp;fwr=0&amp;rh=0&amp;rw=1110&amp;resp_fmts=3&amp;wgl=1&amp;dt=1521542345298&amp;bpp=14&amp;bdt=362&amp;fdt=26&amp;idt=110&amp;shv=r20180312&amp;cbv=r20170110&amp;saldr=aa&amp;correlator=5997900054756&amp;frm=22&amp;ga_vid=361757575.1521533958&amp;ga_sid=1521540237&amp;ga_hid=1899605770&amp;ga_fc=1&amp;pv=2&amp;icsg=2&amp;nhd=2&amp;dssz=2&amp;mdo=0&amp;mso=0&amp;u_tz=330&amp;u_his=11&amp;u_java=0&amp;u_h=900&amp;u_w=1600&amp;u_ah=876&amp;u_aw=1535&amp;u_cd=24&amp;u_nplug=0&amp;u_nmime=0&amp;adx=212&amp;ady=206&amp;biw=-12245933&amp;bih=-12245933&amp;isw=1525&amp;ish=342&amp;ifk=694088720&amp;scr_x=-12245933&amp;scr_y=-12245933&amp;eid=21061122%2C38893302%2C191880502%2C368226200%2C26835106%2C33895412%2C20040069%2C188690903&amp;oid=2&amp;top=http%3A%2F%2Fcoinindex.kaijuscripts.com%2F&amp;rx=0&amp;eae=0&amp;brdim=%2C%2C65%2C24%2C1535%2C24%2C1535%2C876%2C1535%2C342&amp;vis=1&amp;rsz=%7C%7CceE%7C&amp;abl=NS&amp;ppjl=f&amp;pfx=0&amp;fu=144&amp;bc=1&amp;ifi=1&amp;xpc=auoinntLyo&amp;p=http%3A//coinindex.kaijuscripts.com&amp;dtd=138" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allowfullscreen="true" style="" width="1110" height="90" frameborder="0"></iframe> -->

                                    
                               
                                @if(isset($adsense_pub_id, $adsense_slot1_id))
                                    @include('frontend.partials.adsense', ['slot_id' => $adsense_slot1_id])
                                @endif

                                <div class="table-responsive m-t-40 d-none d-md-block d-lg-block d-xl-block">
                                    @include('frontend.partials.table-fancy', ['coins' => $coins])
                                </div>

                                <div class="m-t-40 d-block d-sm-block d-md-none d-lg-none d-xl-none">
                                    @include('frontend.partials.table-stacked', ['coins' => $coins])
                                </div>

                                @if(isset($adsense_pub_id, $adsense_slot2_id))
                                    @include('frontend.partials.adsense', ['slot_id' => $adsense_slot2_id])
                                @endif

                            </div>

                              <!--  <iframe id="google_ads_frame2" name="google_ads_frame2" src="https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-1050531549663133&amp;output=html&amp;h=90&amp;slotname=7343786953&amp;adk=1162519243&amp;adf=3826087296&amp;w=1110&amp;fwrn=3&amp;lmt=1521541094&amp;loeid=38893312%2C368226210&amp;rafmt=1&amp;format=1110x90&amp;url=http%3A%2F%2Fcoinindex.kaijuscripts.com%2Fmarket&amp;flash=0&amp;fwr=0&amp;rh=0&amp;rw=1110&amp;resp_fmts=3&amp;wgl=1&amp;adsid=NT&amp;dt=1521541094330&amp;bpp=8&amp;bdt=408&amp;fdt=128&amp;idt=186&amp;shv=r20180312&amp;cbv=r20170110&amp;saldr=aa&amp;prev_fmts=1110x90&amp;correlator=6846706330186&amp;frm=22&amp;ga_vid=361757575.1521533958&amp;ga_sid=1521540237&amp;ga_hid=1763613767&amp;ga_fc=1&amp;pv=1&amp;icsg=2&amp;nhd=2&amp;dssz=2&amp;mdo=0&amp;mso=0&amp;u_tz=330&amp;u_his=10&amp;u_java=0&amp;u_h=900&amp;u_w=1600&amp;u_ah=876&amp;u_aw=1535&amp;u_cd=24&amp;u_nplug=0&amp;u_nmime=0&amp;adx=212&amp;ady=1123&amp;biw=-12245933&amp;bih=-12245933&amp;isw=1525&amp;ish=342&amp;ifk=694088720&amp;scr_x=-12245933&amp;scr_y=-12245933&amp;eid=21061122%2C38893302%2C191880502%2C368226200%2C20040069%2C389613004%2C21061320&amp;oid=3&amp;rx=0&amp;eae=0&amp;brdim=%2C%2C65%2C24%2C1535%2C24%2C1535%2C876%2C1535%2C342&amp;vis=1&amp;rsz=%7C%7CceE%7C&amp;abl=NS&amp;ppjl=f&amp;pfx=0&amp;fu=144&amp;bc=1&amp;ifi=2&amp;xpc=kjPekCqCSD&amp;p=http%3A//coinindex.kaijuscripts.com&amp;dtd=204" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allowfullscreen="true" style="" width="1110" height="90" frameborder="0"></iframe> -->
                        </div>
                    </div>

                    <!-- <nav class="nav-bar-table">{!! $coins->appends(\Request::except('page'))->render('vendor.pagination.simple-bootstrap-4') !!}</nav> -->
                <div class="pagination-div" style="text-align: center;">
                {!! $coins->links() !!}
                </div>
                </div>

    </div>
            </div>
        </div>


@stop




@push('after-styles')
    <link href="{{ asset('asset/vendor/tablesaw/stackonly/tablesaw.stackonly.css') }}" rel="stylesheet">
    <style>
        @media (max-width: 40em) {
            .tablesaw-stack tbody tr {
                border-bottom: 2px solid #91a0e9;
            }

            .tablesaw-stack td {
                padding: 8px 0;
                border-bottom: 1px dotted #ececec;
            }

            .tablesaw-stack td .tablesaw-cell-label {
                width: 40%;
                /*background: #fcfcfc;*/
            }

            .tablesaw-cell-content {
                /*float: right;*/
            }
        }
    </style>
@endpush

@push('after-scripts')
    <script src="{{ asset('asset/vendor/tablesaw/stackonly/tablesaw.stackonly.jquery.js') }}"></script>
    <script src="{{ asset('asset/vendor/tablesaw/tablesaw-init.js') }}"></script>

    <script>
/*
        $(function () {
            "use strict";
            Tablesaw.init();
        });
*/
    </script>
@endpush