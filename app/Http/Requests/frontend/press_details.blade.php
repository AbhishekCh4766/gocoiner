@extends('layouts.master')

@section('title', __('Press_Release'))

@section('content')


  <div class="prress-section press-release-inner-bx">
            <div class="row">
                 @foreach($press_release as $Press)
                <div class="col-xs-12 col-sm-12">
                     
                </div>  
                <div class="col-xs-12 col-sm-12 press-release">
                   
                    <div class="press-release">
                         <div class="col-xs-12 col-sm-4 recommendation-left ">
                             <img src="{{asset('public/images/press_release').'/' . $Press->pic}}" width="">
                        </div>
                        <div class="col-xs-12 col-sm-8 recommendation-right">
                             <h3>{{$Press->title}}</h3>
                            <p><?php echo strip_tags($Press->content); ?> </p>
                        </div>
                    </div>
                    @endforeach
                  
               </div>
             </div>
         
     </div>

@endsection