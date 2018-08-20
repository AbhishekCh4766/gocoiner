@extends('layouts.master')

@section('title', $Press_release->title)

@section('content')
    <div class="row">
        <div class="col-12">
            <article>
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">
                            {{ $Press_release->title }}
                        </h4>
                        <div class="small-text">
                            <i class="fa fa-calendar"></i>&nbsp;&nbsp;{{ $Press_release->last_updated }}
                        </div>
                        {!! $Press_release->content !!}
                    </div>
                </div>
            </article>
        </div>
    </div>
@endsection