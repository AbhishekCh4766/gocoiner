@extends('layouts.master')

@section('title', \App\Library\SeoHelper::title())

@section('content')


<div class="container thermogram-container">

  <div class="row">
      <div class="inr-thermogram">
      	@foreach($coins as $coin)
		  <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 single-thermogram" >
		  	
		  	@if ($coin->percent_change_24h <= 0)
			<div class="inr-thermogram-bx">
				<a href="{{ coin_url($coin) }}"> 
			@else	

            <div class="inr-thermogram-bx color-green-bx">
            		<a href="{{ coin_url($coin) }}"> 
            	@endif

			  <div class="thermogram-star-bx">
			  
			  <p>{{$coin->name}}</p> <span><i class="fa fa-star-o" aria-hidden="true"></i></span>
			  </div>
			  <div class="thermogram-star-bx-inr">
			  
			  <div class="thermogram-star-btv-bx">
			 <!--  <p>1</p> -->
			  <h3>{{$coin->symbol}} </h3>
			  <h4>{{$coin->percent_change_24h}}%</h4>
			   </div>
			   
			   <div class="thermogram-star-btv-bottom">
			   <h4>${{$coin->price_usd}} </h4>
			   <p><span>Vol: </span>${{$coin->volume_usd_24h}}  B</p>
			   <p><span>Cap: </span>${{$coin->market_cap_usd}} B</p>
			   
			   </div>
			  
			  
			  
			 
			  </div>
			  

			</div>
			</a>
		  </div>
         @endforeach
	<!-- 	    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="inr-thermogram-bx color-green-bx">
			  <div class="thermogram-star-bx">
			  <p>Ethereum</p> <span><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></span>
			  </div>
			  <div class="thermogram-star-bx-inr">
			  <a href="#">
			  <div class="thermogram-star-btv-bx">
			  <p>2</p>
			  <h3>ETH</h3>
			  <h4>1.28%</h4>
			   </div>
			   
			   <div class="thermogram-star-btv-bottom">
			   <h4>$406.20</h4>
			   <p><span>Vol: </span>$1.25 B</p>
			   <p><span>Cap: </span>$40.05 B</p>
			   
			   </div>
			  
			  
			  </a>
			  </div>
			</div>
		  </div>


		
	  </div>   -->
<div class="pagination-div" style="text-align: center;">
           {!! $coins->links() !!}
 </div>
  </div>  

</div>
@stop