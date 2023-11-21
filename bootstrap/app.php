<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$environmentFile = '.env'; // Default environment file

$domain = $_SERVER['HTTP_HOST'] ?? '';

if ($domain === 'easyenglishbd.com' || $domain ==='www.easyenglishbd.com') {
    $environmentFile = '.env.easyenglishbd';
}
elseif ($domain === 'localhost' || $domain === '127.0.0.1' || $domain === '127.0.0.1:8000') {
    $environmentFile = '.env.local';
}

$envFilePath = $app->basePath($environmentFile);

if (file_exists($envFilePath)) {
    $dotenv = Dotenv\Dotenv::createMutable($app->basePath(), $environmentFile);
    $dotenv->load();
}

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/
$app->register(Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class);

return $app;
