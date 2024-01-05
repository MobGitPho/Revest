<?php

namespace API\ClientIp;

use API\Database\Classes\Middlewares\ApiKeyAuthMiddleware;
use API\Database\Classes\Middlewares\CorsMiddleware;
use API\Database\Classes\PreflightAction;
use API\Database\Utils\Constants;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Middlewares\TrailingSlash;
use Slim\Factory\AppFactory;

require_once '../vendor/autoload.php';

$dev_mode = file_exists('../composer.json');

$app = AppFactory::create();

$app->setBasePath('/breeze-server/client-ip-api');

$app->add(new CorsMiddleware());
$app->addRoutingMiddleware();
$app->add(new TrailingSlash(true));
$app->add(new ApiKeyAuthMiddleware(Constants::API_KEYS));
$app->addErrorMiddleware($dev_mode, $dev_mode, $dev_mode);

$app->get('/', function (Request $request, Response $response) {
    try {
        $address = new RemoteAddress();

        $ip = $address->getIpAddress();

        $response->getBody()->write(json_encode($ip));

        return $response->withHeader('content-type', 'application/json')->withStatus(200);
    } catch (\Exception $e) {
        $error = array("message" => $e->getMessage());

        $response->getBody()->write(json_encode($error));

        return $response->withHeader('content-type', 'application/json')->withStatus(500);
    }
});

$app->options('/', new PreflightAction());

$app->run();
