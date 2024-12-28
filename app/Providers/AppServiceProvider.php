<?php

namespace App\Providers;

use App\Policies\WhiteboardPolicy;
use App\Models\Whiteboard;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Whiteboard::class => WhiteboardPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
