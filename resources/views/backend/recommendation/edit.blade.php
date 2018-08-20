@extends('layouts.backend')

@section('title', 'Edit Page')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">
                        Edit {{ $Recommendation->page_type == \App\Library\Consts::PAGE_TYPE_CUSTOM ? 'Custom': '' }} Page</h4>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {!! Form::open(['class'=>'form', 'route' => ['private.recommendation.update', $Recommendation->id],'files' => 'true','enctype'=>'multipart/form-data', 'method' => 'PUT']) !!}

                    {!! Form::hidden('page_type', $Recommendation->page_type) !!}

                    @include('backend.partials.input-text', ['id' => 'title', 'label' => 'Title', 'value' => old('title', $Recommendation->title), 'required' => true])

                    @include('backend.partials.input-text', ['id' => 'slug', 'label' => 'Slug', 'value' => old('slug', $Recommendation->slug), 'required' => false])

                    @include('backend.partials.input-number', ['id' => 'order', 'label' => 'Sort Order', 'value' => old('order', $Recommendation->order), 'required' => false, 'min' => 0, 'max' => 255])

                    @include('backend.partials.input-check', ['id' => 'active', 'label' => 'Publish?', 'value' => 1, 'checked' => (bool)old('active', $Recommendation->active), 'required' => false])

                    <div class="form-group">
                        <label for="content"
                               class="col-11">
                            <div class="form-group">
                            {!! Form::label('pic', 'pic:') !!}
                            {!! Form::file('pic', null, ['class' => 'form-control', 'enctype' => 'multipart/form-data']) !!}
                            </div>
                            </label>




                    <div class="form-group">
                        <label for="content"
                               class="col-4 col-form-label">{{ $Recommendation->page_type == \App\Library\Consts::PAGE_TYPE_CUSTOM ? 'Custom HTML Code': 'Page Content' }}</label>
                        <div class="col-11">
                            {!! Form::textarea('content', old('content', $Recommendation->content), ['id' => 'content', 'rows' => 25, 'class' => 'form-control', 'required' => true]) !!}
                        </div>
                    </div>

                    <hr>

                    {!! Form::submit('Update', ['class' => 'btn btn-lg btn-success']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('after-styles')
    @unless($Recommendation->page_type == \App\Library\Consts::PAGE_TYPE_CUSTOM)
        {!! Html::style('asset/vendor/trumbowyg/ui/trumbowyg.css') !!}
    @endunless
    <style>
        .card-block {
            padding-top: 8px !important;
            padding-bottom: 8px !important;
        }

        .form-group {
            margin-bottom: 0 !important;
        }
    </style>
@endpush

@push('after-scripts')
    @unless($Recommendation->page_type == \App\Library\Consts::PAGE_TYPE_CUSTOM)
        {!! Html::script('asset/vendor/trumbowyg/trumbowyg.js') !!}
    @endunless
@endpush

@section('extra-js')
    @unless($Recommendation->page_type == \App\Library\Consts::PAGE_TYPE_CUSTOM)
        <script>
            (function ($) {
                'use strict';
                var defaultButtons = [
                    ['viewHTML'],
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['superscript', 'subscript'],
                    ['link'],
                    ['insertImage'],
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                    ['unorderedList', 'orderedList'],
                    ['horizontalRule'],
                    ['removeformat'],
                    ['fullscreen']
                ];

                $('#content').trumbowyg({btns: defaultButtons});
            })(jQuery);
        </script>
    @endunless
@endsection