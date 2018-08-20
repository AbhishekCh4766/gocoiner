@extends('layouts.master')

@section('title', __('Press Details'))

@section('content')


  <div class="prress-section press-release-inner press-single-page">
            <div class="row">
                 @foreach($press_release as $Press)
				<div class="col-xs-12 col-sm-12">
                    
				</div>	
                <div class="col-xs-12 col-sm-12 press-release">
                   
                    <div class="press-release">
                         <div class="col-xs-12 col-sm-3 press-single-page-image">
                             <img src="{{asset('public/images/press_release').'/' . $Press->pic}}" width="">
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <h5>{{$Press->title}}</h5>
                            <p><?php echo ($Press->content); ?> </p>
                        </div>
                    </div>
                    </div>
                    @endforeach
                  
               
             </div>
         
     </div>

@endsection