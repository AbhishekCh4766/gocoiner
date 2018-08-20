   @extends('layouts.master')

@section('title', __('Event-Calendar'))

@section('content')

<div class="Event-Calendar">
@php  $count =0; @endphp
 @foreach($data as $value)
   <div class="four columns">
              <div data-id="26783" class="popup-event bend-content" style="clear:both;cursor: pointer; " id="{{$value->id}}" data-toggle="modal" data-target="#myModal_{{$count}}" data-backdrop="static" data-keyboard="false">
                <div class="twelve columns text-center" >
                	<h1>{{$value->title}}</h1>
                    <div class="blockchain-county">
                    <div class="three columns">
                      <span style="color:#548ffe; text-align:  left;">{{ \Carbon\Carbon::parse($value->date_event)->format('d/m/y')}}</span>
                    </div>
                    <div class="six columns">
                        <span style="text-align:  center;"></span>
                    </div>
                 
                    <div class="three columns">
                       <span><a href="{{$value->source}}" target="blank"> Link</a></span>
                    </div>
                   </div> 
                </div>
							<div class="modal fade" id="myModal_{{$count}}" role="dialog">
							<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="myModal_{{$count}}">&times;</button>
							</div>
							<div class="modal-body">
								<h1>{{$value->title}}</h1>
							<p> {{$value->description}}</p>
					

							<span><font>Start Date:</font> {{ \Carbon\Carbon::parse($value->created_date)->format('Y/d/m')}}</span>
							<span><font>End Date:</font>  {{ \Carbon\Carbon::parse($value->date_event)->format('Y/d/m')}}</span>
							<button><a href="{{$value->source}}" target="blank"> VISIT WEBSITE</a></button>


							</div>
						<!-- 	<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="myModal_{{$count}}">Close</button>
							</div> -->
							</div>

							</div>
							</div>
               </div> 
               </div>
               @php $count++; @endphp
 @endforeach
 </div>
@endsection


