<?php

namespace API\Database;

use API\Database\Classes\Middlewares\ApiKeyAuthMiddleware;
use API\Database\Classes\Middlewares\CorsMiddleware;
use API\Database\Classes\PreflightAction;
use API\Database\Utils\Constants;
use API\Database\Utils\Functions;

use Middlewares\TrailingSlash;

use Slim\Factory\AppFactory;

require_once '../vendor/autoload.php';

$dev_mode = file_exists('../composer.json');

$app = AppFactory::create();

$app->setBasePath('/breeze-server/db-api');

$app->addBodyParsingMiddleware();
$app->add(new CorsMiddleware());
$app->addRoutingMiddleware();
$app->add(new TrailingSlash(false));
$app->add(new ApiKeyAuthMiddleware(Constants::API_KEYS));
$app->addErrorMiddleware($dev_mode, $dev_mode, $dev_mode);

$controllers = Functions::extractControllers();

foreach ($controllers as $key => $controller) {

    $className = "\\API\Database\Controllers\\" . $controller;

    (new $className())->addRoutes($app);

}
$app->options('/{routes:.+}', new PreflightAction());
$app->run();

/*namespace API\Database;

use API\Database\Classes\Middlewares\ApiKeyAuthMiddleware;
use API\Database\Classes\Middlewares\CorsMiddleware;
use API\Database\Utils\Constants;
use API\Database\Utils\Functions;

use Middlewares\TrailingSlash;

use Slim\Factory\AppFactory;

require_once '../vendor/autoload.php';

$dev_mode = file_exists('../composer.json');

$app = AppFactory::create();

$app->setBasePath('/breeze-server/db-api');

$app->addBodyParsingMiddleware();
$app->add(new CorsMiddleware());
$app->addRoutingMiddleware();
$app->add(new TrailingSlash(false));
$app->add(new ApiKeyAuthMiddleware(Constants::API_KEYS));
$app->addErrorMiddleware($dev_mode, $dev_mode, $dev_mode);

$controllers = Functions::extractControllers();

foreach ($controllers as $key => $controller) {

    $className = "\\API\Database\Controllers\\" . $controller;

    (new $className())->addRoutes($app);

}
$app->options('/{routes:.+}', new PreflightAction());
$app->run();*/
