<?php

namespace Timmoh\MailcoachCustomPlaceholder;

use Illuminate\Support\Facades\Route;
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
        $this->bootPublishables()
            ->bootViews()
            ->bootRoutes();
    }

    protected function bootPublishables()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                __DIR__ . '/../config/config.php' => config_path('mailcoach-custom-placeholder.php'),
                __DIR__ . '/../resources/views' => resource_path('views/vendor/mailcoach'),
                __DIR__ . '/../resources/lang' => resource_path('lang'),
            ],
                'mailcoach-custom-placeholder'
            );

            $this->publishes(
                [
                __DIR__ . '/../config/config.php' => config_path('mailcoach-custom-placeholder.php'),
            ],
                'mailcoach-custom-placeholder-config'
            );

            // Publishing the views.
            $this->publishes(
                [
                __DIR__ . '/../resources/views' => resource_path('views/vendor/mailcoach'),
            ],
                'mailcoach-custom-placeholder-views'
            );

            // Publishing the translation files.
            $this->publishes(
                [
                __DIR__ . '/../resources/lang' => resource_path('lang'),
            ],
                'mailcoach-custom-placeholder-lang'
            );

            // Registering package commands.
            $migrationName = 'create_mailcoach_placeholder_tables';
            $this->publishes(
                [
                __DIR__ . '/../database/migrations/' . $migrationName . '.php.stub' => database_path('migrations/' . date(
                    'Y_m_d_His',
                    time()
                ) . '_' . $migrationName . '.php'),
            ],
                'mailcoach-custom-placeholder-migrations'
            );
        }

        return $this;
    }

    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mailcoach');

        return $this;
    }

    protected function bootRoutes()
    {
        Route::macro(
            'mailcoachCustomPlaceholder',
            function (string $prefix = '') {
                Route::prefix($prefix)->group(function () {
                    Route::middleware(config('mailcoach.middleware')['web'])->group(__DIR__ . '/../routes/mailcoach-custom-palceholder.php');
                });
            }
        );

        return $this;
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'mailcoach-custom-placeholder');

        // Register the main class to use with the facade
        $this->app->singleton(
            'mailcoach-custom-placeholder',
            function () {
                return new MailcoachCustomPlaceholder;
            }
        );
    }
}
