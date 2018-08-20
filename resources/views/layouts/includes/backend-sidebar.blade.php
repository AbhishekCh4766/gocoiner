<div class="col-lg-3 col-xlg-2 col-md-4">
    <div class="stickyside">
        <div class="list-group" id="top-menu">
            <a href="{{ route('private.index') }}" class="list-group-item {{ Route::is('private.index')? 'active':'' }}">
                <i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp; Dashboard</a>
            <a href="{{ route('private.coins.index') }}" class="list-group-item {{ Route::is('private.coins.*')? 'active':'' }}">
                <i class="fa fa-stack-overflow" aria-hidden="true"></i>&nbsp; Coins</a>

                 <a href="{{ route('private.user.index') }}"
               class="list-group-item {{ Route::is('private.user.*') ? 'active':'' }}">
                <i class="fa fa-user" aria-hidden="true"></i>&nbsp; Manage Users</a>

            <a href="{{ route('private.pages.index') }}"
               class="list-group-item {{ Route::is('private.pages.*') ? 'active':'' }}">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp; Pages</a>

          <a href="{{ route('private.newses.index') }}"
               class="list-group-item {{ Route::is('private.newses.*') ? 'active':'' }}">
                <i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp; Press Release</a>

          <a href="{{ route('private.recommendation.index') }}"
               class="list-group-item {{ Route::is('private.recommendation.*') ? 'active':'' }}">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp; Recommendations</a>
            
                  <a href="{{ route('private.slider.index') }}"
               class="list-group-item {{ Route::is('private.slider.*') ? 'active':'' }}">
                <i class="fa fa-sliders" aria-hidden="true"></i>&nbsp; Slider</a>
            <a href="{{ route('private.menus.index') }}" class="list-group-item {{ Route::is('private.menus.*') ? 'active':'' }}">
                <i class="fa fa-map-o" aria-hidden="true"></i>&nbsp; Menu</a>
            <a href="{{ route('private.lang.index') }}" class="list-group-item {{ Route::is('private.lang.*') ? 'active':'' }}">
                <i class="fa fa-language" aria-hidden="true"></i>&nbsp; Translations</a>
            <a href="{{ route('private.settings') }}"
               class="list-group-item {{ Route::is('private.settings')? 'active':'' }}">
                <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp; Site Settings</a>
            <a href="{{ route('private.profile') }}"
               class="list-group-item {{ Route::is('private.profile')? 'active':'' }}">
                <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp; Profile</a>
            <a href="{{ route('auth.logout') }}" class="list-group-item">
                <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp; Logout</a>
        </div>
    </div>
</div>
