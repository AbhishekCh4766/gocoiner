@extends('layouts.master')

@section('title', \App\Library\SeoHelper::title())

@section('content')
<div class="portfolio-main">
	<div class="container">
		<div class="row">
			<div class="portfolio-main-iner" style="width:90%">
				<div class="portfolio-add-botton">
					<button type="button" class="btn btn-info btn-lg" id="myBtn">Add portfolio</button>
					<button type="button" class="btn-delete">Delete</button>
					<!-- Modal -->
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<h5>Add an Asset</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<div class="dropdown">
										<label>Cryptocurrency</label>
										<button onclick="myFunction()" class="dropbtn">Bitcoin (BTC)
											<img src="{{url('public/images/drop.png')}}" alt="drop">
										</button>
										<div id="myDropdown" class="dropdown-content">
											<input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()"> <a href="#about">Ethereum (ETH)</a>
											<a href="#base">Ripple (XRP)</a>
											<a href="#blog">Bitcoin Cash (BCH)</a>
											<a href="#contact">Litecoin (LTC)</a>
											<a href="#custom">EOS (EOS)</a>
											<a href="#support">Ripple (XRP)</a>
											<a href="#tools">EOS (EOS)</a>
										</div>
									</div>
									<div class="modal-text">
										<p>The cryptocurrency you are currently holding</p>
										<div class="form-group">
											<label for="usr">Amount</label>
											<input type="text" class="form-control" id="usr">
											<p>The amount you are holding, decimals supported!</p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn-add-asset" data-dismiss="modal">Add Asset</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="portfolio-value-box">
					<div class="social">
						<a href="" class="icon fb">
							<div class="social-content">
								<div class="social-img">
									<img src="{{url('public/images/protfolio.png')}}" alt="protfolio">
								</div>
								<div class="social-text">
									<h4>13859.1600</h4>
									<p>Portfolio Value (USD)</p>
								</div>
							</div>
						</a>
						<a href="" class="icon tw">
							<div class="social-content">
								<div class="social-img">
									<img src="{{url('public/images/protfolio.png')}}" alt="protfolio">
								</div>
								<div class="social-text">
									<h4>4.0000</h4>
									<p>Portfolio Value (BTC)</p>
								</div>
							</div>
						</a>
						<a href="" class="icon gp">
							<div class="social-content">
								<div class="social-img">
									<img src="{{url('public/images/protfolio.png')}}" alt="protfolio">
								</div>
								<div class="social-text">
									<h4>4</h4>
									<p>Portfolio Assets</p>
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
								<th>Holdings</th>
								<th>Holding Value</th>
								<th>Booked Value</th>
							</tr>
						</thead>
						<!--Table head-->
						<!--Table body-->
						<tbody>
							<tr>
								<th>BTC</th>
								<td>$6892.2</td>
								<td>20.33</td>
								<td>$6892.2</td>
								<td>$6892.2</td>
							</tr>
							<tr>
								<th>BTC</th>
								<td>Jacob</td>
								<td>10.9</td>
								<td>$6892.2</td>
								<td>$6892.2</td>
							</tr>
							<tr>
								<th>BTC</th>
								<td>$6892.2</td>
								<td>$6892.2</td>
								<td>$6892.2</td>
								<td>$6892.2</td>
							</tr>
							<tr>
								<th>BTC</th>
								<td>$6892.2</td>
								<td>$6892.2</td>
								<td>$6892.2</td>
								<td>$6892.2</td>
							</tr>
						</tbody>
						<!--Table body-->
					</table>
					<!--Table-->
				</div>
			</div>
		</div>
	</div>
</div>
@stop