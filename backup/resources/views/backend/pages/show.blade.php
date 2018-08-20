@extends('layouts.master')

@section('title', $page->title)

@section('content')
    <div class="row">
        <div class="col-12">
            <article>
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">
                            {{ $page->title }}
                        </h4>
                        <div class="small-text">
                            <i class="fa fa-calendar"></i>&nbsp;&nbsp;{{ $page->last_updated }}
                        </div>
                        {!! $page->content !!}
                    </div>
                </div>
            </article>
        </div>
    </div>
@endsection