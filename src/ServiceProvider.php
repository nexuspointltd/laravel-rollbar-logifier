<?php

namespace NexusPoint\RollbarLogifier;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Log;
use Monolog\Handler\RollbarHandler;
use Monolog\Processor\WebProcessor;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $configFile = __DIR__ . '/config/config.php';
        $this->mergeConfigFrom($configFile, 'logifier');

        $this->registerCustomLogger();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     *
     */
    protected function registerCustomLogger()
    {
        $config = $this->app['config']->get('logifier.rollbar');
        if (!$config['enabled']) return;

        $monolog = Log::getMonolog();

        $user = $this->app['auth']->user();
        //dd($user);
        if ($user) {
            $user = array_only($user->toArray(), ['id', 'email']);
        }

        $rollbarNotifier = new \RollbarNotifier([
            'access_token' => $config['token'],
            'environment'  => $this->app->environment(),
            //'person'       => $user,
        ]);
        $handler = new RollbarHandler(
            $rollbarNotifier,
            $config['warning_level'],
            true // bubble
        );

        $handler->pushProcessor(new WebProcessor());
        $monolog->pushHandler($handler);
    }

}
