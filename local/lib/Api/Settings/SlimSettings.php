<?php

namespace App\Api\Settings;

use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;

class SlimSettings
{
    public static function setSettings()
    {
        $app = AppFactory::create();
        $middleware = self::setMiddleware($app);
        $app->add($middleware);
        $app->setBasePath("/api/v1");

        return $app;
    }

    public static function setMiddleware(\Slim\App $app)
    {
        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            true,
            false,
            false
        );
    }
}