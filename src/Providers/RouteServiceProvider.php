<?php

namespace Softworx\RocXolid\Communication\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
// rocXolid services
use Softworx\RocXolid\Services\CrudRouterService;

/**
 * rocXolid routes service provider.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class RouteServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap rocXolid routing services.
     *
     * @return \Illuminate\Support\ServiceProvider
     */
    public function boot()
    {
        $this
            ->load($this->app->router)
            ->mapRouteModels($this->app->router);

        return $this;
    }

    /**
     * Define the routes for the package.
     *
     * @param \Illuminate\Routing\Router $router Router to be used for routing.
     * @return \Illuminate\Support\ServiceProvider
     */
    private function load(Router $router): IlluminateServiceProvider
    {
        $router->group([
            'module' => 'rocXolid-communication',
            'middleware' => [ 'web', 'rocXolid.auth' ],
            'namespace' => 'Softworx\RocXolid\Communication\Http\Controllers',
            'prefix' => sprintf('%s/communication', config('rocXolid.admin.general.routes.root', 'rocXolid')),
            'as' => 'rocXolid.communication.',
        ], function ($router) {
            CrudRouterService::create('email-notification', \EmailNotification\Controller::class);
            CrudRouterService::create('sms-notification', \SmsNotification\Controller::class);
            // logs
            CrudRouterService::create('communication-log', \CommunicationLog\Controller::class);

            $router->group([
                'namespace' => 'EmailNotification',
                'prefix' => 'email-notification',
            ], function ($router) {
                $router->get('/send-test-notification/{email_notification}', 'Controller@sendTestNotificationConfirm')->name('send-test-confirm');
                $router->post('/send-test-notification/{email_notification}', 'Controller@sendTestNotification')->name('send-test');
            });

            $router->group([
                'namespace' => 'SmsNotification',
                'prefix' => 'sms-notification',
            ], function ($router) {
                $router->get('/send-test-notification/{sms_notification}', 'Controller@sendTestNotificationConfirm')->name('send-test-confirm');
                $router->post('/send-test-notification/{sms_notification}', 'Controller@sendTestNotification')->name('send-test');
            });

            $router->group([
                'namespace' => 'CommunicationLog',
                'prefix' => 'communication-log',
            ], function ($router) {
                $router->get('/model/{relation}/{communication_log}', 'Controller@modelLog');
            });
        });

        return $this;
    }

    /**
     * Define the route bindings for URL params.
     *
     * @param \Illuminate\Routing\Router $router Router to be used for routing.
     * @return \Illuminate\Support\ServiceProvider
     */
    private function mapRouteModels(Router $router): IlluminateServiceProvider
    {
        $router->model('email_notification', \Softworx\RocXolid\Communication\Models\EmailNotification::class);
        $router->model('sms_notification', \Softworx\RocXolid\Communication\Models\SmsNotification::class);
        $router->model('communication_log', \Softworx\RocXolid\Communication\Models\CommunicationLog::class);

        return $this;
    }
}
