<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\Impl\CategoryServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        CategoryService::class => CategoryServiceImpl::class,
    ];

    public function provides():array{
        return [CategoryService::class];
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
