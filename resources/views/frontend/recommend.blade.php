@extends('layouts.master')

@section('title', __('Recommendations'))

@section('content')


<div class="prress-section press-release-inner">
@if ($message = Session::get('success'))

<div class="alert alert-success alert-block">

<button type="button" class="close" data-dismiss="alert">×</button> 

<strong>{{ $message }}</strong>

</div>

@endif


@if ($message = Session::get('error'))

<div class="alert alert-danger alert-block">

<button type="button" class="close" data-dismiss="alert">×</button> 

<strong>{{ $message }}</strong>

</div>

@endif
            <div class="row">
				<div class="col-xs-12 col-sm-12">
                    <h3>Recommendations</h3>
				</div>	
                <div class="col-xs-12 col-sm-12 press-release">
                    @foreach($recommendation as $Press)
                    <div class="press-release-inner">
                         <div class="col-xs-12 col-sm-5 press-release-inner-image">
                             <img src="{{asset('public/images/press_release').'/' . $Press->pic}}" width="">
                        </div>
                        <div class="col-xs-12 col-sm-7 press-release-inner-text">
                            <h5>{{$Press->title}}</h5>
                            <p><?php echo strip_tags($Press->content); ?> </p>
                        </div>
                        <div class="bottom-article">
                                <a href="{{url('/recommendations/')}}/{{$Press->id}}" rel="nofollow" target="_blank"
                                   class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __('Read More') }}
                                    <i class="fa fa-angle-right"></i></a>
                            </div>
                    </div>
                    @endforeach
                  
               </div>
             </div>
         {!! $recommendation->links() !!}
     </div>

@endsection