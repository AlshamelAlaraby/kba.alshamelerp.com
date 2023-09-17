<?php

namespace App\Modules\Admin\Providers;

use App\Modules\Admin\Repositories\AdminRepository;
use App\Modules\Admin\Repositories\EloquentAdminRepository;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(AdminRepository::class, EloquentAdminRepository::class);
    }
}
