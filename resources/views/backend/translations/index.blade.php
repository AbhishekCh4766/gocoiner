@extends('layouts.backend')

@section('title', 'Translations')

@section('content')
    <div class="row">
        <div class="col-lg-9 col-xlg-10 col-md-8">
            <div class="card">

                <div class="m-l-20 m-r-20 m-t-5 m-b-5">
                    @include('flash::message')
                </div>

                <div class="p-l-20 p-t-10">
                    <h3>Edit Translation Groups
                        <span class="small-text text-muted pull-right p-r-10"><a
                                    href="http://docs.kaijuscripts.com/coinindex/"
                                    target="_blank"><i class="fa fa-external-link"></i> Online Documentation</a></span>
                    </h3>
                </div>
                <div class="table-responsive m-10 p-20">
                    <table class="table table-bordered">
                        <thead>
                        <th>Language Groups</th>
                        <th class="text-right">
                            <a href="{{ route('private.lang.reseed') }}"
                               class="btn btn-sm btn-danger"><i class="fa fa-recycle"></i> Reset All</a>
                        </th>
                        </thead>
                        <tbody>
                        @foreach($groups as $_ => $group)
                            <tr>
                                <td>{{ title_case( $group->group ) }}</td>
                                <td class="text-right">
                                    <a href="{{ route('private.lang.edit', $group->group) }}"
                                       class="btn btn-sm btn-primary"> Edit</a>
                                    <a href="{{ route('private.lang.reset', $group->group) }}"
                                       class="btn btn-sm btn-warning"> Reset</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
