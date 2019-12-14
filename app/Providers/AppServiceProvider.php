<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
      Blade::component('components.event_info', 'event_info');
      Blade::component('components.image', 'image');
      Blade::component('components.user_preview', 'user_preview');
      Blade::component('components.event_card', 'event_card');
    }
}
