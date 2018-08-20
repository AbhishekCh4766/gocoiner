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
                    <h4 class="card-title">News</h4>
                    <a href="{{ route('admin.newses.custom') }}" class="btn btn-info btn-sm pull-right m-l-10"><i class="fa fa-plus-square-o"></i> Custom Page</a>
                    <a href="{{ route('admin.newses.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-square-o"></i> Post</a>
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
                            @foreach($newses as $news)
                                <tr>
                                    <td><a href="{{ route('admin.newses.show', $news->id) }}" target="_blank"> {{ $news->title }}</a></td>
                                    <td> {{ $news->type }}</td>
                                    <td class="text-right"> {!! $news->active ? '<span class="text-success"><i class="fa fa-check"></i></span>' : '<span class="text-warning"><i class="fa fa-times"></i></span>' !!}</td>
                                    <td class="text-right">{{ $news->last_updated }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-sm btn-secondary"
                                           href="{{ route('admin.newses.edit', $news->id) }}"><i class="fa fa-pencil-square-o"></i></a>

                                        @include('backend.partials.delete-link', ['url' => route('admin.newses.destroy', $news->id),  'form_id' => 'delete-news-' . $news->id])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <nav></nav>
                </div>
            </div>
        </div>
    </div>

@endsection