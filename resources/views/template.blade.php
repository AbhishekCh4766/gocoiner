@include('layouts.includes.header-topbar')


    <div class="banner-text">
       
        <div id="myCarousel" class="carousel slide"> <!-- slider -->
            
                <div class="carousel-inner">
                    <?php $i = 1; ?>
                    @foreach($Slider as $data)
                    <div class=" @if($i==1) active @endif item"> <!-- item 1 -->
                       
                        <div class="left-banner">
                           <h3><?php echo($data->content); ?></h3> 
                        </div>
                    </div> <!-- end item -->
                   <!-- end item -->
                   <?php $i++; ?>
                    @endforeach
                </div> <!-- end carousel inner -->
               
                <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
            </div>

        <!-- <div class="left-banner">
            <h2><span>Secure</span>and<span>Easy</span><br>way to <span>Trade</span></h2>
            <p>You cannot discover new oceans unless you have the courage to<br> lose sight of the shore…and move on!</p>
        </div> -->

 
</div>
</div>
        <div class="banner-bottom banner-box-silder">
        <div class="banner-carousel" style="">
            <div id="owl" class="clearfix"> 
                    
                 @foreach($coins->chunk(8) as $chunk)

                  <div class="item">

                     @foreach ($chunk as $product)
                    <div class="oneten linked">
                        <a href="#" style="display:block">
                                <span class="symb">

                                     <td style="width:48px; padding-right: 6px;">
                                    <span>
                                        @if(isset($product->logo))
                                            <a href="{{ coin_url($product) }}">
                                                <img src="{{ asset('asset/images/coins/tn/' . $product->logo) }}" width="30">
                                            </a>
                                        @endif
                                    </span>
                               </td>
                

                               <h5>{{$product->name}}</h5></span> 
                                <div class="heatcent" style="color: #00E000;">{{$product->percent_change_1h}}%</div>
                                <span class="actual-currency" style="">
                                    <span class="currency_sign" style="font-weight: 400;font-size: 13px;">&#x24 </span>
                                    <span class="exchange" content="8,272.23">{{ $product->price_usd }}</span>
                                </span>
                                <span class="actual-currency" style="">
                                    <span class="currency_sign" style="font-size:10px">&#x24 </span>
                                    <span class="exchange" content="139.98 B">{{$product->market_cap_usd}}</span>
                                </span> 
                            </a>
                    </div>
                    @endforeach

                  </div>
                 @endforeach
                  

                


</div>

            </div>
        </div>



    </div>


    <!-- slider -->






    <div class="section-one">
        <div class="container">
            <div class="market-news-section">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <h4>Market <br><b>News</b></h4>
                    <li role="presentation" class="active">
                        <a href="#featured-tab" aria-controls="home" role="tab" data-toggle="tab">
								<img src="public/images/featured-tab-black.png" class="tab-image"><img src="public/images/featured-tab-white.png" class="tab-hover-image"><p>Featured</p>
							</a></li>
                    <li role="presentation">
                        <a href="#blockchain-tab" aria-controls="profile" role="tab" data-toggle="tab">
								<img src="public/images/block-chain-black.png" class="tab-image"><img src="public/images/block-chain-white.png" class="tab-hover-image"><p>Blockchain</p>
							</a></li>
                    <li role="presentation">
                        <a href="#bitcoin-tab" aria-controls="messages" role="tab" data-toggle="tab">
								<img src="public/images/bitcoin-tab-black.png" class="tab-image"><img src="public/images/bitcoin-tab-white.png" class="tab-hover-image"><p>Bitcoin</p>
							</a></li>
                    <li role="presentation">
                        <a href="#ethereum-tab" aria-controls="settings" role="tab" data-toggle="tab">
								<img src="public/images/ethereum-tab-black.png" class="tab-image"><img src="public/images/ethereum-tab-white.png" class="tab-hover-image"><p>Ethereum</p>
							</a></li>
                    <li role="presentation">
                        <a href="#ripple-tab" aria-controls="settings" role="tab" data-toggle="tab">
								<img src="public/images/ripple-tab-black.png" class="tab-image"><img src="public/images/ripple-tab-white.png" class="tab-hover-image"><p>Ripple</p>
							</a></li>
                    <li role="presentation">
                        <a href="#ico-tab" aria-controls="settings" role="tab" data-toggle="tab">
								<img src="public/images/ico-tab-black.png" class="tab-image"><img src="public/images/ico-tab-white.png" class="tab-hover-image"><p>ICOs</p>
							</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    
                    <div role="tabpanel" class="tab-pane active" id="featured-tab" >
                        @php  $count5 =0; @endphp
                        @foreach($getFeatNewsData as $data)
                        <div class="inner col-sm-6"  data-toggle="modal" class="myModal5" data-target="#myModal5_{{$count5}}" data-backdrop="static" data-keyboard="false">
                            
                                <div class="col-sm-3 tab-left-image">
                                    <img src="{{$data->image}}">
                                </div>
                                <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                                 <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo substr($data->body,0,150); ?>......</p>
                                </div>
                                    <div id="myModal5_{{$count5}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="myModal5_{{$count5}}">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                     <div class="col-sm-3 tab-left-image">
                                    <img src="{{$data->image}}">
                                </div>
                                <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                                 <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo($data->body); ?>......</p>
                                <a href="{{$data->url}}" target="_blank"
                                   class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __(' READ MORE') }}
                                    <i class="fa fa-angle-right"></i></a>
                                </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="myModal5_{{$count5}}">Close</button>
                                    </div>
                                    </div>

                                    </div>
                                    </div>
                             
                        </div>

                        @php $count5++; @endphp
                        @endforeach
                         <div class="view-button">
                    <button type="button" class="btn" onclick="location.href='{{url("/news")}}'" >View All News</button>
                </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="blockchain-tab">
                        @php  $count4 =0; @endphp
                        @foreach($BloNewsData as $data)
                        <div class="inner col-sm-6 " data-toggle="modal" data-target="#myModal4_{{$count4}}" data-backdrop="static" data-keyboard="false">
                            <div class="col-sm-3 tab-left-image">
                                <img src="{{$data->image}}">
                            </div>
                            <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                                 <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo substr($data->body,0,150); ?>......</p>
                            </div>
                                <div id="myModal4_{{$count4}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" id="modalClose" data-dismiss="myModal4_{{$count4}}">&times;</button>
                                
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-3 tab-left-image">
                                <img src="{{$data->image}}">
                            </div>
                                 <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                                 <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo($data->body); ?>......</p>
                                  <a href="{{$data->url}}" target="_blank"
                                   class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __(' READ MORE') }}
                                    <i class="fa fa-angle-right"></i></a>
                            </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="modalClose" data-dismiss="myModal4_{{$count4}}">Close</button>
                                </div>
                                </div>

                                </div>
                                </div>  
                        </div>
                         @php $count4++; @endphp
                        @endforeach
                    </div>
                
                   
                       <div role="tabpanel" class="tab-pane" id="bitcoin-tab">
                            @php  $count =0; @endphp
                        @foreach($BitNewsData as $data)

                         

                        <div class="inner " data-toggle="modal" data-target="#myModal_{{$count}}" data-backdrop="static" data-keyboard="false">
                            <div class="col-sm-3 tab-left-image">
                                <img src="{{$data->image}}">
                            </div>
                            <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                                <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo substr($data->body,0,150); ?>......</p>
                            </div>

                            <div id="myModal_{{$count}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="myModal_{{$count}}">&times;</button>
                            
                            </div>
                            <div class="modal-body">
                               <div class="col-sm-3 tab-left-image">
                                <img src="{{$data->image}}">
                            </div>
                            <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                                <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo($data->body); ?>......</p>
                                  <a href="{{$data->url}}" target="_blank"
                                   class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __(' READ MORE') }}
                                    <i class="fa fa-angle-right"></i></a>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="myModal_{{$count}}">Close</button>
                            </div>
                            </div>

                           
                            </div>
                        </div>
                        </div>
                        @php $count++; @endphp
                        @endforeach
                       </div>

                        
                    <div role="tabpanel" class="tab-pane" id="ethereum-tab">
                        @php  $count1 =0; @endphp
                        @foreach($EthNewsData as $data)
                       
                        <div class="inner" data-toggle="modal" data-target="#myModal1_{{$count1}}" data-backdrop="static" data-keyboard="false">
                            <div class="col-sm-3 tab-left-image">
                                <img src="{{$data->image}}">
                            </div>
                            <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                               
                                <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo substr($data->body,0,150); ?>......</p>
                            </div>
                                <div id="myModal1_{{$count1}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                              
                                <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="myModal1_{{$count1}}">&times;</button>
                                
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-3 tab-left-image">
                                <img src="{{$data->image}}">
                            </div>
                                <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                            
                                <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo($data->body); ?>......</p>
                                  <a href="{{$data->url}}" target="_blank"
                                   class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __(' READ MORE') }}
                                    <i class="fa fa-angle-right"></i></a>
                            </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="myModal1_{{$count1}}">Close</button>
                                </div>
                                </div>

                                </div>
                                </div>
                            
                        </div>
                         @php $count1++; @endphp
                        @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane" id="ripple-tab">
                         @php  $count2 =0; @endphp
                        @foreach($RipNewsData as $data)
                        <div class="inner"  data-toggle="modal" data-target="#myModal2_{{$count2}}" data-backdrop="static" data-keyboard="false">
                            <div class="col-sm-3 tab-left-image">
                                <img src="{{$data->image}}">
                            </div>
                             <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                                
                                <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo substr($data->body,0,150); ?>......</p>
                            </div>
                                <div id="myModal2_{{$count2}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="myModal2_{{$count2}}">&times;</button>
                                
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-3 tab-left-image">
                                <img src="{{$data->image}}">
                            </div>
                                 <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                                
                                <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo($data->body); ?>......</p>
                                  <a href="{{$data->url}}" target="_blank"
                                   class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __(' READ MORE') }}
                                    <i class="fa fa-angle-right"></i></a>
                            </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="myModal2_{{$count2}}">Close</button>
                                </div>
                                </div>

                                </div>
                                </div>
                        </div>
                        @php $count2++; @endphp
                         @endforeach
                    </div>
                    <div role="tabpanel" class="tab-pane" id="ico-tab">
                        @php  $count3 =0; @endphp
                        @foreach($IcoNewsData as $data)
                        <div class="inner" data-toggle="modal" data-target="#myModal3_{{$count3}}" data-backdrop="static" data-keyboard="false">
                            <div class="col-sm-3 tab-left-image">
                                <img src="{{$data->image}}">
                            </div>
                             <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                                
                                <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo substr($data->body,0,150); ?>......</p>
                            </div>
                        <div id="myModal3_{{$count3}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="myModal3_{{$count3}}">&times;</button>
                        
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-3 tab-left-image">
                                <img src="{{$data->image}}">
                            </div>
                         <div class="col-sm-9 tab-right-text">
                                <h3>{{$data->title}}</h3>
                                
                                <span><?php echo date("M d, Y",strtotime($data->published_on)); ?></span>
                                <p><?php echo($data->body); ?>......</p>
                                  <a href="{{$data->url}}" target="_blank"
                                   class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __(' READ MORE') }}
                                    <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="myModal3_{{$count3}}">Close</button>
                        </div>
                        </div>

                        </div>
                        </div>
                        </div>
                        @php $count3++; @endphp
                         @endforeach
                    </div>
                </div>
               
            </div>
        </div>
    </div>


    <div class="market-movers">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4"></div>
                <div class="col-xs-12 col-sm-8 market-mover">
                    <h3>Market Movers</h3>
                    <div class="market-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <!-- <h4>Market <br><b>News</b></h4> -->
                            <li role="presentation" class="active">
                                <a href="#market-movers-first" aria-controls="home" role="tab" data-toggle="tab">Top Gainers</a></li>
                            <li role="presentation">
                                <a href="#market-movers-second" aria-controls="profile" role="tab" data-toggle="tab"> Top Losers</a></li>

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active gainer" id="market-movers-first">
                                <div class="table-thead">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Assests Name</th>
                                                <th>Price</th>
                                                <th>Vol(24)</th>
                                                <th>%24</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($gainers as $gainer)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><a href="{{ coin_url($gainer) }}" class="d-none d-md-block d-lg-block d-xl-block"> {{$gainer->name}}</td>
                                                <td>${{$gainer->price_usd}}</td>
                                                <td>${{$gainer->volume_usd_24h}} M</td>
                                                <td>{{$gainer->percent_change_24h}}%</td>
                                            </tr>
                                        <?php $i++; ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane looser" id="market-movers-second">
                                <div class="table-thead">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Assests Name</th>
                                                <th>Price</th>
                                                <th>Vol(24)</th>
                                                <th>%24</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($losers as $loser)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><a href="{{ coin_url($loser) }}" class="d-none d-md-block d-lg-block d-xl-block"> {{$loser->name}}</td>
                                                <td>${{$loser->price_usd}}</td>
                                                <td>${{$loser->volume_usd_24h}} M</td>
                                                <td>{{$loser->percent_change_24h}}%</td>
                                            </tr>
                                        <?php $i++; ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                 
                    </div>
                </div>
                   <!--  <div class="view-button heat">
                        <button type="button" class="btn">VIEW ASSET HEATMAP</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    
                
           
    <div class="prress-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 press-release">
                    <h3>PRESS RELEASE</h3>
                    @foreach($PressData as $Press)
                    <div class="row press-release-inner">
                         <div class="col-xs-12 col-sm-2">
                                  
                             <img src="{{asset('public/images/press_release').'/' . $Press->pic}}" width="">
                        </div>
                        <div class="col-xs-12 col-sm-10">
                            <h5>{{$Press->title}}</h5>
                           <p>{!! str_limit(strip_tags($Press->content), $limit = 190, $end = '...') !!}</p>
                          
                             <a href="{{url('press-release')}}/{{$Press->id}}" target="_blank" class="pull-right btn btn-sm btn-rounded btn-outline-primary">{{ __(' READ MORE') }}
                                    <i class="fa fa-angle-right"></i></a>
                             
                        </div>
                    </div>
                    @endforeach
                   <div class="view-button heat-map">
                  <button type="button" class="btn" onclick="location.href='{{url("/press-release")}}'">VIEW ALL PRESS RELEASES </button>
                            </div>
               </div>

                <div class="col-xs-12 col-sm-5 up-coming">
                    <div class="col-xs-12 col-sm-12 press-release">
                        <h3>UPCOMING ICOS</h3>

                        @foreach ($icos as $ico)
						<div class="ico-info">
							<div class="ico-image"><img alt="{{$ico->name}}" title="{{$ico->name}}" src="{{$ico->image}}" width="80" /></div>
							<div class="odd gradeX icon-inner">
								<h4 class="ico-title">{{$ico->name}}</h4>
								<div class="ico-date">
									<span><strong>Start Time: </strong>{{$ico->start_time}}</span>
									<span><strong>End Time: </strong>{{$ico->end_time}}</span>
								</div>
								<p class="ico-description">{{$ico->description}}</p>
							</div>
						</div>
						@endforeach
                            <div class="view-button heat-map icos-button">
                                <button type="button" class="btn" onclick="location.href='{{url("/crypto-ico/upcoming")}}'" >VIEW UPCOMING icos</button>
                            </div>
                        </ul>
                    </div>

                    <div class="col-xs-12 col-sm-12 press-release recently">
                      <!--   <h3>RECENTLY VIEWED ASSETS</h3>
                        <table class="table">
                            <thead>
                                <tr>

                                    <th>Assests Name</th>
                                    <th>Price</th>
                                    <th>Vol(24)</th>
                                    <th>%24</th>

                                </tr>
                            </thead>

                            <tbody>
                                <tr>

                                    <td>Binance Coin</td>
                                    <td>$56</td>
                                    <td>$252.72 M</td>
                                    <td>26.66%</td>
                                </tr>

                            </tbody>

                        </table> -->


                    </div>
                    </div>
</div>
</div>
</div>
</div>
                
            
        
    


 @include('layouts.includes.footer')


