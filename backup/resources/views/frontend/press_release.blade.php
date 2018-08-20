@extends('layouts.master')

@section('title', __('Press_Release'))

@section('content')


  <div class="prress-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-11 press-release">
                    <h3>PRESS RELEASE</h3>
                    @foreach($press_release as $Press)
                    <div class="row press-release-inner">
                         <div class="col-xs-12 col-sm-2">
                                  
                             <img src="{{asset('public/images/press_release').'/' . $Press->pic}}" width="">
                        </div>
                        <div class="col-xs-12 col-sm-10">
                            <h5>{{$Press->title}}</h5>
                            <p><?php echo strip_tags($Press->content); ?> </p>
                        </div>
                    </div>
                    @endforeach
                  
               </div>
             </div>
         </div>
         {!! $press_release->links() !!}
     </div>

@endsection