<?php

namespace App\Components\Siegnor\Providers;

use Illuminate\Support\ServiceProvider;

class AssignServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();

        $this->loadMigrationsFrom(__DIR__.'/../../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // register voyagers
        $this->app->register(\TCG\Voyager\VoyagerServiceProvider::class);

        // register passport
        $this->app->register(\Laravel\Passport\PassportServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../../Config/config.php' => config_path('siegnor.php'),
        ],'config-siegnor');
        $this->mergeConfigFrom(
            __DIR__.'/../../Config/config.php', 'siegnor'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/components/siegnor');

        $sourcePath = __DIR__.'/../../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/components/siegnor';
        }, \Config::get('view.paths')), [$sourcePath]), 'siegnor');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/components/siegnor');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'siegnor');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../../Resources/lang', 'siegnor');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
