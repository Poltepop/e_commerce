<?php

namespace App\Providers;

use App\Services\CartService;
use App\Services\Impl\CartServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        CartService::class => CartServiceImpl::class
    ];

    public function provides(){
        return [CartService::class];
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
