@extends('layouts.backend')

@section('title', 'Edit Translation')

@section('content')
    <div class="row">
        <div class="col-lg-9 col-xlg-10 col-md-8">
            <div class="card">

                <div class="m-l-20 m-r-20 m-t-5 m-b-5">
                    @include('flash::message')
                </div>

                <div class="p-l-20 p-t-10 p-r-20">
                    <h3>Translate Section: {{ $group }}
                        <span class="small-text text-muted pull-right p-r-10"><a
                                    href="http://docs.kaijuscripts.com/coinindex/"
                                    target="_blank"><i class="fa fa-external-link"></i> Online Documentation</a></span>
                    </h3>
                    <p>Translate your webpages by editing the text snippets below</p>
                    @include('backend.partials.template-warning')
                </div>

                {!! Form::open(['class'=>'form', 'route' => 'admin.lang.update', 'method' => 'POST']) !!}
                {!! Form::hidden('_group', $group) !!}

                @foreach($entries as $entry)
                    <div class="p-10">
                        <table class="table no-border">
                            <tr>
                                <td class="text-right"><strong>Key</strong></td>
                                <td><span class="text-warning">{{ $group }}.</span><span
                                            class="text-purple font-bold">{{ $entry->key }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Text</strong></td>
                                <td>{!! Form::textarea($entry->key, $entry->text['en'], ['class' => 'form-control', 'id' => $entry->key, 'rows' => 8]) !!}</td>
                            </tr>
                        </table>

                        <hr>
                    </div>
                @endforeach

                {!! Form::submit('Save', ['class' => 'btn btn-lg btn-success m-l-20 m-b-20']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('after-styles')
    <style>
        .alert-warning {
            color: #0c0c0c;
        }
    </style>
@endpush