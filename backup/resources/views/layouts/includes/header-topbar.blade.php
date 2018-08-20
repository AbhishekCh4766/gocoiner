<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Homepage</title>
    <link href="{{url('/public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('public/css/style.css')}}" rel="stylesheet">
    <link href="{{url('public/css/carousel.css')}}" rel="stylesheet">
	<link href="{{url('public/css/custom.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="{{url('public/css/animate.css')}}" rel="stylesheet" />
    <link href="{{url('public/css/carousel-new.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--auto-->
    <link href="{{url('public/css/jquery.ui.autocomplete.css')}}" rel="stylesheet">
    <!--auto-->
    
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type='text/javascript' src="{{url('public/js/jquery.js')}}"></script>
    <script src="{{url('public/js/chosen.jquery.js')}}"></script>
  
    <script src="https://use.fontawesome.com/10b4771377.js"></script>
    <script src="{{ asset('asset/vendor/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('asset/vendor/morrisjs/morris.js') }}"></script>
    <script src="{{ asset('asset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/chart.js') }}"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
		$(document).ready(function(){
			$("#myBtn").click(function(){
				$("#myModal").modal();
			});
		});
	</script>

    <script>
        function openCity(cityName,elmnt,color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(cityName).style.display = "block";
            elmnt.style.backgroundColor = color;
        
        }
        
        //document.getElementById("defaultOpen").click();
    </script>
    <script>
        function getRandomAnimation(){
                    var animationList = ['slideOutDown', 'slideInDown']; 
                    return animationList[Math.floor(Math.random() * animationList.length)];
                }  
        
                jQuery(document).ready(function(){  
                    var owl = jQuery("#owl");
                    owl.owlCarousel({   
                        items : 1,
                        autoplay: true,
                        autoplayTimeout: 15000,
                                animateOut: ['slideOutDown', 'slideInDown'],
                        animateIn: ['slideOutUp', 'slideInUp'],
                                nav :true,
                        dots :false,
                        responsiveClass:true,
                    })
                });
    </script>
	<script>
		jQuery(document).ready(function(){ 
			jQuery('.navbar-toggle').click(function() {
				
			  jQuery('.navbar-collapse').toggle();
			});
		});
	</script>
</head>

<body>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="main-header main-image">
        <div class="top-bar">
            <div class="container">
                <div class="header_text">
                    <ul class="top_nav">
                        <li><a href="{{url('/login')}}"><img src="{{url('public/images/ccc.png')}}">Login</a></li>
                        <li><a href="{{url('/registration')}}"><img src="{{url('public/images/sign-up.png')}}">Sign Up</a></li>
                    </ul>
                </div>
                <div class="top_header_right">
                    <p>Total Cap: <span class="green">$<?php echo $totalCap; ?> </span> 24th Vol: <span class="yellow"> $<?php echo $totalCap; ?></span> </p>
             
                </div>
            </div>
        </div>
        <div class="logo-bar">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-sm-4 rate-logo">
                        <p>
							<span>	
								<img src="{{ asset('asset/images/coins/tn/' .$btcData[0]->logo) }}" width="30">$<?php echo ROUND($btcData[0]->price_usd,2); ?>
							</span>	
							<span>
								<img src="{{ asset('asset/images/coins/tn/'.$ethData[0]->logo) }}" width="30">$<?php echo ROUND($ethData[0]->price_usd,2); ?>
							</span> 
							<span>
								<img src="{{ asset('asset/images/coins/tn/'.$liteData[0]->logo) }}" width="30">$<?php echo ROUND($liteData[0]->price_usd,2); ?>
							</span>
						</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 site-logo">
                        <div class="logo"><a href="{{url('http://gocoiner.com')}}"><img src="{{url('public/images/header-logo.png')}}"></a></div>
                    </div>
                    
                </div>
            </div>
        </div>

        <nav class="navbar navbar-inverse">
            <div class="container">
				<div class="rate-logo rate-logo-responsive">
					<p>
						<span>	
							<img src="{{ asset('asset/images/coins/tn/' .$btcData[0]->logo) }}" width="30">$<?php echo ROUND($btcData[0]->price_usd,2); ?>
						</span>	
						<span>
							<img src="{{ asset('asset/images/coins/tn/'.$ethData[0]->logo) }}" width="30">$<?php echo ROUND($ethData[0]->price_usd,2); ?>
						</span> 
						<span>
							<img src="{{ asset('asset/images/coins/tn/'.$liteData[0]->logo) }}" width="30">$<?php echo ROUND($liteData[0]->price_usd,2); ?>
						</span>
					</p>
				</div>
                <div class="main_navigation">
                    <!-- <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/market')}}">Market</a></li>
                        <li><a href="#">ThermoGram</a></li>
                        <li><a href="{{url('/news')}}">News</a></li>
                        <li><a href="#">ICOs</a></li>
                        <li><a href="#">My Portfolio</a></li>
                        <li class="nav-item hidden-sm-down">
                            {!! Form::open(['route' => 'home.search', 'method' => 'GET', 'class' => 'app-search']) !!}
                            <input type="text" id="search_term" name="search_term" class="form-control" placeholder="Search coins">
                        </li>
                    </ul> -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
				
					<div class="collapse navbar-collapse" id="navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="{{url('/')}}">Home</a></li>
							<li><a href="{{url('/market')}}">Market</a></li>
							<li><a href="{{url('/thermogram')}}">ThermoGram</a></li>
							<li><a href="{{url('/news')}}">News</a></li>
							<li><a href="#">ICOs</a></li>
							<li><a href="{{url('/myportfolio')}}">My Portfolio</a></li>
							<li class="search-menu">
								{!! Form::open(['route' => 'home.search', 'method' => 'GET', 'class' => 'app-search']) !!}
								<input type="text" id="search_term" name="search_term" class="form-control" placeholder="Search coins">
                                 {!! Form::close() !!}
							</li>
						</ul>
					</div>
                </div>
            </div>
        </nav>
     

    