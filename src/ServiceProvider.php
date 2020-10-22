<?php

namespace Softworx\RocXolid\Communication;

use Illuminate\Foundation\AliasLoader;
// rocXolid service providers
use Softworx\RocXolid\AbstractServiceProvider as RocXolidAbstractServiceProvider;

/**
 * rocXolid Communication package primary service provider.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class ServiceProvider extends RocXolidAbstractServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(Providers\ConfigurationServiceProvider::class);
        $this->app->register(Providers\AuthServiceProvider::class);
        $this->app->register(Providers\ViewServiceProvider::class);
        $this->app->register(Providers\RouteServiceProvider::class);
        $this->app->register(Providers\TranslationServiceProvider::class);
        $this->app->register(Providers\EventServiceProvider::class);

        $this
            ->bindContracts()
            ->bindAliases(AliasLoader::getInstance());
    }

    /**
    * Bootstrap the application services.
    *
    * @return void
    */
    public function boot()
    {
        $this
            ->publish();
    }

    /**
     * Expose config files and resources to be published.
     *
     * @return \Softworx\RocXolid\AbstractServiceProvider
     */
    private function publish(): RocXolidAbstractServiceProvider
    {
        // config files
        // php artisan vendor:publish --provider="Softworx\RocXolid\Communication\ServiceProvider" --tag="config" (--force to overwrite)
        $this->publishes([
            __DIR__ . '/../config/general.php' => config_path('rocXolid/communication/general.php'),
        ], 'config');

        // lang files
        // php artisan vendor:publish --provider="Softworx\RocXolid\Communication\ServiceProvider" --tag="lang" (--force to overwrite)
        $this->publishes([
            //__DIR__ . '/../resources/lang' => resource_path('lang/vendor/softworx/rocXolid/communication'),
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/rocXolid:communication'), // used by laravel's FileLoaded::loadNamespaceOverrides()
        ], 'lang');

        // views files
        // php artisan vendor:publish --provider="Softworx\RocXolid\Communication\ServiceProvider" --tag="views" (--force to overwrite)
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/softworx/rocXolid/communication'),
        ], 'views');

        // migrations
        // php artisan vendor:publish --provider="Softworx\RocXolid\Communication\ServiceProvider" --tag="migrations" (--force to overwrite)
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        // db dumps
        // php artisan vendor:publish --provider="Softworx\RocXolid\Communication\ServiceProvider" --tag="dumps" (--force to overwrite)
        $this->publishes([
            __DIR__.'/../database/dumps/' => database_path('dumps/rocXolid/communication')
        ], 'dumps');

        return $this;
    }

    /**
     * Bind contracts / facades, so they don't have to be added to config/app.php.
     *
     * Usage:
     *      $this->app->bind(<SomeContract>::class, <SomeImplementation>::class);
     *
     * @return \Softworx\RocXolid\AbstractServiceProvider
     */
    private function bindContracts(): RocXolidAbstractServiceProvider
    {
        return $this;
    }

    /**
     * Bind aliases, so they don't have to be added to config/app.php.
     *
     * Usage:
     *      $loader->alias('<alias>', <Facade/>Contract>::class);
     *
     * @return \Softworx\RocXolid\AbstractServiceProvider
     */
    private function bindAliases(AliasLoader $loader): RocXolidAbstractServiceProvider
    {
        return $this;
    }
}
