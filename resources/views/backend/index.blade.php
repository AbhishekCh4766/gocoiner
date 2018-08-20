@extends('layouts.backend')

@section('title', 'Administration')

@section('content')
    <div class="row">
        <div class="col-lg-9 col-xlg-10 col-md-8">
            <div class="row">
                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="d-flex flex-row">
                            <div class="p-10 bg-info">
                                <h3 class="text-white box m-b-0"><i class="ti-server"></i></h3></div>
                            <div class="align-self-center m-l-20">
                                <h3 class="m-b-0 text-info">{{ $coins_count }}</h3>
                                <h5 class="text-muted small-text m-b-0">Cryptocoins</h5></div>
                        </div>
                    </div>
                </div>
                <!-- Column -->

                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="d-flex flex-row">
                            <div class="p-10 bg-info">
                                <h3 class="text-white box m-b-0"><i class="ti-pencil"></i></h3></div>
                            <div class="align-self-center m-l-20">
                                <h3 class="m-b-0 text-info">{{ $posts_count }}</h3>
                                <h5 class="text-muted small-text m-b-0">Custom Pages</h5></div>
                        </div>
                    </div>
                </div>
                <!-- Column -->

                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="d-flex flex-row">
                            <div class="p-10 bg-info">
                                <h3 class="text-white box m-b-0"><i class="ti-world"></i></h3></div>
                            <div class="align-self-center m-l-20">
                                <h3 class="m-b-0 text-info">{{ $news_count }}</h3>
                                <h5 class="text-muted small-text m-b-0">News Articles</h5></div>
                        </div>
                    </div>
                </div>
                <!-- Column -->

                <!-- Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="d-flex flex-row">
                            <div class="p-10 bg-info">
                                <h3 class="text-white box m-b-0"><i class="ti-menu"></i></h3></div>
                            <div class="align-self-center m-l-20">
                                <h3 class="m-b-0 text-info">{{ $menus_count }}</h3>
                                <h5 class="text-muted small-text m-b-0">Custom Menus</h5></div>
                        </div>
                    </div>
                </div>
                <!-- Column -->

            </div>

            <div class="card">

                <div class="m-l-20 m-r-20 m-t-5 m-b-5">
                    @include('flash::message')
                </div>

                <div class="card-block">
                    <h4 class="card-title p-b-20">CoinIndex Administration Panel</h4>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="card bg-inverse">
                                <div class="card-block">
                                    <h4 class="text-white">Cached Data</h4>
                                    <a href="{{ route('private.execute', 'cache') }}"
                                       class="btn btn-secondary b-0 m-t-15 pull-right">Purge</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="card bg-light-info">
                                <div class="card-block">
                                    <h4>Compiled Views</h4>
                                    <a href="{{ route('private.execute', 'view') }}"
                                       class="btn btn-danger b-0 m-t-15 pull-right">Purge</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="card bg-purple">
                                <div class="card-block">
                                    <h4 class="text-white">Cron Jobs</h4>
                                    <a href="{{ route('private.execute', 'cron') }}"
                                       class="btn btn-secondary b-0 m-t-15 pull-right">Execute</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection