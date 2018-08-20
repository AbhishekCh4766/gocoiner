<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{url('asset/images/favicon.png')}}">

    <title>Homepage</title>
    <!-- <link href="{{url('/public/css/bootstrap.min.css')}}" rel="stylesheet"> -->
    <link href="{{url('public/css/style.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700|Roboto:300,300i,400,400i,500,500i,700,900" rel="stylesheet"> 
   
    <link href="{{url('public/css/carousel.css')}}" rel="stylesheet">
    <link href="{{url('public/css/custom.css')}}" rel="stylesheet">
    <link href="{{url('public/css/style-form.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css'>
    <link href="{{url('public/css/animate.css')}}" rel="stylesheet" />
    <link href="{{url('public/css/carousel-new.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--auto-->
    <link href="{{url('public/css/jquery.ui.autocomplete.css')}}" rel="stylesheet">
    <!--auto-->
	
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Barlow:100,200,300,400,500,600,700,800,900" rel="stylesheet"> 
    <script src="{{url('public/js/jquery.js')}}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js'></script>
    
    
    <script src="{{url('public/js/chosen.jquery.js')}}"></script>
  
    <script src="https://use.fontawesome.com/10b4771377.js"></script>
    <script src="{{ asset('asset/vendor/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('asset/vendor/morrisjs/morris.js') }}"></script>
    <script src="{{ asset('asset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/chart.js') }}"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    

    
    <script>
        $(document).ready(function(){
            $("#myBtn").click(function(){
                $("#myModal").modal();
            });
        });
    </script>
    
    <script>
        //$.noConflict();
        jQuery( document ).ready(function() {
            jQuery(function() {
              jQuery('.selectpicker').selectpicker();
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
        

    </script>
    <script>
        jQuery(document).ready(function(){ 
            jQuery('.navbar-toggle').click(function() {
                
              jQuery('.navbar-collapse').toggle();
            });
        });
    </script>
    <script>
        $(window).load(function() {
    $('#myCarousel').carousel({
        interval: 3000
        })
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
                   @if (Auth::check())
                    <li><h5>Welcome: {{Auth::user()->name}} </h5></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i>
                             logout </a></li>

                    @else
                    <li><a href="{{url('/login')}}"><img src="{{url('public/images/ccc.png')}}">Login </a></li>
                        <li><a href="{{url('/registration')}}"><img src="{{url('public/images/sign-up.png')}}">Sign Up</a></li>
                    @endif
                        
                        
                        
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
                            <li><a href="{{url('/event-calendar')}}">Events</a></li>
                            <li>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ICOs</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{url('/crypto-ico/active')}}"><i class="fa fa-check-square-o"></i>Active ICOs</a>
                                        <a class="dropdown-item" href="{{url('/crypto-ico/upcoming')}}"><i class="fa fa-calendar" aria-hidden="true"></i>Upcoming ICOs</a>
                                        <a class="dropdown-item" href="{{url('/crypto-ico/finished')}}"><i class="fa fa-check-square" aria-hidden="true"></i>Finished ICOs</a>
                                    </div>
                                </div>
                            </li>
                            <li><a href="{{url('/myportfolio')}}">My Portfolio</a></li>
                            <li><a href="{{url('/recommendations')}}">Recommendations</a></li>
                            <li class="search-menu">
                                {!! Form::open(['route' => 'home.search', 'method' => 'GET', 'class' => 'app-search']) !!}
                                <input type="text" class="search_term" id="search_term" name="search_term" class="form-control" placeholder="Search coins">
                                 {!! Form::close() !!}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
     

    