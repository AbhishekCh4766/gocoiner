@extends('layouts.master')

@section('title', __('news.page_title'))

@section('content')
<div class="main-news-page">
    <div class="row news-page">
        
        <form name="newsseach" action="{{url('news')}}" action="get">
        <div class="col-6">
            <div class="form-group">

                <input type="text" class="form-controller" class="search_news" id="search_news" name="q" placeholder="Search for News"></input>

                <!-- <input type="submit" value="submit"> -->
            </div>
        </div>

    </form>

        <div class="col-12 news-bx">
            @foreach($news as $data)
                <article>
                    <div class="card card-block-inr-main">
                        <div class="card-block">
							<div class="col-sm-3 tab-left-image-inr-page">
								<div class="tab-left-image-inr-bx">
									<img src="{{$data->image}}">
								</div>
								<div class="small-text">
									<i class="fa fa-calendar"></i>&nbsp;&nbsp;{{ $data->published_on }}
								</div>
							</div>
							<div class="card-block-news-bx">
									 <h4 class="card-title">
									<a href="{{$data->url}}" rel="nofollow"
									   target="_blank">{{ $data->title }}</a>
								</h4>
								
							</div>
							
							<div class="col-sm-9">
							
								<p>{{ $data->body }}</p>
							</div>
							
							<div class="bottom-article">
								<a href="{{ $data->url }}" rel="nofollow" target="_blank"
								   class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __('news.read_more') }}
									<i class="fa fa-angle-right"></i></a>
							</div>
							
                        </div>
                    </div>
                </article>
            @endforeach
      
        </div>
    </div>
<div class="pagination-div" style="text-align: center;">
           {!! $news->links() !!}
 </div>

@endsection

 </div>