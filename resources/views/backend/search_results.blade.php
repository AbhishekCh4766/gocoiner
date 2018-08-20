@extends('layouts.backend')

@section('title', 'Cryptocurrencies')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Search Result For "{{ $q }}"
                        @include('backend.partials.search-form')
                    </h4>
                    <h6 class="card-subtitle">About {{ number_format($coins->total()) }} results</h6>

                    @include('backend.partials.table', ['coins' => $coins])
                    <nav>{!! $coins->appends(\Request::except('page'))->render('vendor.pagination.bootstrap-4') !!}</nav>
                </div>
            </div>
        </div>
    </div>

@endsection