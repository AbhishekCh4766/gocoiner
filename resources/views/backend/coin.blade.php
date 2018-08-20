@extends('layouts.backend')

@section('title', 'Edit ' . $coin->name)

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xlg-3 col-md-4">
            <div class="card">
                <div class="card-block">
                    <center><img src="{{ asset('asset/images/coins/img/'. $coin->logo ) }}"
                                 class="img-circle" width="200"/>
                        <h4 class="card-title m-t-10">{{ $coin->name }}</h4>
                        <h6 class="card-subtitle">{{ $coin->symbol }}</h6>
                        <div class="text-center justify-content-md-center">
                            <a href="{{ route('home.coin', $coin->symbol) }}"
                               class="btn btn-sm btn-rounded btn-secondary"
                               target="_blank"><i class="fa fa-external-link"></i> View {{ $coin->name }} Page</a>
                        </div>
                    </center>

                    <small class="text-muted p-t-20 db">Last Updated</small>
                    <h6>{{ $coin->last_updated }}</h6>
                    <small class="text-muted">Website</small>
                    <h6>
                        @if (!blank($coin->website))
                            <a href="{!! $coin->website !!}" target="_blank">{{ str_limit($coin->website, 32) }}</a>
                        @else
                            N/A
                        @endif
                    </h6>
                    <small class="text-muted">Twitter</small>
                    <h6>
                        @if (!blank($coin->twitter))
                            <a href="https://twitter.com/{{ $coin->twitter  }}"
                               target="_blank">{{ str_limit($coin->twitter, 32) }}</a>
                        @else
                            N/A
                        @endif
                    </h6>
                </div>


            </div>
        </div>

        <div class="col-lg-9 col-xlg-9 col-md-6">
            <div class="card">

                <div class="card-block">
                    @include('flash::message')

                    <h4 class="card-title">Edit {{ $coin->name }} <sup>{{ $coin->symbol }}</sup> Page Content</h4>

                    {!! Form::open(['class'=>'form', 'route' => ['private.coins.update', $coin->id], 'method' => 'PUT']) !!}
                    <div class="form-group row">
                        <label for="description" class="col-2 col-form-label"><strong>Description</strong></label>
                        <div class="col-12">
                            {!! Form::textarea('description', markdown($coin->description), ['id' => 'description', 'rows' => 5, 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="feature" class="col-2 col-form-label"><strong>Feature</strong></label>
                        <div class="col-12">
                            {!! Form::textarea('features', markdown($coin->features), ['id' => 'features', 'rows' => 5, 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="technology" class="col-2 col-form-label"><strong>Technology</strong></label>
                        <div class="col-12">
                            {!! Form::textarea('technology', markdown($coin->technology), ['id' => 'technology', 'rows' => 5, 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    {!! Form::submit('Save', ['class' => 'btn btn-lg btn-success']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-styles')
    {!! Html::style('asset/vendor/trumbowyg/ui/trumbowyg.css') !!}

    <style>
        .form-group {
            margin-bottom: 0 !important;
        }
    </style>
@endpush

@push('after-scripts')
    {!! Html::script('asset/vendor/trumbowyg/trumbowyg.js') !!}
@endpush

@section('extra-js')
    <script>
        (function ($) {
            'use strict';
            var defaultButtons = [
                ['viewHTML'],
                ['formatting'],
                ['strong', 'em'],
                ['link'],
                ['unorderedList', 'orderedList'],
                ['removeformat'],
                ['fullscreen']
            ];

            $('#description').trumbowyg({btns: defaultButtons});
            $('#features').trumbowyg({btns: defaultButtons});
            $('#technology').trumbowyg({btns: defaultButtons});
        })(jQuery);
    </script>
@endsection