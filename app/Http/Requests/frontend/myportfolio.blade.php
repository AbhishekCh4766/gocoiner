@extends('layouts.master')

@section('title', \App\Library\SeoHelper::title())

@section('content')

@php

$id = Auth::user()->id;
@endphp

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


@if ($message = Session::get('warning'))

<div class="alert alert-warning alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

	<strong>{{ $message }}</strong>

</div>

@endif


@if ($message = Session::get('info'))

<div class="alert alert-info alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

	<strong>{{ $message }}</strong>

</div>

@endif


@if ($errors->any())

<div class="alert alert-danger">

	<button type="button" class="close" data-dismiss="alert">×</button>	

	Please Select a date to submit form.

</div>

@endif

<div class="portfolio-main">
	<div class="container">
		<div class="row">
			<div class="portfolio-main-iner" style="width:90%">
				<div class="portfolio-add-botton">
					@if (count($port) != 0)
                  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Asset</button>
				<a type="button" href='{{url("/deleteportfolio")}}' onclick="return confirm('Are you sure you want to delete your entire portfolio?');" class="btn-delete">Delete Asset</a>

					@else
					
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Asset</button>
				<!-- <a type="button" href='{{url("/deleteportfolio")}}' onclick="return confirm('Are you sure you want to delete your entire portfolio?');" class="btn-delete">Delete Asset</a> -->
					<!-- Modal -->
					@endif
					<div class="modal fade" id="myModal" role="dialog">
						<form method="post" action="{{url('/add_portfolio')}}">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									{{csrf_field()}}
									<h5>Add an Asset</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<div class="dropdown">
										<label>Cryptocurrency</label>
										<select class="form-control selectpicker" id="coin_id" placeholder="" name="coin_id" data-live-search="true">
												@foreach ($coins as $coin)
							
											<option value="{{ $coin->id }}" data-tokens="{{ $coin->name }} {{ $coin->symbol }}" >{{ $coin->name }}({{ $coin->symbol }})</option>
						
							                     @endforeach 
										</select>
										
								</div>
                                
                           
					


									<div class="modal-text">
										
										<div class="form-group">
											<label for="usr">Amount Holding(No. of coins)</label>
											<input type="text" class="form-control" name="no_of_coins" id="no_of_coins" required="">
											<small class="text-danger">{{ $errors->first('no_of_coins') }}</small>
										</div>
									</div>

                                     <div class="modal-text">
										
										<div class="form-group">
											<label for="usr">Price in USD</label>
											<input type="text" class="form-control" name="booked_value_usd" id="booked_value_usd" >
											<small class="text-danger">{{ $errors->first('booked_value_usd') }}</small>
										</div>
									</div>
									<center><span>OR</span></center>

									<div class="modal-text">
										
										<div class="form-group">
											<label for="usr">Price in BTC</label>
											<input type="text" class="form-control" name="booked_value_btc" id="booked_value_btc" >
											<small class="text-danger">{{ $errors->first('booked_value_btc') }}</small>
										</div>
									</div>

									        <div class="datepicker-main">									
							<label>Select Tentative Buy Date: </label>
							<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
							<input class="form-control" name="purchased_date" type="text" required="" readonly />
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<small class="text-danger">{{ $errors->first('purchased_date') }}</small>
							</div>
							
							</div>

							<div class="modal-text">
										
										<div class="form-group">
											<label for="usr">Notes</label>
											
												<textarea class="form-control" name="notes" id="notes"></textarea>
											<small class="text-danger">{{ $errors->first('notes') }}</small>
										</div>
									</div>


								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button class="btn-add-asset" type="submit" value="Submit">Add Asset</button> 
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
				<div class="portfolio-value-box">
					<div class="social">
						<a href="javascript:void(0)" class="icon fb">
							<div class="social-content">
								<div class="social-img">
									<img src="{{url('public/images/protfolio.png')}}" alt="protfolio">
								</div>
								<div class="social-text">
									<h4>${{$total_current_value}}</h4>        
									<p>Total Current Value</p>
								</div>
							</div>
						</a>
						<a href="javascript:void(0)" class="icon tw">
							<div class="social-content">
								<div class="social-img">
									<img src="{{url('public/images/protfolio.png')}}" alt="protfolio">
								</div>
								<div class="social-text">
									<h4>${{$portfolioCountUSD}}</h4>			  
									<p>Total Buying Value</p>
								</div>
							</div>
						</a>
						<a href="javascript:void(0)" class="icon gp">
							<div class="social-content">
								<div class="social-img">
									<img src="{{url('public/images/protfolio.png')}}" alt="protfolio">
								</div>
								<div class="social-text">
									<h4> <?php echo count($port); ?></h4>
									<p>Portfolio Assets</p>
								</div>
							</div>
						</a>
						<a href="javascript:void(0)" class="icon fb">
							<div class="social-content">
								<div class="social-img">
									<img src="{{url('public/images/protfolio.png')}}" alt="protfolio">
								</div>
								<div class="social-text">
									<h4>{{$total_gain_loss}}</h4>        
									<p>Total Gain / Loss</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="portfolio-table">
					<!--Table-->
					<table class="table">
						<!--Table head-->
						<thead class="blue-grey lighten-4">
							<tr>
								<th>Name</th>
								<th>Price</th>
								<th>Number of Coins</th>
								<th>Current Value</th>
								<th>Buying Value</th>
								<th>GAIN/LOSS</th>
							</tr>
						</thead>
						<!--Table head-->
						<!--Table body-->
						<tbody>
                               	@foreach($port as $data)

							<tr>
						@php $qty= $data->no_of_coins * $data->price_usd; 

						$diff= $qty - ($data->buying_value);

						//echo $diff."=========".$data->booked_value; die;
						 
						$a = null;	
						if($diff > 0) 
						$a = 'Gain';
						elseif($diff == 0) 
						$a = 'Same';
                        else
                        $a= 'Loss';
						@endphp
								<th>{{$data->name}}</th>
								<td>${{number_format($data->price_usd,4)}}</td>
								<td>{{$data->no_of_coins}}</td>
								<td>${{number_format($qty,2)}}</td>
								<td>${{$data->buying_value}}</td>								
								<td class="{{$a}}"><b>{{$a}}:{{number_format($diff,2)}}</b></td>
							</tr>
						    @endforeach
					
						</tbody>
						<!--Table body-->
					</table>
					<!--Table-->
				</div>
			</div>
		</div>
	</div>
</div>
 	<script>
 		jQuery.noConflict();
        jQuery('#datepicker').datepicker();
	
    </script>
 <!--    <script type="text/javascript">
		jQuery(document).on('change','#coin_id',function(){
			var coin_id = jQuery(this).val();

            jQuery.ajax({
               type:'POST',
               headers: {
				    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				  },
               url:'https://gocoiner.com/getcoindetails',
               data:{coin_id: coin_id},
               success:function(data){
               		var price_btc = data.msg.price_btc;
               		var price_usd = data.msg.price_usd;

               		jQuery('#booked_value_usd').val(price_usd);
               		jQuery('#booked_value_btc').val(price_btc);
               }     
			});
		});

		// $('#holdings_qty').keyup(function(){
		// 	var qty = $(this).val();

		// 	if(qty != ''){
		// 		var b_usd = $(this).parent().parent().parent().find('#booked_value_usd').val();
		// 		var b_btc = $(this).parent().parent().parent().find('#booked_value_btc').val();
		// 		var pusd = qty * b_usd;
		// 		var pbtc = qty * b_btc;
		// 		$('#booked_value_usd').val(pusd);
		// 		$('#booked_value_btc').val(pbtc);
		// 	}else{
		// 		var b_usd = $(this).parent().parent().parent().find('#booked_value_usd_1').val();
		// 		var b_btc = $(this).parent().parent().parent().find('#booked_value_btc_1').val();
		// 		$('#booked_value_usd').val(b_usd);
		// 		$('#booked_value_btc').val(b_btc);
		// 	}
		// });
	</script> -->
@stop

