<?php


namespace App\Modules\Category\Providers;

use App\Modules\Category\Repositories\EloquentCategoryRepository;
use App\Modules\Category\Repositories\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
    }
}
