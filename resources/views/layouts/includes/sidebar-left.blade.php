<aside class="left-sidebar">
    
    <div class="scroll-sidebar">

</div>
        
       <!--  <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a href="{{ route('home.market') }}" aria-expanded="false"><span class="hide-menu">{{ __('home.market') }}</span></a>
                </li>
                @auth
                    <li>
                        <a href="{{ route('admin.index') }}"> {{ __('home.admin') }}</a>
                    </li>
                @endauth
                <li><a href="{{ route('news.index') }}"> {{ __('news.news') }}</a></li>
                @if ($has_blog_posts)
                    <li><a href="{{ route('pages.index') }}"> {{ __('home.blog') }}</a></li>
                @endif -->

         <!--        @foreach($custom_menus as $menu_id => $attr)
                    <li>
                        <a class="has-arrow " href="{{ $attr['url'] }}" aria-expanded="false"><span
                                    class="hide-menu"> {{ $attr['title'] }}</span></a>
                        @if (Menu::exists($menu_id))
                            {!! Menu::get($menu_id)->asUl(['class' => 'collapse',  'aria-expanded' => 'false']) !!}
                        @endif
                    </li>
            @endforeach -->
       
          <!--       <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><span class="hide-menu">{{ __('home.site') }}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('contact.index') }}"> {{ __('home.contact') }}</a></li>
                        <li><a href="{{ route('static.terms') }}"> {{ __('home.terms') }}</a></li>
                        <li><a href="{{ route('static.privacy') }}"> {{ __('home.privacy') }}</a></li>
                        <li><a href="{{ route('static.disclaimer') }}"> {{ __('home.disclaimer') }}</a></li>
                        <li><a href="{{ route('sitemap.index') }}"> {{ __('home.sitemap') }}</a></li>
                        @guest
                            <li><a href="{{ route('admin.index') }}"> {{ __('home.admin') }}</a></li>
                        @endguest
                    </ul>
                </li>
            </ul>
        </nav> 

    </div> -->

 </aside> 

