<?php

namespace Softworx\RocXolid\Communication\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
// rocXolid communication package provider
use Softworx\RocXolid\Communication\ServiceProvider as PackageServiceProvider;

/**
 * rocXolid views & composers service provider.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class ViewServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap rocXolid view services.
     *
     * @return \Illuminate\Support\ServiceProvider
     */
    public function boot()
    {
        $this
            ->load()
            ->setComposers();

        return $this;
    }

    /**
     * Load views.
     *
     * @return \Illuminate\Support\ServiceProvider
     */
    private function load(): IlluminateServiceProvider
    {
        // customized views preference
        $this->loadViewsFrom(PackageServiceProvider::viewsPublishPath(), 'rocXolid:communication');
        // pre-defined views fallback
        $this->loadViewsFrom(PackageServiceProvider::viewsSourcePath(dirname(dirname(__DIR__))), 'rocXolid:communication');

        return $this;
    }

    /**
     * Set view composers for blade templates.
     *
     * @return \Illuminate\Support\ServiceProvider
     */
    private function setComposers(): IlluminateServiceProvider
    {
        foreach (config('rocXolid.communication.general.composers', []) as $view => $composer) {
            View::composer($view, $composer);
        }

        return $this;
    }
}
