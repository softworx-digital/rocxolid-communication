<?php

namespace Softworx\RocXolid\Communication\Providers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
// rocXolid communication package provider
use Softworx\RocXolid\Communication\ServiceProvider as PackageServiceProvider;

/**
 * rocXolid translation service provider.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class TranslationServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap rocXolid translation services.
     *
     * @return \Illuminate\Support\ServiceProvider
     */
    public function boot()
    {
        $this
            ->load();

        return $this;
    }

    /**
     * Load translations.
     *
     * @return \Illuminate\Support\ServiceProvider
     */
    private function load()
    {
        $this->loadTranslationsFrom(PackageServiceProvider::translationsSourcePath(dirname(dirname(__DIR__))), 'rocXolid-communication');

        return $this;
    }
}
