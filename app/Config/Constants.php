<?php

/**
 * Application System Constants
 */
define('APP_DIR', dirname(__DIR__));
const APP_NAME = 'RentRoad';
const APP_VIEWS_DIR = APP_DIR . '/Views';

/**
 * Database Credentials
 */
define('DB_HOST', $_ENV['DB_HOST'] ?? '');
define('DB_USER', $_ENV['DB_USER'] ?? '');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? '');
define('DB_PORT', $_ENV['DB_PORT'] ?? '');

/**
 * Time Constants
 */
const APP_TIMEZONE = 'America/New_York';