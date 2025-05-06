<?php

namespace App\Config;

use Closure;
use Steampixel\Route;

use App\Controllers\Backend\APIController;
use App\Controllers\Frontend\AuthController;
use App\Controllers\Frontend\BaseController;
use App\Controllers\Frontend\UsersController;
use App\Controllers\Frontend\HomeController;
use App\Controllers\Frontend\RentalsController;

class Routes
{
    private ?Controller $engine = null;
    private ORM $orm;

    public function __construct(ORM $orm)
    {
        $this->orm = $orm;
    }

    /**
     * Run the routes.
     */
    public function run(string $url = '/'): void
    {
        // Set the engine controller based on the request type
        $this->engine = $this->getEngine();

        // Set the routes
        $this->set();

        // Run the routes
        Route::run($url);
    }

    /**
     * Set the URL routes for the application.
     * This doesn't return any value.
     *
     * @return void
     */
    public function set(): void
    {
        /* ---------------------------------- */
        /* ---------- CONFIG ROUTES --------- */
        /* ---------------------------------- */
        Route::pathNotFound(function () {
            // If the request is an AJAX request, return a JSON response
            if ($this->isEndpoint()) {
                return $this->getEngine()->sendOutput(404);
            }

            // Else include a 404 page
            return $this->getEngine()->renderView(404);
        });

        /**
         * Explanation of the following regular expression used to match URL patterns
         * for routing in this web application.
         *
         * The pattern matches routes with up to three segments, separated by slashes (/).
         * Each segment can contain any characters except slashes.
         *
         * The regular expression breakdown:
         *
         * - 1: /
         * Matches the slash at the beginning of the URL.
         *
         * - 2: (.*?)
         * Captures any characters in the first segment of the
         * URL and assigns it to the $controller variable.
         *
         * - 3: (?:/(.*?))?
         * An optional non-capturing group that matches a slash followed
         * by any characters in the second segment of the URL and assigns
         * it to the $method variable.
         *
         * This last one can be repeated multiple times to match more segments.
         * The whole group is optional, indicated by the "?" at the end.
         */

        /* ---------------------------------- */
        /* --------- API AUTO ROUTES -------- */
        /* ---------------------------------- */
        Route::add('/api/v1/(.*?)(?:/(.*?))?(?:/(.*?))?', $this->call(), ['get', 'post', 'put', 'patch', 'delete']);

        /* ---------------------------------- */
        /* ---- FRONTEND SPECIFIC ROUTES ---- */
        /* ---------------------------------- */
        Route::add('/', $this->call(HomeController::class));

        Route::add('/login', $this->call(AuthController::class, 'login'));
        Route::add('/logout', $this->call(AuthController::class, 'logout'));
        Route::add('/login', $this->call(AuthController::class, 'login'), method: 'post');
        Route::add('/register', $this->call(AuthController::class, 'register'));

        Route::add('/profile', $this->call(UsersController::class, 'profile'));

        Route::add('/rent', $this->call(RentalsController::class, 'rent'));
        Route::add('/rentals/confirmation', $this->call(RentalsController::class, 'confirmation'), method: 'post');

        /* ---------------------------------- */
        /* ------ FRONTEND AUTO ROUTES ------ */
        /* ---------------------------------- */
        Route::add('/(.*?)(?:/(.*?))?(?:/(.*?))?(?:/(.*?))?', $this->call());
    }

    /**
     * Return a closure to call the desired controller
     * and method with the provided arguments.
     *
     * If no controller or arguments are provided, the closure
     * tries to get the controller and the arguments from the URL.
     */
    public function call(?string $controller = null, mixed ...$args): Closure
    {
        return function ($path_controller = null, ...$path_args) use ($controller, $args) {
            // If we pass a specific controller and args, the rest of the
            // variables are the arguments to pass to the controller
            $args = $controller !== null && empty($args) ? [$path_controller, ...$path_args, ...$args] : $args;
            return $this->getEngine()->init($controller ?? $path_controller, ...array_merge($args, $path_args));
        };
    }

    /**
     * Get the engine controller based on the request type.
     */
    public function getEngine(): Controller|BaseController|APIController
    {
        if ($this->engine !== null) {
            return $this->engine;
        }

        if ($this->isEndpoint()) {
            // Return the APIController if the request is
            // a normal API call
            return new APIController($this->orm);
        }

        // Else return the default engine controller to
        // handle the frontend
        return new BaseController($this->orm);
    }

    /**
     * Check if the request is an endpoint call.
     *
     * @see https://stackoverflow.com/questions/44202593/detect-a-fetch-request-in-php
     */
    public static function isEndpoint(): bool
    {
        // Check if the request is an AJAX request
        if (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            return true;
        }

        // Check if the request is from a different origin
        // when using the Fetch API
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            return true;
        }

        // Simple check to see if the request is an API
        // or CRON call based on the URL path
        return preg_match('/(api)\/v[0-9]+/', $_SERVER['REQUEST_URI']);
    }

    public static function isPOST(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function isGET(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public static function isPUT(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'PUT';
    }

    public static function isPATCH(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'PATCH';
    }

    public static function isDELETE(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'DELETE';
    }

    public static function isOPTIONS(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'OPTIONS';
    }

}
