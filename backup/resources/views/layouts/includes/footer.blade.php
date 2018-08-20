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
                            <li><a href="#">Assets Profile</a></li>
                            <li><a href="#">ICOs</a></li>
                            <li><a href="{{url('/thermogram')}}">Crypto Thermogram</a></li>
                            <li><a href="{{url('/news')}}">News Feed</a></li>
                            <li><a href="{{url('/events')}}">Event Calendar</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="third-footer common-footer">
                        <h5>Links</h5>
                        <ul>
                            <li><a href="#">Register</a></li>
                            <li><a href="#">My Portfolio</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="fourth-footer common-footer">
                        <h5>Help Us Improve</h5>
                        <ul>
                            <li><a href="#">Feedback / Feature Request</a></li>
                            <li><a href="#">Get Your ICO on GoCoiner</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <p class="right-side-copyright"><span class="term">Terms of Use </span>Privacy Policy<br></p>
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>

    <script src="//code.jquery.com/jquery-migrate-1.1.1.js"></script>

    <!-- <script src="{{url('public/js/jquery-migrate-1.1.1.js')}}"></script> -->
    <script src="{{url('public/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/owl.carousel.js')}}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--auto-->
    
    <script src="{{url('public/js/jquery-ui.min.js')}}"></script>

    <!--auto-->
    <script>
        jQuery(document).ready(function() {
            jQuery('.carousel').carousel({
              interval: 10000000
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            src = "{{ url('auto_complete') }}";
            $("#search_term").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: src,
                        data: {
                            term : request.term
                        },
                        success: function(data) {
                            //console.log(data);
                            response( $.map( data, function( result ) {  

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

           return $( "<li></li>" )  

                       .data( "item.autocomplete", item )  

                       .append( "<a>" + "<img style='width:25px;height:25px' src='" + item.imgsrc + "' /> " + item.label+ "</a>" )  

                       .appendTo( ul );  

                    

               };  
        });

        $(document).on('click','.ui-autocomplete > li',function() {
            $('.app-search').submit();
        });

        $('#dropdownMenuButton').click(function(){
            $(this).parent().find('.dropdown-menu').toggle();
        });
    </script>

     <script type="text/javascript" src="//www.coincalendar.info/wp-content/plugins/eventon-api/eventon.js?ver=1.0.1"></script>
<!--     <script type="text/javascript">
      jQuery(document).ready(function() {

        //alert("<?php //echo $number; ?>");

         jQuery('#eventoncontent').evoCalendar({
         api: 'https://www.coincalendar.info/wp-json/eventon/calendar?event_type=3,1266,1267&number_of_months=1&event_count=<?php echo $number; ?>&show_et_ft_img=yes',
         calendar_url: '',
         new_window: true,
         loading_text: 'Loading Events...'
         });

        jQuery('.search_news').on('keypress',function(e){
            alert(e);

        });


     });
   
    </script> -->
	
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
</script>

</body>

</html>