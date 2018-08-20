@extends('layouts.master')

@section('title', __('Press_Release'))

@section('content')


  <div class="prress-section press-release-inner">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <h3>PRESS RELEASE</h3>
                </div>  
                <div class="col-xs-12 col-sm-12 press-release">
                   @foreach($press_release as $Press)
                    <div class="press-release-inner">
                         <div class="col-xs-12 col-sm-5 press-release-inner-image">
                             <img src="{{asset('public/images/press_release').'/' . $Press->pic}}" width="">
                        </div>
                        <div class="col-xs-12 col-sm-7 press-release-inner-text">
                            <h5>{{$Press->title}}</h5>
                            <p><?php echo strip_tags($Press->content); ?> </p>
                        </div>
                        <div class="bottom-article">
                                <a href="{{url('press-release')}}/{{$Press->id}}" rel="nofollow" target="_blank" class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __('Read More') }}
                                    <i class="fa fa-angle-right"></i></a>
                            </div>
                    </div>
                    @endforeach
                  
               </div>
             </div>
         {!! $press_release->links() !!}
     </div>

@endsection