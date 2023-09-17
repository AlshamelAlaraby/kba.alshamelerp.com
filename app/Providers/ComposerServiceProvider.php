<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(
            'backend.layouts._partial.sidebar', 'App\Http\View\Composers\BackendMenuComposer'
        );
        View::composer('frontend.layouts.app', 'App\Http\View\Composers\FrontendMenuComposer');
    }

    public function register()
    {
    }
}
