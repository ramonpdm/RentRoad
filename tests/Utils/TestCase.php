<?php

declare(strict_types=1);

namespace Tests\Utils;

use App\Config\Application;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public const string BASE_PATH = __DIR__ . '/../..';
    public ?Application $app = null;

    public function setUp(): void
    {
        // Load environment variables if not already loaded
        if (!defined('TESTING_ENV_LOADED')) {
            (\Dotenv\Dotenv::createImmutable(static::BASE_PATH))->load();
            define('TESTING_ENV_LOADED', true);
        }

        $this->app = new Application();
    }
}