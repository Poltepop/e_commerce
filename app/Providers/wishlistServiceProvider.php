<?php

namespace App\Providers;

use App\Services\Impl\wishlistServiceImpl;
use App\Services\WishlistService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class wishlistServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        WishlistService::class => wishlistServiceImpl::class
    ];

    public function provides() {
        return [WishlistService::class];
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
