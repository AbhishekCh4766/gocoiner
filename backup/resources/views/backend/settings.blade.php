@extends('layouts.backend')

@section('title', 'Settings')

@section('content')
    <div class="row">
        <div class="col-lg-9 col-xlg-10 col-md-8">
            <div class="card">

                <div class="m-l-20 m-r-20 m-t-5 m-b-5">
                    @include('flash::message')
                </div>

                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#general" role="tab">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#seo" role="tab">SEO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#customization" role="tab">Customization</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#monetization" role="tab">Monetization</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#system" role="tab">System</a>
                    </li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane active" id="general" role="tabpanel">
                        @include('backend.settings.tab-general')
                    </div>

                    <div class="tab-pane" id="seo" role="tabpanel">
                        @include('backend.settings.tab-seo')
                    </div>

                    <div class="tab-pane" id="customization" role="tabpanel">
                        @include('backend.settings.tab-customization')
                    </div>

                    <div class="tab-pane" id="monetization" role="tabpanel">
                        @include('backend.settings.tab-monetization')
                    </div>

                    <div class="tab-pane" id="system" role="tabpanel">
                        @include('backend.settings.tab-system')
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('after-styles')
    <style>
        .card-block {
            padding-top: 8px !important;
            padding-bottom: 8px !important;
        }
    </style>
    {!! Html::style('asset/vendor/icheck/skins/square/blue.css') !!}
@endpush

@push('after-scripts')
    {!! Html::script('asset/vendor/icheck/icheck.min.js') !!}
    <script>
        $(document).ready(function () {
            $('.check').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
            });
        });
    </script>
@endpush