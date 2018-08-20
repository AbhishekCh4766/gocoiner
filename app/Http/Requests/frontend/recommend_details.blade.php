@extends('layouts.master')

@section('title', __('Recommendations'))

@section('content')


  <div class="prress-section press-release-inner press-release-inner-bx">
            <div class="row">
                 @foreach($recommendation as $Press)
				<div class="col-xs-12 col-sm-12">
                    
				</div>	
                <div class="col-xs-12 col-sm-12 press-release">
                   
                    <div class="press-release">
                         <div class="col-xs-12 col-sm-5 recommendation-left">
                             <img src="{{asset('public/images/press_release').'/' . $Press->pic}}" width="">
                        </div>
                        <div class="col-xs-12 col-sm-7 recommendation-right">       
                            <h3>{{$Press->title}}</h3>
                     
                            <p><?php echo strip_tags($Press->content); ?> </p>
                        </div>
                    </div>
                    </div>
                    @endforeach
                  
               
             </div>
         
     </div>

@endsection