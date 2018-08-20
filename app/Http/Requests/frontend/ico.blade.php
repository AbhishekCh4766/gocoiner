@extends('layouts.master')
@section('meta_title'){{{ $ico_title or '' }}} @stop
@section('meta_desc'){{{ $ico_desc or '' }}} @stop
@section('styles')
    <link href="{{ URL::asset('public/css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('public/css/datatables/dataTables.responsive.css') }}" rel="stylesheet" />
    <style type="text/css">
    .ico-table>tbody>tr>td {
        vertical-align: middle !important; 
    }
    </style>
@stop
@section('scripts')
    <script src="{{ URL::asset('public/js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/js/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('public/js/datatables/dataTables.responsive.js') }}"></script>
    <script>
    $(document).ready(function() {
        $('#icos-table').DataTable({
            responsive: true,
             aLengthMenu: [[25, 50, 100, 200, -1],[25, 50, 100, 200, "All"]],
            "iDisplayLength": 50
        });
    });
    </script>
@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Top crypto initial coins offerings
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <table width="100%" class="ico-table table table-striped table-bordered table-hover" id="icos-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th width="280">Description</th>
                    <th>Start Time</th>
                     <th>End Time</th>
                    <!--@if($type == 'active')<th>Ends in</th>@endif
                    <th>Timezone</th> -->
                    <th>Website</th>
                    <th>ICO Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($icos as $ico)
                <tr class="odd gradeX">
                    <td>
                        <img alt="{{$ico->name}}" title="{{$ico->name}}" src="{{$ico->image}}" width="80" />
                    </td>
                    <td>{{$ico->name}}</td>
                    <td>{{$ico->description}}</td>
                    <td>{{$ico->start_time}}</td>
                    <td>{{$ico->end_time}}</td>
                   <!--  @if($type == 'active')<td>{{$ico->time_left}}</td>@endif
                    <td>{{$ico->timezone}}</td> -->
                    <td>
                        <a href="{{$ico->website}}" target="_blank"><button class="btn btn-primary">ICO Website</button></a>
                    </td>
                    <td>
                        <a href="{{$ico->icowatchlist_url}}" target="_blank"><button class="btn btn-primary">ICO Details</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
