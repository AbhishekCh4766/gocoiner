@extends('layouts.backend')

@section('title', 'Cryptocurrencies')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="m-l-20 m-r-20 m-t-5 m-b-5">
                    @include('flash::message')
                </div>

                <div class="card-block">
                    <h4 class="card-title">Menus</h4>
                    <a href="{{ route('private.menus.create') }}" class="btn btn-success btn-sm pull-right m-l-10">
                        <i class="fa fa-plus-square-o"></i> New Menu
                    </a>
                    <div class="table-responsive">
                        @include('backend.menus.partials.table-menus', ['menus' => $menus])
                    </div>

                    <nav>{!! $menus->appends(\Request::except('page'))->render('vendor.pagination.bootstrap-4') !!}</nav>
                </div>
            </div>
        </div>
    </div>

@endsection