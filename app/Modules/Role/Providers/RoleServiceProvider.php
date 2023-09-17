<?php

namespace App\Modules\Role\Providers;

use App\Modules\Role\Repositories\EloquentRoleRepository;
use App\Modules\Role\Repositories\RoleRepository;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(RoleRepository::class, EloquentRoleRepository::class);
    }
}
