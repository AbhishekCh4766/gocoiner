@extends('layouts.master')

@section('title', __('Advertising'))

@section('content')


@foreach($pages as $data)
 <div>{{$data->title}}</div>
<div> <?php echo($data->content);?></div>
@endforeach
@endsection