<div class="col-lg-3 col-xlg-2 col-md-4">
    <div class="stickyside">
        <div class="list-group" id="top-menu">
            <a href="{{ route('admin.index') }}" class="list-group-item {{ Route::is('admin.index')? 'active':'' }}">
                <i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp; Dashboard</a>
            <a href="{{ route('admin.coins.index') }}" class="list-group-item {{ Route::is('admin.coins.*')? 'active':'' }}">
                <i class="fa fa-stack-overflow" aria-hidden="true"></i>&nbsp; Coins</a>
            
            <a href="{{ route('admin.pages.index') }}"
               class="list-group-item {{ Route::is('admin.pages.*') ? 'active':'' }}">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp; Pages</a>

          <a href="{{ route('admin.newses.index') }}"
               class="list-group-item {{ Route::is('admin.newses.*') ? 'active':'' }}">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp; Press Release</a>

          


            <a href="{{ route('admin.menus.index') }}" class="list-group-item {{ Route::is('admin.menus.*') ? 'active':'' }}">
                <i class="fa fa-map-o" aria-hidden="true"></i>&nbsp; Menu</a>
            <a href="{{ route('admin.lang.index') }}" class="list-group-item {{ Route::is('admin.lang.*') ? 'active':'' }}">
                <i class="fa fa-language" aria-hidden="true"></i>&nbsp; Translations</a>
            <a href="{{ route('admin.settings') }}"
               class="list-group-item {{ Route::is('admin.settings')? 'active':'' }}">
                <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp; Site Settings</a>
            <a href="{{ route('admin.profile') }}"
               class="list-group-item {{ Route::is('admin.profile')? 'active':'' }}">
                <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp; Profile</a>
            <a href="{{ route('auth.logout') }}" class="list-group-item">
                <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp; Logout</a>
        </div>
    </div>
</div>
