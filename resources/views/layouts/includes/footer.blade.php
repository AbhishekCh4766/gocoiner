   <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-3">
                    <div class="first-footer common-footer">
                        <ul>
                            <img src="{{url('public/images/footer-logo.png')}}">
                            <li>
                                <p>Go Coiner is a cryptocurrency and digital asset information aggregator that helps you research blockchain assets, news and keep track of your portfolio all in one place.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="second-footer common-footer">
                        <h5>Research Tools</h5>
                        <ul>
                            @if (Auth::check())
                            <li><a href="{{url('/myportfolio')}}" target="_blank">Assets Profile</a></li>
                             @endif
                            <li>
                            <a href="{{url('/crypto-ico/active')}}" target="_blank">Active ICOs</a></li>
                            <li><a href="{{url('/thermogram')}}" target="_blank">Thermogram</a></li>
                            <li><a href="{{url('/news')}}" target="_blank">News</a></li>
                          <li><a href="{{url('/crypto-ico/upcoming')}}" target="_blank">Upcoming ICOs</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="third-footer common-footer">
                        <h5>Links</h5>
                        <ul>
                             @if (Auth::check())
                    <li><h5>Welcome: {{Auth::user()->name}} </h5></li>
                    <li><a href="{{ url('/logout') }}">
                             Logout </a></li>

                    @else
                    <li><a href="{{url('/login')}}" target="_blank">Login</a></li>
                        <li><a href="{{url('/registration')}}" target="_blank">Sign Up</a></li>
                    @endif
                            <li><a href="{{url('/myportfolio')}}" target="_blank">My portfolio</a></li>

                            <li><a href="{{url('/event-calendar')}}" target="_blank">Events</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="fourth-footer common-footer">
                        <h5>Help Us Improve</h5>
                        <ul>
                            <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSdYkjV6vBtOhYaDztr4g0S-Lr16Ofw7zTAFf9Is-uU9d7EDEQ/viewform" target="_blank">Feedback/Feature Request </a></li>
                           
                            <li><a href="{{url('page/advertisement')}}" target="_blank">Partner with Us</a></li>
                            <li><a href="{{url('contact')}}" target="_blank">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <p class="right-side-copyright"><a href="{{url('/page/privacy-policy')}}" target="_blank">Privacy Policy</a>
               <a class="right-side-copyright" href="{{url('/page/terms')}}" target="_blank">Terms of use</a></p>
            </div>
        </div>
    </footer>

    <?php 
            $number = 2;

            if ($_SERVER['REQUEST_URI'] == '/events'){
                $number = 20;
            }
    ?>


        <!-- Bootstrap core JavaScript-->
      
        <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script> -->



    <!-- <script src="{{url('public/js/jquery-migrate-1.1.1.js')}}"></script> -->
    <script type="text/javascript" src="{{url('public/js/owl.carousel.js')}}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--auto-->
    
    <script src="{{url('public/js/jquery-ui.min.js')}}"></script>

    <!--auto-->
 <!--    <script>
        jQuery(document).ready(function() {
            jQuery('.carousel').carousel({
              interval: 10000000
            });
        });
    </script> -->
    <script>
            src = "{{ url('auto_complete') }}";
            jQuery(".search_term").autocomplete({
                source: function(request, response) {
                    jQuery.ajax({
                        url: src,
                        data: {
                            term : request.term
                        },
                        success: function(data) {
                            //console.log(data);
                            response( jQuery.map( data, function( result ) {  

                                return {  

                                    //label: result.id + " - " + result.value,  

                                    value: result.value,  

                                    imgsrc: result.logo  

                                }  

                            }));  
                        }
                    });
                },
                minLength: 1,
            }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {

			if((item.imgsrc).length>0){

			   return jQuery( "<li></li>" )  

						   .data( "item.autocomplete", item )  

						   .append( "<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + item.label+ "</a>" )  

						   .appendTo( ul );  

						

				   } 
			else{
				
			   return jQuery( "<p></p>" )  

						   .data( "item.autocomplete", item )  

						   .append( "<a>" +item.label+ "</a>" )  

						   .appendTo( ul );  

						

				   } 
			};

        jQuery(document).on('click','.ui-autocomplete > li',function() {
            jQuery('.app-search').submit();
        });

        jQuery('#dropdownMenuButton').click(function(){
            jQuery(this).parent().find('.dropdown-menu').toggle();
        });
    </script>

     <!--<script type="text/javascript" src="//www.coincalendar.info/wp-content/plugins/eventon-api/eventon.js?ver=1.0.1"></script>-->



    <script  src="public/js/index.js"></script>
	<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}

            
var owl = jQuery("#owl");
owl.owlCarousel({   
    items : 1,
    autoplay: true,
    autoplayTimeout: 4000,
            animateOut: ['slideOutDown', 'slideInDown'],
    animateIn: ['slideOutUp', 'slideInUp'],
            nav :true,
    dots :false,
    responsiveClass:true,
    loop: true,
})


</script>

</body>

</html>