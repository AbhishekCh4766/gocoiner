<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.*', 'frontend.*', 'static.*'], 'App\ViewComposers\DefaultViewComposer');
        View::composer(['layouts.includes.sidebar-left'], 'App\ViewComposers\SidebarViewComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
