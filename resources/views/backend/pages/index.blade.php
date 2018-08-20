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
                    <h4 class="card-title">Pages</h4>
                    <a href="{{ route('private.pages.custom') }}" class="btn btn-info btn-sm pull-right m-l-10"><i class="fa fa-plus-square-o"></i> Custom Page</a>
                    <a href="{{ route('private.pages.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-square-o"></i> Post</a>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <th>Title</th>
                            <th>Type</th>
                            <th class="text-right">Published</th>
                            <th class="text-right">Last Modified</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td><a href="{{ route('private.pages.show', $page->id) }}" target="_blank"> {{ $page->title }}</a></td>
                                    <td> {{ $page->type }}</td>
                                    <td class="text-right"> {!! $page->active ? '<span class="text-success"><i class="fa fa-check"></i></span>' : '<span class="text-warning"><i class="fa fa-times"></i></span>' !!}</td>
                                    <td class="text-right">{{ $page->last_updated }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-sm btn-secondary" href="{{ route('private.pages.edit', $page->id) }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>

                                        @include('backend.partials.delete-link', ['url' => route('private.pages.destroy', $page->id),  'form_id' => 'delete-page-' . $page->id])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <nav>{!! $pages->appends(\Request::except('page'))->render('vendor.pagination.bootstrap-4') !!}</nav>
                </div>
            </div>
        </div>
    </div>

@endsection