@extends('layouts.master')

@section('title', __('news.page_title'))

@section('content')
    <div class="row">
        <div class="col-12">
            @foreach($pages as $page)
                <article>
                    <div class="card">
                        <div class="card-block">
                            <h4 class="card-title">
                                <a href="{{ route('pages.show', [$page->id, $page->slug]) }}">{{ $page->title }}</a>
                            </h4>
                            <div class="small-text">
                                <i class="fa fa-calendar"></i>&nbsp;&nbsp;{{ $page->last_updated_human }}
                            </div>
                            <p>{{ $page->excerpt }}</p>
                            <div class="bottom-article">
                                <a href="{{ route('pages.show', [$page->id, $page->slug]) }}"
                                   class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __('news.read_more') }}
                                    <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach

            <nav>{!! $pages->render('vendor.pagination.simple-bootstrap-4') !!} </nav>
        </div>
    </div>
@endsection