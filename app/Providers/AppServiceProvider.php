<?php

namespace App\Providers;

use App\Modules\Order\Models\Order;
use App\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*if (env('QUERY_LOG', false))
            \DB::listen(function ($query) {
                \Log::channel('query')->info(
                    $query->sql,
                    $query->bindings,
                    $query->time
                );
            });*/
    }
}
