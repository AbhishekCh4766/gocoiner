@extends('layouts.master')

@section('title', $page->title)

@section('content')
    <div class="row">
        <div class="col-12">
            <article>
                <div class="card">
                    <div class="card-block">
                        <h1 class="card-title small-heading">
                            {{ $page->title }}
                        </h1>
                        <div class="small-text">
                            <i class="fa fa-calendar"></i>&nbsp;&nbsp;{{ $page->last_updated_human }}
                        </div>
                        {!! $page->content !!}
                    </div>
                </div>
            </article>
            @if ($disqus_enabled)
                <div class="card-block p-b-0">
                    @include('frontend.partials.disqus')
                </div>
            @endif
        </div>
    </div>
@endsection