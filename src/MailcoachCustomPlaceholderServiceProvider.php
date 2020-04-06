<?php

namespace Timmoh\MailcoachCustomPlaceholder;

use Illuminate\Support\ServiceProvider;

class MailcoachCustomPlaceholderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mailcoach-custom-placeholder');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'mailcoach-custom-placeholder');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('mailcoach-custom-placeholder.php'),
                __DIR__.'/../resources/views' => resource_path('views/vendor/mailcoach'),
                __DIR__.'/../resources/lang' => resource_path('lang'),
            ], 'mailcoach-custom-placeholder');

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('mailcoach-custom-placeholder.php'),
            ], 'mailcoach-custom-placeholder-config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/mailcoach'),
            ], 'mailcoach-custom-placeholder-views');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang'),
            ], 'mailcoach-custom-placeholder-lang');

            // Registering package commands.
            // $this->commands([]);
        }
    }
    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'mailcoach-custom-placeholder');

        // Register the main class to use with the facade
        $this->app->singleton('mailcoach-custom-placeholder', function () {
            return new MailcoachCustomPlaceholder;
        });
    }
}
