<?php

namespace RanaTuhin\Hostaway;

use Illuminate\Support\ServiceProvider;
use RanaTuhin\Hostaway\HostawayClient;

class HostawayServiceProvider extends ServiceProvider
{
     /**
      * Register bindings and merge config.
      */
     public function register(): void
     {
          // Merge package config
          $this->mergeConfigFrom(__DIR__ . '/../config/hostaway.php', 'hostaway');

          // Bind the HostawayClient for Facade and DI use
          $this->app->singleton(HostawayClient::class, function () {
               return new HostawayClient();
          });

          // Alias for easy usage via Facade
          $this->app->alias(HostawayClient::class, 'hostaway');
     }

     /**
      * Publish config when running vendor:publish
      */
     public function boot(): void
     {
          $this->publishes([
               __DIR__ . '/../config/hostaway.php' => config_path('hostaway.php'),
          ], 'hostaway-config');
     }
}
