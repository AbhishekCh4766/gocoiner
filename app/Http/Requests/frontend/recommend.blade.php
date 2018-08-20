@extends('layouts.master')

@section('title', __('Recommendations'))

@section('content')


  <div class="prress-section press-release-inner">
            <div class="row">
				     <div class="col-12 news-bx">
            @foreach($recommendation as $Press)
                <article>
                    <div class="card card-block-inr-main">
                        <div class="card-block">
                            <div class="col-sm-3 tab-left-image-inr-page">
                                <div class="tab-left-image-inr-bx">
                                     <img src="{{asset('public/images/press_release').'/' . $Press->pic}}" width="">
                                </div>
                               
                            </div>
                            <div class="card-block-news-bx">
                                     <h4 class="card-title">
                                    <h5>{{ $Press->title }}</h5>
                                </h4>
                                
                            </div>
                            
                            <div class="col-sm-9">
                            
                                <p><?php echo strip_tags($Press->content); ?> </p>
                            </div>
                            
                            <div class="bottom-article">
                               <a href="{{url('recommendations')}}/{{$Press->id}}"
                                   class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __(' READ MORE') }}
                                    <i class="fa fa-angle-right"></i></a>
                            </div>
                            
                        </div>
                    </div>
                </article>
            @endforeach
      
        </div>
             </div>
         {!! $recommendation->links() !!}
     </div>

@endsection