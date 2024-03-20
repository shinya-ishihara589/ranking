<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ViewComposerServiceProvider extends ServiceProvider
{
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
        // ここに追加
        View::composers([
            \App\Http\ViewComposers\UserComposer::class => '*',
        ]);
    }
}
