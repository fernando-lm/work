<?php
namespace Middlewares;

class Middleware
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected static $middleware = [
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected static $routeMiddleware = [
    ];

    public static function handle()
    {
        foreach (self::$middleware as $class) {
            $middleware = new $class();
            $middleware->handle();
        }
    }
}
