@extends('layouts.master')

@section('title', $page->title)

@section('content')
<style>
.container-fluid {
    width: 100%;
    max-width: 100%;
    padding: 0px;
}
.page-wrapper {
    padding: 0px;
}
.card-block {
    padding: 0px;
}
.full-container-div{
width:1280px;
margin:0 auto;
}
</style>
    <div class="row">
        <div class="col-12">
            <article style="width: 100%;">
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