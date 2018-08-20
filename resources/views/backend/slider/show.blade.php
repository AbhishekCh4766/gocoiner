@extends('layouts.master')

@section('title', $slider->title)

@section('content')
    <div class="row">
        <div class="col-12">
            <article>
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">
                            {{ $slider->title }}
                        </h4>
                        <div class="small-text">
                            <i class="fa fa-calendar"></i>&nbsp;&nbsp;{{ $slider->updated_at }}
                        </div>
                        {!! $slider->content !!}
                    </div>
                </div>
            </article>
        </div>
    </div>
@endsection