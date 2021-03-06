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
      if (env('APP_ENV') === 'production') {
          \URL::forceScheme('https');
      }
      Blade::component('components.event_info', 'event_info');
      Blade::component('components.image', 'image');
      Blade::component('components.user_preview', 'user_preview');
      Blade::component('components.event_card', 'event_card');
      Blade::component('components.game_card', 'game_card');
    }
}
