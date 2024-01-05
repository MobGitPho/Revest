<?php

namespace API\FileReader;

use API\Database\Classes\Middlewares\ApiKeyAuthMiddleware;
use API\Database\Classes\Middlewares\CorsMiddleware;
use API\Database\Classes\PreflightAction;
use API\Database\Utils\Constants;
use API\Database\Utils\Functions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Middlewares\TrailingSlash;
use Slim\Factory\AppFactory;

require_once '../vendor/autoload.php';

$dev_mode = file_exists('../composer.json');

$app = AppFactory::create();

$app->setBasePath('/breeze-server/file-api');

$app->addBodyParsingMiddleware();
$app->add(new CorsMiddleware());
$app->addRoutingMiddleware();
$app->add(new TrailingSlash(false));
$app->add(new ApiKeyAuthMiddleware(Constants::API_KEYS));
$app->addErrorMiddleware($dev_mode, $dev_mode, $dev_mode);

$app->post('/file/get', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    try {
        $filepath = (isset($data['complete-path']) && $data['complete-path'])
            ? $data['file']
            : Functions::getBasePath() . $data['file'];

        $contents = file_exists($filepath) ? file_get_contents($filepath) : '';

        $response->getBody()->write((isset($data['json-encode']) && $data['json-encode']) ? json_encode($contents) : $contents);

        return $response->withHeader('content-type', 'application/json')->withStatus(200);
    } catch (\Exception $e) {
        $error = array("message" => $e->getMessage());

        $response->getBody()->write(json_encode($error));

        return $response->withHeader('content-type', 'application/json')->withStatus(500);
    }
});

$app->post('/file/exists', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    try {
        $result = (isset($data['complete-path']) && $data['complete-path'])
            ? file_exists($data['file'])
            : file_exists(Functions::getBasePath() . $data['file']);

        $response->getBody()->write(json_encode($result));

        return $response->withHeader('content-type', 'application/json')->withStatus(200);
    } catch (\Exception $e) {
        $error = array("message" => $e->getMessage());

        $response->getBody()->write(json_encode($error));

        return $response->withHeader('content-type', 'application/json')->withStatus(500);
    }
});

$app->options('/file/exists', new PreflightAction());
$app->options('/file/get', new PreflightAction());

$app->run();
