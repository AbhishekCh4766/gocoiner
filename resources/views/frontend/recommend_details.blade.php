@extends('layouts.master')

@section('title', __('Recommendations'))

@section('content')


  <div class="prress-section press-release-inner">
            <div class="row">
                 @foreach($recommendation as $Press)
				<div class="col-xs-12 col-sm-12">
                
				</div>	
                <div class="col-xs-12 col-sm-12 press-release">
                   
                    <div class="press-release">
                         <div class="col-xs-12 col-sm-5 ">
                             <img src="{{asset('public/images/press_release').'/' . $Press->pic}}" width="">
                        </div>
                        <div class="col-xs-12 col-sm-7">
                                  <h3>{{$Press->title}}</h3> <br>
                            <p><?php echo($Press->content); ?> </p>
                        </div>
                    </div>
                    </div>
                    @endforeach
                  
               
             </div>

             <div id="disqus_thread"></div>
             <script id="dsq-count-scr" src="//gocoiner.disqus.com/count.js" async></script>
             <a href="http://foo.com/bar.html#disqus_thread"></a>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://gocoiner.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
         
     </div>

@endsection