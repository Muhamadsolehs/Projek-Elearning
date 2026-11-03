<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Normalize subfolder root access in Laragon / Apache
if (isset($_SERVER['REQUEST_URI'])) {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($path === '/TA/public' || $path === '/TA/public/' || $path === '/' || $path === '') {
        $_SERVER['REQUEST_URI'] = str_replace(['/TA/public', '/'], ['/TA/public/login', '/login'], $path);
    }
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
