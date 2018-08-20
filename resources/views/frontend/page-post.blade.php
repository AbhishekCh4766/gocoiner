@extends('layouts.master')

@section('title', $page->title)

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>{{ $page->title }}</h2>
            <hr>
            {!! $page->content !!}
        </div>
    </div>
@endsection