<?php

namespace API\IpLocation;

use API\ClientIp\RemoteAddress;

use API\IpLocation\Core\Aggregator;

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

$app->setBasePath('/breeze-server/ip-location-api');

$app->add(new CorsMiddleware());
$app->addRoutingMiddleware();
$app->add(new TrailingSlash(false));
$app->add(new ApiKeyAuthMiddleware(Constants::API_KEYS));
$app->addErrorMiddleware($dev_mode, $dev_mode, $dev_mode);

$app->get('[/{ip}[/{source}]]', function (Request $request, Response $response) {
    try {
        $ip = $request->getAttribute('ip');
        $source = $request->getAttribute('source');

        if (!isset($ip) || empty($ip)) {
            $address = new RemoteAddress();

            $ip = $address->getIpAddress();
        }

        $source = (!isset($source) || empty($source)) ? 'auto' : $source;

        $aggregator = new Aggregator($ip, $source);

        $response->getBody()->write(json_encode($aggregator->fetchIpLocation()));

        return $response->withHeader('content-type', 'application/json')->withStatus(200);
    } catch (\Exception $e) {
        $error = array("message" => $e->getMessage());

        $response->getBody()->write(json_encode($error));

        return $response->withHeader('content-type', 'application/json')->withStatus(500);
    }
});

$app->options('[/{ip}[/{source}]]', new PreflightAction());

$app->run();
